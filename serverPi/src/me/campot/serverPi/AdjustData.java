package me.campot.serverPi;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map.Entry;
import java.util.Objects;

class AdjustData {

    private static final HashMap<String, ArrayList<HashMap<String, String>>> dataStorage = new HashMap<>();

    private static final int MAX_COUNTER = 30;

    /**
     *
     * @param data
     * @param missingValue
     * @param list
     */
    private static void Adjust(HashMap<String, String> data,
                               ArrayList<String> missingValue, ArrayList<HashMap<String, String>> list) {

        for (String key : missingValue) {

            int count = 0;
            double total = 0;

            for (HashMap<String, String> map : list) {
                total = total + Double.parseDouble(map.get(key));
                count++;
            }

            Double value = (double) Math.round((total / count) * 10) / 10;

            data.put(key, value.toString());
        }

        double totalTemp = 0;
        int countTemp = 0;

        for (HashMap<String, String> map : list) {
            totalTemp = totalTemp + Double.parseDouble(map.get("TEMP"));
            countTemp++;
        }

        Double value = (double) Math.round((totalTemp / countTemp) * 10) / 10;
        Double margin = value * 0.20;

        if (Double.parseDouble(data.get("TEMP")) > value + margin ||
                Double.parseDouble(data.get("TEMP")) < value - margin) {
            data.put("TEMP", value.toString());
        }

        list.add(data);
    }

    /**
     * Method to correct incoming data
     * @param data
     */
    static synchronized void correct(HashMap<String, String> data) {

        String stationnr = "0";
        ArrayList<String> missingValue = new ArrayList<>();
        for (Entry<String, String> entry : data.entrySet()) {

            String key = entry.getKey();
            String value = entry.getValue();

            if (Objects.equals(key, "STN")) {
                stationnr = value;
            }

            if (Objects.equals(value, "")) {
                missingValue.add(key);
            }

        }

        ArrayList<HashMap<String, String>> list = dataStorage.get(stationnr);

        if (list != null) {
            if (list.size() == MAX_COUNTER) {

                Adjust(data, missingValue, list);
                list.remove(0);
                list.trimToSize();
            } else {
                Adjust(data, missingValue, list);
            }
        } else {

            for (String key : missingValue) {
                data.put(key, "0.0");
            }

            list = new ArrayList<>();
            list.add(data);
        }

        dataStorage.put(stationnr, list);
    }
}