package de.due.ldsa.bd;

import scala.Tuple2;

import org.apache.spark.api.java.*;
import org.apache.spark.api.java.function.Function;
import org.apache.spark.api.java.function.PairFunction;
import org.apache.spark.mllib.recommendation.ALS;
import org.apache.spark.mllib.recommendation.MatrixFactorizationModel;
import org.apache.spark.mllib.recommendation.Rating;
import org.apache.spark.storage.StorageLevel;
import java.io.File;

import java.util.Map;

import org.apache.spark.SparkConf;


public class RecommendationModel {
	
	private static JavaSparkContext sc;
	
	public static void main(String[] args){
		
		/**
		 * Setting Winutil property is only valid for Windows machine
		 */
		String exePath = "src/main/resources/WinUtils/";
		File exeFile = new File(exePath);
		System.setProperty("hadoop.home.dir", exeFile.getAbsolutePath());
		
		//Initializing Spark
		SparkConf conf = new SparkConf().setAppName("big-data").setMaster("local[2]");
		sc = new JavaSparkContext(conf);
	
		//Reading Data, here we we put rating and product/movie data for later train
		JavaRDD<String> ratingData = sc.textFile("src/main/resources/mllib/ratings.dat");
		JavaRDD<String> productData = sc.textFile("src/main/resources/mllib/movies.dat");
		JavaRDD<Tuple2<Integer, Rating>> ratings = ratingData.map(
		        new Function<String, Tuple2<Integer, Rating>>() {
		            /**
					 * default serialize id added as we need it for machine leaning
					 */
					private static final long serialVersionUID = 1L;
	
					public Tuple2<Integer, Rating> call(String s) throws Exception {
		                String[] row = s.split("::");
		                Integer cacheStamp = Integer.parseInt(row[3]) % 10;
		                Rating rating = new Rating(Integer.parseInt(row[0]), Integer.parseInt(row[1]), Double.parseDouble(row[2]));
		                return new Tuple2<Integer, Rating>(cacheStamp, rating);
		            }
		        }
		);
	
		Map<Integer, String> products = productData.mapToPair(
		        new PairFunction<String, Integer, String>() {
		            /**
					 * 
					 */
					private static final long serialVersionUID = 1L;
	
					public Tuple2<Integer, String> call(String s) throws Exception {
		                String[] sarray = s.split("::");
		                return new Tuple2<Integer, String>(Integer.parseInt(sarray[0]), sarray[1]);
		            }
		        }
		).collectAsMap();	
		
		//rating summary
		long ratingCount = ratings.count();
		long userCount = ratings.map(
		        new Function<Tuple2<Integer, Rating>, Object>() {
		            /**
					 * 
					 */
					private static final long serialVersionUID = 1L;

					public Object call(Tuple2<Integer, Rating> tuple) throws Exception {
		                return tuple._2().user();
		            }
		        }
		).distinct().count();

		long movieCount = ratings.map(
		        new Function<Tuple2<Integer, Rating>, Object>() {
		            /**
					 * 
					 */
					private static final long serialVersionUID = 1L;

					public Object call(Tuple2<Integer, Rating> tuple) throws Exception {
		                return tuple._2().product();
		            }
		        }
		).distinct().count();
		
		System.out.println("Got " + ratingCount + " ratings from "+ userCount + " users on " + movieCount + " products.");
        
		/*Splitting training data as:
		 * training: for train multiple model
		 * validation: for select the best model by RMSE(Root Mean Squared Error)
		 * test : for evaluate the best model on test set
		 */
		int numPartitions = 10;
		//training data set
		JavaRDD<Rating> training = ratings.filter(
		        new Function<Tuple2<Integer, Rating>, Boolean>() {
		            /**
					 * 
					 */
					private static final long serialVersionUID = 1L;

					public Boolean call(Tuple2<Integer, Rating> tuple) throws Exception {
		                return tuple._1() < 6;
		            }
		        }
		).map(
		        new Function<Tuple2<Integer, Rating>, Rating>() {
		            /**
					 * 
					 */
					private static final long serialVersionUID = 1L;

					public Rating call(Tuple2<Integer, Rating> tuple) throws Exception {
		                return tuple._2();
		            }
		        }
		).repartition(numPartitions).cache();

		StorageLevel storageLevel = new StorageLevel();
		//validation data set
		JavaRDD<Rating> validation = ratings.filter(
		        new Function<Tuple2<Integer, Rating>, Boolean>() {
		            /**
					 * 
					 */
					private static final long serialVersionUID = 1L;

					public Boolean call(Tuple2<Integer, Rating> tuple) throws Exception {
		                return tuple._1() >= 6 && tuple._1() < 8;
		            }
		        }
		).map(
		        new Function<Tuple2<Integer, Rating>, Rating>() {
		            /**
					 * 
					 */
					private static final long serialVersionUID = 1L;

					public Rating call(Tuple2<Integer, Rating> tuple) throws Exception {
		                return tuple._2();
		            }
		        }
		).repartition(numPartitions).persist(storageLevel);

		//test data set
		JavaRDD<Rating> test = ratings.filter(
		        new Function<Tuple2<Integer, Rating>, Boolean>() {
		            /**
					 * 
					 */
					private static final long serialVersionUID = 1L;

					public Boolean call(Tuple2<Integer, Rating> tuple) throws Exception {
		                return tuple._1() >= 8;
		            }
		        }
		).map(
		        new Function<Tuple2<Integer, Rating>, Rating>() {
		            /**
					 * 
					 */
					private static final long serialVersionUID = 1L;

					public Rating call(Tuple2<Integer, Rating> tuple) throws Exception {
		                return tuple._2();
		            }
		        }
		).persist(storageLevel);

		long numTraining = training.count();
		long numValidation = validation.count();
		long numTest = test.count();
		
		System.out.println("After Spliting Data we have three non-overlapping subset of training parameter");
		System.out.println("Training set: " + numTraining);
		System.out.println("Validation set: " + numValidation);
		System.out.println("Test set: " + numTest);

        /*
         * Training the Model based on these sets of data
         * using ALS.train we will train some models and find the best one
         * ALS best parameter we need are:
         * Rank,
         * Lambda(regularization constant)&	
         * number of iterations					
         */
		
		int[] ranks = {8, 12};
		float[] lambdas = {0.1f, 10.0f};
		int[] numIters = {10, 20};
		
		double bestValidationRmse = Double.MAX_VALUE;
		int bestRank = 0;
		float bestLambda = -1.0f;
		int bestNumIter = -1;
		//int rank = 10;
	    //int numIterations = 2;
	    //MatrixFactorizationModel bestModel = ALS.train(JavaRDD.toRDD(training), rank, numIterations, 0.01);
		
	    MatrixFactorizationModel bestModel = null;
		for (int currentRank : ranks) {
		    for (float currentLambda : lambdas) {
		        for (int currentNumIter : numIters) {
		            MatrixFactorizationModel model = ALS.train(JavaRDD.toRDD(training), currentRank, currentNumIter, currentLambda);

		            Double validationRmse = computeRMSE(model, validation);
		            System.out.println("RMSE (Validation) = " + validationRmse + "for the model Trained with rank = "
		                    + currentRank + ",Lambda = " + currentLambda + ",and Number of Iterations = " + currentNumIter + ".");

		            if (validationRmse < bestValidationRmse) {
		                bestModel = model;
		                bestValidationRmse = validationRmse;
		                bestRank = currentRank;
		                bestLambda = currentLambda;
		                bestNumIter = currentNumIter;
		            }
		        }
		    }
		}
		
		//Computing Root Mean Square Error in the test data set
		Double testRmse = computeRMSE(bestModel, test);
		System.out.println("The computation Result:");
		System.out.println("The best model was trained with rank = " + bestRank);
		System.out.println(" and lambda = " + bestLambda);
		System.out.println(", and numIter = " + bestNumIter);
		System.out.println("So, the RMSE(Root Mean Square Error) on the test set is " + testRmse + ".");

		sc.stop();

		//get 50s best recommendation from GetRecommendation
		//GetRecommendations.getRecommendations(bestNumIter, bestModel, ratings, products);
			
	}
	
