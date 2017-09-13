package de.due.ldsa.bd;

import scala.Tuple2;

import org.apache.spark.api.java.*;
import org.apache.spark.api.java.function.Function;
import org.apache.spark.mllib.recommendation.ALS;
import org.apache.spark.mllib.recommendation.MatrixFactorizationModel;
import org.apache.spark.mllib.recommendation.Rating;

import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.Iterator;
import java.util.List;
import java.util.Map;

import org.apache.spark.SparkConf;

public class GetRecommendations {

	/**
	* Returns the list of recommendations for a given user
	*
	* @param userId    user id.
	* @param model     best model.
	* @param ratings   rating data.
	* @param products  product list.
	* @return          The list of recommended products.
	*/
	static List<Rating> getRecommendations(final int userId, MatrixFactorizationModel model, JavaRDD<Tuple2<Integer, Rating>> ratings, Map<Integer, String> products) {
	        List<Rating> recommendations;
	        
	        //Getting the users ratings
	        JavaRDD<Rating> userRatings = ratings.filter(
	                new Function<Tuple2<Integer, Rating>, Boolean>() {
	                    /**
						 * 
						 */
						private static final long serialVersionUID = 1L;

						public Boolean call(Tuple2<Integer, Rating> tuple) throws Exception {
	                        return tuple._2().user() == userId;
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
	        );
	        
	        //Getting the product ID's of the products that user rated
	        JavaRDD<Tuple2<Object, Object>> userProducts = userRatings.map(
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
	        
	        List<Integer> productSet = new ArrayList<Integer>();
	        productSet.addAll(products.keySet());
	        
	        Iterator<Tuple2<Object, Object>> productIterator = userProducts.toLocalIterator();
	        
	        //Removing the user watched (rated) set from the all product set
	        while(productIterator.hasNext()) {
	            Integer movieId = (Integer)productIterator.next()._2();
	            if(productSet.contains(movieId)){
	                productSet.remove(movieId);
	            }
	        }
	        
	        //Initializing Spark
			SparkConf conf = new SparkConf().setAppName("Rating").setMaster("local[4]");
			JavaSparkContext sc = new JavaSparkContext(conf);
			
	        JavaRDD<Integer> candidates = sc.parallelize(productSet);
	        
	        JavaRDD<Tuple2<Integer, Integer>> userCandidates = candidates.map(
	                new Function<Integer, Tuple2<Integer, Integer>>() {
	                    /**
						 * 
						 */
						private static final long serialVersionUID = 1L;

						public Tuple2<Integer, Integer> call(Integer integer) throws Exception {
	                        return new Tuple2<Integer, Integer>(userId, integer);
	                    }
	                }
	        );
	        
	        //Predict recommendations for the given user
	        recommendations = model.predict(JavaPairRDD.fromJavaRDD(userCandidates)).collect();
	        
	        //Sorting the recommended products and sort them according to the rating
	        Collections.sort(recommendations, new Comparator<Rating>() {
	            public int compare(Rating r1, Rating r2) {
	                return r1.rating() < r2.rating() ? -1 : r1.rating() > r2.rating() ? 1 : 0;
	            }
	        });
	        
	        //get top 50 from the recommended products.
	        recommendations = recommendations.subList(0, 50);
	        sc.close();
	        return recommendations;
	}
}
