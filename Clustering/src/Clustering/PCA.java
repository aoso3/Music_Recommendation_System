package Clustering;

import org.apache.spark.SparkContext;
import org.apache.spark.api.java.JavaRDD;
import org.apache.spark.api.java.JavaSparkContext;
import org.apache.spark.mllib.linalg.Matrix;
import org.apache.spark.mllib.linalg.distributed.RowMatrix;

import java.util.ArrayList;
import java.util.Vector;


public class PCA {

    public static  ArrayList<java.util.Vector<Double>> PCA_To_2D(SparkContext sc , ArrayList<org.apache.spark.mllib.linalg.Vector> Features_List ){

        JavaRDD<org.apache.spark.mllib.linalg.Vector> rows = JavaSparkContext.fromSparkContext(sc).parallelize(Features_List);

        // Create a RowMatrix from JavaRDD<Vector>.
        RowMatrix mat = new RowMatrix(rows.rdd());
        // Compute the top 3 principal components.
        Matrix pc = mat.computePrincipalComponents(2);
        RowMatrix projected = mat.multiply(pc);
        // $example off$
        org.apache.spark.mllib.linalg.Vector[] collectPartitions = (org.apache.spark.mllib.linalg.Vector[])projected.rows().collect();
        ArrayList<java.util.Vector<Double>> finalcollectPartitions = new ArrayList<java.util.Vector<Double>>();

        for (org.apache.spark.mllib.linalg.Vector vector : collectPartitions) {
            double[] arr = vector.toArray();
            java.util.Vector<Double> temp_vec = new java.util.Vector<Double>();
            for(int y=0; y < arr.length; y++) {
                if(y==0) {
                    double t = arr[y]/1000000;
                    while (t > 180)
                        t--;
                    temp_vec.add(t);
                }
                else
                {
                    double t = arr[y]/100000;
                    while (t > 90)
                        t--;
                    temp_vec.add(t);
                }

            }
            finalcollectPartitions.add(temp_vec);

        }

        return finalcollectPartitions;
    }


}
