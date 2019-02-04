package me.campot.serverPi;

import org.json.simple.JSONObject;
import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.NodeList;
import org.xml.sax.InputSource;
import org.xml.sax.SAXException;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;
import java.io.IOException;
import java.io.StringReader;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;


class XMLParser implements Runnable {

    private final String XML;

    XMLParser(String xml) {
        this.XML = xml;
    }

    @Override
    public void run() {
        try {
            DocumentBuilder documentBuilder = DocumentBuilderFactory.newInstance().newDocumentBuilder();
            InputSource inputSource = new InputSource();
            inputSource.setCharacterStream(new StringReader(XML));

            List<HashMap<String, String>> list = new ArrayList<>();
            HashMap<String, List<HashMap<String, String>>> topLevel = new HashMap<>();

            try {
                Document doc = documentBuilder.parse(inputSource);
                NodeList data = doc.getElementsByTagName("MEASUREMENT");

                int length = data.getLength();

                for (int i = 0; i < length; i++) {
                    Element measurement = (Element) data.item(i);

                    String[] tags = {"STN", "DATE", "TIME", "DEWP", "STP", "TEMP", "SLP",
                            "VISIB", "WDSP", "PRCP", "SNDP", "FRSHTT", "CLDC", "WNDDIR"};

                    HashMap<String, String> measurementData = new HashMap<>();

                    for (String tag : tags) {
                        measurementData.put(tag,
                                measurement.getElementsByTagName(tag).item(0).getTextContent());
                    }

                    AdjustData.correct(measurementData);

                    list.add(measurementData);
                    topLevel.put(measurement.getElementsByTagName("STN").item(0).getTextContent(), list);

                    AdjustData.test123(Long.toString(Thread.currentThread().getId()), new JSONObject(topLevel));

                }
            } catch (SAXException | IOException e) {
                e.printStackTrace();
                System.out.println(e.getMessage());
            }
        } catch (ParserConfigurationException pce) {
            System.out.println(pce.getMessage());
            pce.printStackTrace();
        }
    }
}