package Clustering;

import static Clustering.Main.Songs;

import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.DocumentBuilder;

import org.apache.spark.mllib.linalg.Vector;
import org.apache.spark.mllib.linalg.Vectors;
import org.w3c.dom.Document;
import org.w3c.dom.NodeList;
import org.w3c.dom.Node;
import org.w3c.dom.Element;
import java.io.File;
import javax.xml.parsers.*;
import javax.xml.transform.*;
import javax.xml.transform.dom.*;
import javax.xml.transform.stream.*;

import org.w3c.dom.*;

import java.util.*;


public class XML_Reader {

    public static ArrayList<Vector> Read_XML_File(String Path){

        ArrayList<Vector> Features_Vector_list = new ArrayList<>();
        ArrayList<Vector> Features_Vector_list_final = new ArrayList<>();

        try {

            File fXmlFile = new File(Path);
            DocumentBuilderFactory dbFactory = DocumentBuilderFactory.newInstance();
            DocumentBuilder dBuilder = dbFactory.newDocumentBuilder();
            Document doc = dBuilder.parse(fXmlFile);
            doc.getDocumentElement().normalize();
            NodeList nList = doc.getElementsByTagName("data_set");


            LinkedList<java.util.Vector<Double>> rowsList = new LinkedList<>();


            for (int temp = 0; temp < nList.getLength(); temp++) {

                Node nNode = nList.item(temp);

                if (nNode.getNodeType() == Node.ELEMENT_NODE) {

                    Element eElement = (Element) nNode;
                    Songs.add(eElement.getAttribute("id"));

                    String s = eElement.getElementsByTagName("MFCC").item(0).getTextContent();
                    String[] sarray = s.split(",");

                    int featuers_num = 12;
                    double [] featuers_array = new double[sarray.length +  featuers_num];
                    int i = 0;
                    for ( i = 0 ; i < sarray.length; i++) {
                        featuers_array[i] = Double.parseDouble(sarray[i]);
                    }
                    featuers_array[i++] =  Double.parseDouble(eElement.getElementsByTagName("Spectral_Centroid").item(0).getTextContent());
                    featuers_array[i++] =  Double.parseDouble(eElement.getElementsByTagName("Spectral_Flux").item(0).getTextContent());
                    featuers_array[i++] =  Double.parseDouble(eElement.getElementsByTagName("Spectral_Rolloff_Point").item(0).getTextContent());
                    featuers_array[i++] =  Double.parseDouble(eElement.getElementsByTagName("Spectral_Variability").item(0).getTextContent());
                    featuers_array[i++] =  Double.parseDouble(eElement.getElementsByTagName("Partial_Based_Spectral_Centroid").item(0).getTextContent());
                    featuers_array[i++] =  Double.parseDouble(eElement.getElementsByTagName("Peak_Based_Spectral_Smoothness").item(0).getTextContent());
                    featuers_array[i++] =  Double.parseDouble(eElement.getElementsByTagName("Zero_Crossings").item(0).getTextContent());
                    featuers_array[i++] =  Double.parseDouble(eElement.getElementsByTagName("Strongest_Frequency_Via_Zero_Crossings").item(0).getTextContent());
                    featuers_array[i++] =  Double.parseDouble(eElement.getElementsByTagName("Compactness").item(0).getTextContent());
                    featuers_array[i++] =  Double.parseDouble(eElement.getElementsByTagName("Strongest_Beat").item(0).getTextContent());
                    featuers_array[i++] =  Double.parseDouble(eElement.getElementsByTagName("Strength_Of_Strongest_Beat").item(0).getTextContent());
                    featuers_array[i++] =  Double.parseDouble(eElement.getElementsByTagName("Beat_Sum").item(0).getTextContent());



                    Features_Vector_list.add(Vectors.dense(featuers_array));

                }
            }
//            }

        }
        catch (Exception e) {
            e.getMessage();
        }

        return Features_Vector_list;
    }



    public static void saveToXML_clusterCenters(Vector[] clusterCenters , String xml) {

        try {

            DocumentBuilderFactory docFactory = DocumentBuilderFactory.newInstance();
            DocumentBuilder docBuilder = docFactory.newDocumentBuilder();

            // root elements
            Document doc = docBuilder.newDocument();
            Element rootElement = doc.createElement("Cluesters_Centers_File");
            doc.appendChild(rootElement);

            // staff elements
            Element data_set = doc.createElement("data_set");
            rootElement.appendChild(data_set);

            // set attribute to staff element
            Attr attr = doc.createAttribute("id");
            attr.setValue("1");
            data_set.setAttributeNode(attr);

            for (int i = 0; i < clusterCenters.length; i++) {
            Vector clusterCenter = clusterCenters[i];
                Element Cluster_Center = doc.createElement("Cluster_" + i);
                Cluster_Center.appendChild(doc.createTextNode(clusterCenter.toString().replace("[", "").replace("]", "").trim()));
                data_set.appendChild(Cluster_Center);

        }


            // write the content into xml file
            TransformerFactory transformerFactory = TransformerFactory.newInstance();
            Transformer transformer = transformerFactory.newTransformer();
            transformer.setOutputProperty(OutputKeys.ENCODING, "UTF-8");
            transformer.setOutputProperty(OutputKeys.INDENT, "yes");
            DOMSource source = new DOMSource(doc);
            StreamResult result = new StreamResult(new File(xml));

            transformer.transform(source, result);


        } catch (ParserConfigurationException pce) {
            pce.printStackTrace();
        } catch (TransformerException tfe) {
            tfe.printStackTrace();
        }
    }


    public static void saveToXML_Clusters (ArrayList<java.util.Vector<String>> Clusters , ArrayList<java.util.Vector<Double>> Clusters_indexes , String xml) {

        try {

            DocumentBuilderFactory docFactory = DocumentBuilderFactory.newInstance();
            DocumentBuilder docBuilder = docFactory.newDocumentBuilder();

            // root elements
            Document doc = docBuilder.newDocument();
            Element rootElement = doc.createElement("Cluesters_File");
            doc.appendChild(rootElement);



            int c =0 , song_num = 0;

                for(int y=0 ; y < Clusters.size() ; y++){
                int k=0;
                Element data_set = doc.createElement("data_set");
                rootElement.appendChild(data_set);
                Attr attr = doc.createAttribute("id");
                attr.setValue("Cluster : "+ c++);
                data_set.setAttributeNode(attr);
                    java.util.Vector<String> vec = Clusters.get(y);
                    for(int r = 0 ; r< vec.size() ; r++){
                    Element Cluster = doc.createElement("Song_" + k++);
                    Cluster.appendChild(doc.createTextNode(vec.get(r)));
                    data_set.appendChild(Cluster);

                    Element Cluster_index = doc.createElement("Song_" + k++ + "_index");
                        Cluster_index.appendChild(doc.createTextNode(Clusters_indexes.get(song_num++).toString()));
                    data_set.appendChild(Cluster_index);
                }
            }


            TransformerFactory transformerFactory = TransformerFactory.newInstance();
            Transformer transformer = transformerFactory.newTransformer();
            transformer.setOutputProperty(OutputKeys.ENCODING, "UTF-8");
            transformer.setOutputProperty(OutputKeys.INDENT, "yes");
            DOMSource source = new DOMSource(doc);
            StreamResult result = new StreamResult(new File(xml));

            transformer.transform(source, result);


        } catch (ParserConfigurationException pce) {
            pce.printStackTrace();
        } catch (TransformerException tfe) {
            tfe.printStackTrace();
        }
    }




}


