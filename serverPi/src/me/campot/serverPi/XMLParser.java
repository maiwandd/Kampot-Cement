package me.campot.serverPi;

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
import java.util.HashMap;
import java.util.LinkedHashMap;

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

            try {
                Document doc = documentBuilder.parse(inputSource);
                NodeList data = doc.getElementsByTagName("MEASUREMENT");
                StringBuilder str = new StringBuilder();
                int length = data.getLength();

                for (int i = 0; i < length; i++) {

                    Element measurement = (Element) data.item(i);
                    String time = measurement.getElementsByTagName("TIME").item(0).getTextContent();

                    if (Integer.parseInt(time.substring(time.length() - 1)) % 5 == 0) {
                        if (Station.testMap.containsKey(measurement.getElementsByTagName("STN").item(0).getTextContent())) {

                            String[] tags = {"STN", "DATE", "TIME", "DEWP", "STP", "TEMP", "SLP",
                                    "VISIB", "WDSP", "PRCP", "SNDP", "FRSHTT", "CLDC", "WNDDIR"};

                            HashMap<String, String> measurementData = new LinkedHashMap<>();

                            for (String tag : tags) {
                                measurementData.put(tag,
                                        measurement.getElementsByTagName(tag).item(0).getTextContent());
                            }

                            AdjustData.Correct(measurementData);

                            StringBuilder stringBuilder = new StringBuilder();
                            stringBuilder.append("\n");

                            for (String tag : tags) {
                                if (!tag.equals("WNDDIR")) {
                                    stringBuilder.append(measurementData.get(tag));
                                    stringBuilder.append(",");
                                } else {
                                    stringBuilder.append(measurementData.get(tag));
                                }
                            }
                            str.append(stringBuilder);
                        }
                    }
                }
                Queue.add(str);
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