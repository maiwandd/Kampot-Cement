package me.campot.serverPi;


import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.*;
import java.util.stream.Collectors;

class Station {

    final String STN;
    final String NAME;
    private final String COUNTRY;
    private final String LATITUDE;
    private final String LONGITUDE;
    private final String ELEVATION;

    public static List<Station> testList;
    public static final HashMap<String, Station> testMap = new HashMap<>();

    private Station(String stn, String name, String country, String latitude, String longitude, String elevation){
        this.STN = stn;
        this.NAME = name;
        this.COUNTRY = country;
        this.LATITUDE = latitude;
        this.LONGITUDE = longitude;
        this.ELEVATION = elevation;
    }

    private static final Set<String> COUNTRIES = Set.of("CAMBODIA", "LAOS", "VIETNAM", "THAILAND");

    public static void generateList() {

        List<Station> list = new ArrayList<>();

        String csvFile = "stations.csv";
        String line = "";
        String cvsSplitBy = ";";

        try (BufferedReader br = new BufferedReader(new FileReader(csvFile))) {

            while ((line = br.readLine()) != null) {

                // use comma as separator
                String[] test = line.split(cvsSplitBy);
                list.add(new Station(test[0], test[1], test[2], test[3], test[4], test[5]));
            }

        } catch (IOException e) {
            e.printStackTrace();
        }

        List<Station> result = list.stream()
                .filter(a -> COUNTRIES.contains(a.COUNTRY))
                .collect(Collectors.toList());
        testList = result;
        for (Station r : result) {
            testMap.put(r.STN, r);
        }
    }
}