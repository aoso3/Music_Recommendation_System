package Clustering;

import static Clustering.Main.Clusters_featuers_to_2D;
import static Clustering.Main.Songs;

import org.apache.spark.api.java.JavaRDD;
import org.apache.spark.mllib.clustering.KMeans;
import org.apache.spark.mllib.linalg.Vector;
import org.apache.spark.SparkContext;
import org.apache.spark.api.java.JavaSparkContext;
import org.apache.spark.mllib.linalg.Matrix;
import org.apache.spark.mllib.linalg.distributed.RowMatrix;

import java.util.ArrayList;
import java.util.Collections;

public class KMeans_Clustering extends PCA {

    public static Vector[] KMeans_Clustering_Centers(SparkContext sc ,ArrayList<Vector> Featers_List , int Clusters_num , int Max_Itr ){
        ArrayList<Vector> localData = Featers_List;
        int slice_num = 24 ;
        JavaRDD<Vector> data = JavaSparkContext.fromSparkContext(sc).parallelize(localData,slice_num);
        org.apache.spark.mllib.clustering.KMeansModel model = KMeans.train(data.rdd(), Clusters_num, Max_Itr);
        Vector[] clusterCenters = model.clusterCenters();

        for (int i = 0; i < clusterCenters.length; i++) {
            Vector clusterCenter = clusterCenters[i];
        }

        return clusterCenters;
    }

}
