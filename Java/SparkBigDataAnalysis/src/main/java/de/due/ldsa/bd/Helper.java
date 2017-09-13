package de.due.ldsa.bd;

import java.io.File;
import java.util.Arrays;
import java.util.HashMap;
import org.apache.spark.api.java.JavaRDD;
import org.apache.spark.api.java.JavaSparkContext;
import org.apache.spark.api.java.function.Function;
import org.apache.spark.api.java.function.Function2;
import org.apache.spark.mllib.clustering.KMeans;
import org.apache.spark.mllib.clustering.KMeansModel;
import org.apache.spark.mllib.feature.HashingTF;
import org.apache.spark.mllib.linalg.Vector;
import org.apache.spark.streaming.Time;
import org.apache.spark.streaming.api.java.JavaDStream;
import org.apache.spark.streaming.api.java.JavaStreamingContext;
import twitter4j.Status;

/**
 * Helper Class for accessing different useful functions
 * 
 * @author Abdul Qadir
 *
 */
public class Helper {
	private static int numFeatures = 1000;
	private static HashingTF tf = new HashingTF(numFeatures);

	/**
	 * A method to configure twitter credentials
	 * 
	 * @param apiKey
	 * @param apiSecret
	 * @param accessToken
	 * @param accessTokenSecret
	 * @throws Exception
	 */
	public static void configureTwitterCredentials(String apiKey, String apiSecret, String accessToken,
			String accessTokenSecret) throws Exception {
		HashMap<String, String> configs = new HashMap<String, String>();
		configs.put("apiKey", apiKey);
		configs.put("apiSecret", apiSecret);
		configs.put("accessToken", accessToken);
		configs.put("accessTokenSecret", accessTokenSecret);

		Object[] keys = configs.keySet().toArray();
		for (int k = 0; k < keys.length; k++) {
			String key = keys[k].toString();
			String value = configs.get(key).trim();
			if (value.isEmpty()) {
				throw new Exception("Error setting authentication - value for " + key + " not set");
			}
			String fullKey = "twitter4j.oauth." + key.replace("api", "consumer");
			System.setProperty(fullKey, value);
			System.out.println("\tProperty " + key + " set as [" + value + "]");
		}
		System.out.println();
	}

	/**
	 * A method to get texts from tweets
	 * 
	 * @param tweets
	 * @return
	 */
	public static JavaDStream<Iterable<String>> getTweets(JavaDStream<Status> tweets) {
		JavaDStream<Iterable<String>> statuses = tweets.map(new Function<Status, Iterable<String>>() {

			private static final long serialVersionUID = 1L;

			public Iterable<String> call(Status status) {
				return Arrays.asList(status.getText());
			}
		});
		return statuses;
	}

	/**
	 * A method to store tweets as a text file to project resources
	 * 
	 * @param tweets
	 */
	public static void storeTweets(JavaDStream<Status> tweets) {
		tweets.foreachRDD(new Function2<JavaRDD<Status>, Time, Void>() {
			private static final long serialVersionUID = 1L;

			public Void call(JavaRDD<Status> rdd, Time t) throws Exception {
				long count = rdd.count();
				if (count > 0) {
					JavaRDD<Status> outputRDD = rdd.repartition(1);
					outputRDD.saveAsTextFile("src/main/resources" + "/tweets_" + t.milliseconds());
					if (t.milliseconds() > 240000)
						System.exit(1);
				}
				return null;
			}
		});
	}

	/**
	 * A method to store texts from tweets as a text file to project resources
	 * 
	 * @param tweets
	 */
	public static void storeTweetsText(JavaDStream<Status> tweets) {
		JavaDStream<String> statuses = null;
		statuses = tweets.map(new Function<Status, String>() {

			private static final long serialVersionUID = 1L;

			public String call(Status status) {
				return status.getText();
			}
		});
		statuses.foreachRDD(new Function2<JavaRDD<String>, Time, Void>() {
			private static final long serialVersionUID = 1L;

			public Void call(JavaRDD<String> rdd, Time t) throws Exception {
				long count = rdd.count();
				if (count > 0) {
					JavaRDD<String> outputRDD = rdd.repartition(1);
					outputRDD.saveAsTextFile("src/main/resources" + "/tweets_" + t.milliseconds());
					if (t.milliseconds() > 400000)
						System.exit(1);
				}
				return null;
			}
		});
	}

	/**
	 * A method to featurize a bunch of tweets in RDD
	 * 
	 * @param tweet
	 * @return
	 */
	public static JavaRDD<Vector> featurizeRDDVector(JavaRDD<Iterable<String>> tweet) {
		return tf.transform(tweet);
	}

	/**
	 * A method to featurize a tweet in String
	 * 
	 * @param tweet
	 * @return
	 */
	public static Vector featurizeVector(Iterable<String> tweet) {
		return tf.transform(tweet);
	}

	/**
	 * A method to train KMeans model
	 * 
	 * @param parsedTweets
	 * @return
	 */
	public static KMeansModel trainModel(JavaRDD<Vector> parsedTweets) {
		return KMeans.train(parsedTweets.rdd(), 5, 20);
	}

	/**
	 * A method to save KMeans model
	 * 
	 * @param sc
	 * @param model
	 */
	public static void saveModel(JavaSparkContext sc, KMeansModel model) {
		model.save(sc.sc(), "src/main/resources/model");
	}

	/**
	 * A method to load model for offline analysis
	 * 
	 * @param sc
	 * @return
	 */
	public static KMeansModel loadModel(JavaSparkContext sc) {
		return KMeansModel.load(sc.sc(), "src/main/resources/model");
	}

	/**
	 * A method to load model for streaming analysis
	 * 
	 * @param ssc
	 * @return
	 */
	public static KMeansModel streamingLoadModel(JavaStreamingContext ssc) {
		return KMeansModel.load(ssc.sparkContext().sc(), "src/main/resources/model");
	}

	/**
	 * A method to convert and cache the tweets in vector form
	 * 
	 * @param tweet
	 * @return
	 */
	public static JavaRDD<Vector> parsedTweets(JavaRDD<Iterable<String>> tweet) {
		JavaRDD<Vector> parsed = featurizeRDDVector(tweet);
		parsed.cache().count();
		return parsed;
	}

	/**
	 * get Twitter API Key
	 * @return
	 */
	public static String getApiKey() {
		return "RdhGlqKgDsThdiekp8XDXw14t";
	}

	/**
	 * get Twitter API Secret
	 * @return
	 */
	public static String getApiSecret() {
		return "fbYl3vPpaARwXzuPX3ybnX3077V8AhK3i9W4fMWfEvJiRdcNm2";
	}

	/**
	 * get Twitter Access Token
	 * @return
	 */
	public static String getAccessToken() {
		return "225134966-i8Im3J3ZgZCp1pQOc254ZsbQ9fZjjRQbmDsy29mE";
	}

	/**
	 * get Twitter Access Token Secret
	 * @return
	 */
	public static String getAccessTokenSecret() {
		return "CSveFoqqmP75GUdYiQj9o5VgJ6V8LBOMIGrKmGUtUtg4k";
	}

	/**
	 * Setting Windows Property
	 */
	public static void setProperty() {
		String exePath = "src/main/resources/WinUtils/";
		File exeFile = new File(exePath);
		System.setProperty("hadoop.home.dir", exeFile.getAbsolutePath());
	}
}
