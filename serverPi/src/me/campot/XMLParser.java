package me.campot;

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


class XMLParser implements Runnable {

    private final String XML;

    public XMLParser(String xml) {
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

                    String[] tags = {"STN", "DATE", "TIME", "DEWP", "STP", "TEMP", "SLP",
                            "VISIB", "WDSP", "PRCP", "SNDP", "FRSHTT", "CLDC", "WNDDIR"};

                    HashMap<String, String> measurementData = new HashMap<>();

                    for (String tag : tags) {
                        measurementData.put(tag,
                                measurement.getElementsByTagName(tag).item(0).getTextContent());
                    }

                    AdjustData.correct(measurementData);

                    StringBuilder stringBuilder = new StringBuilder();
                    stringBuilder.append("\n(");

                    for (String tag : tags) {
                        if (tag.equals("DATE") || tag.equals("TIME") || tag.equals("FRSHTT")) {
                            stringBuilder.append("'");
                            stringBuilder.append(measurementData.get(tag));
                            stringBuilder.append("', ");
                        } else if (tag.equals("WNDDIR")) {
                            stringBuilder.append(measurementData.get(tag));
                            stringBuilder.append("),");
                        } else {
                            stringBuilder.append(measurementData.get(tag));
                            stringBuilder.append(", ");
                        }
                    }

                    str.append(stringBuilder);
                }

                System.out.println(str);

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