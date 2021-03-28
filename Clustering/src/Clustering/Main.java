package Clustering;

import org.apache.spark.SparkConf;
import org.apache.spark.SparkContext;
import org.apache.spark.mllib.linalg.Vector;
import java.util.ArrayList;


public class Main {
    public static java.util.Vector<String> Songs = new java.util.Vector<>();
    public static ArrayList<Vector> Clusters_featuers_to_2D = new ArrayList<Vector>();
    public static void main(String[] args) {

        System.setProperty("hadoop.home.dir", "F:\\2_Clustering\\external_libs\\hadoop-common-2.6.0-bin-master");
        SparkConf conf = new SparkConf().setAppName("Spark").setMaster("local[4]").setSparkHome("F:\\2_Clustering\\external_libs\\spark-2.1.0-bin-hadoop2.7\\README.md");
        SparkContext sc = new SparkContext(conf);

        int Clusters_num = 66;
        int Max_Itr = 100;

        ArrayList<Vector> Features_List = XML_Reader.Read_XML_File("F:\\Features values.xml");
        final long startTime = System.currentTimeMillis();
        Vector[] clusterCenters = KMeans_Clustering.KMeans_Clustering_Centers(sc,Features_List,Clusters_num,Max_Itr);
        final long time  = System.currentTimeMillis() - startTime;
        System.out.println(time);
        XML_Reader.saveToXML_clusterCenters(clusterCenters,"F:\\Clusters_Centers.xml");
        ArrayList<java.util.Vector<Double>> Clusters_indexes = PCA.PCA_To_2D(sc,Clusters_featuers_to_2D);
        XML_Reader.saveToXML_Clusters(Clusters,Clusters_indexes,"F:\\Clusters.xml");

        sc.stop();


    }
}