	/**
	* Calculating the Root Mean Squared Error (computeRMSE)
	*
	* @param model best model generated.
	* @param data  rating data.
	* @return      Root Mean Squared Error
	*/
	public final static Double computeRMSE(MatrixFactorizationModel model, JavaRDD<Rating> data) {
	JavaRDD<Tuple2<Object, Object>> userProducts = data.map(
	        new Function<Rating, Tuple2<Object, Object>>() {
	            /**
				 * 
				 */
				private static final long serialVersionUID = 1L;

				public Tuple2<Object, Object> call(Rating r) {
	                return new Tuple2<Object, Object>(r.user(), r.product());
	            }
	        }
	);

	JavaPairRDD<Tuple2<Integer, Integer>, Double> predictions = JavaPairRDD.fromJavaRDD(
	        model.predict(JavaRDD.toRDD(userProducts)).toJavaRDD().map(
	                new Function<Rating, Tuple2<Tuple2<Integer, Integer>, Double>>() {
	                    /**
						 * 
						 */
						private static final long serialVersionUID = 1L;

						public Tuple2<Tuple2<Integer, Integer>, Double> call(Rating r) {
	                        return new Tuple2<Tuple2<Integer, Integer>, Double>(
	                                new Tuple2<Integer, Integer>(r.user(), r.product()), r.rating());
	                    }
	                }
	        ));
	JavaRDD<Tuple2<Double, Double>> predictionsAndRatings =
	        JavaPairRDD.fromJavaRDD(data.map(
	                new Function<Rating, Tuple2<Tuple2<Integer, Integer>, Double>>() {
	                    /**
						 * 
						 */
						private static final long serialVersionUID = 1L;

						public Tuple2<Tuple2<Integer, Integer>, Double> call(Rating r) {
	                        return new Tuple2<Tuple2<Integer, Integer>, Double>(
	                                new Tuple2<Integer, Integer>(r.user(), r.product()), r.rating());
	                    }
	                }
	        )).join(predictions).values();

	double mse =  JavaDoubleRDD.fromRDD(predictionsAndRatings.map(
	        new Function<Tuple2<Double, Double>, Object>() {
	            /**
				 * 
				 */
				private static final long serialVersionUID = 1L;

				public Object call(Tuple2<Double, Double> pair) {
	                Double err = pair._1() - pair._2();
	                return err * err;
	            }
	        }
	).rdd()).mean();

	return Math.sqrt(mse);
	
	}

}
