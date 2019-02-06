package me.campot.serverPi;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map.Entry;
import java.util.Objects;

class AdjustData {

    private static final HashMap<String, ArrayList<HashMap<String, String>>> dataStorage = new HashMap<>();

    private static final int MAX_LIST_SIZE = 30;

    /**
     * Method to correct the incoming data if necessary. Method receives data, missing values and a list of
     * historical data to, if necessary, correct measurements based on historical data.
     *
     * @param data         data received from the weather stations, possibly including placeholder values
     * @param missingValue a list containing keys that hold placeholder values
     * @param list         historical data used to extrapolate a new value if necessary
     */
    private static void Adjust(HashMap<String, String> data,
                               ArrayList<String> missingValue, ArrayList<HashMap<String, String>> list) {

        for (String key : missingValue) {

            int i = 0;
            double total = 0;

            for (HashMap<String, String> map : list) {
                total = total + Double.parseDouble(map.get(key));
                i++;
            }

            Double value = (double) Math.round((total / i) * 10) / 10;

            if (!key.equals("FRSHTT")) {
                data.put(key, value.toString());
            } else {
                data.put(key, "000000");
            }
        }

        int i = 0;
        double total = 0;

        for (HashMap<String, String> map : list) {
            total = total + Double.parseDouble(map.get("TEMP"));
            i++;
        }

        Double value = (double) Math.round((total / i) * 10) / 10;
        Double margin = value * 0.20;

        if (Double.parseDouble(data.get("TEMP")) > value + margin ||
                Double.parseDouble(data.get("TEMP")) < value - margin) {
            data.put("TEMP", value.toString());
        }

        list.add(data);
    }

    /**
     * Method to correct the incoming data if necessary. Method checks if any measurements are missing,
     * if so it adds a placeholder value, and then calls Adjust() to make adjustments to the measurements
     * if necessary.
     *
     * @param data raw data received from the weather stations
     */
    static synchronized void Correct(HashMap<String, String> data) {

        String stn = null;
        ArrayList<String> missingValue = new ArrayList<>();

        for (Entry<String, String> entry : data.entrySet()) {

            String key = entry.getKey();
            String value = entry.getValue();

            if (Objects.equals(key, "STN")) {
                stn = value;
            }

            if (Objects.equals(value, "")) {
                missingValue.add(key);
            }

        }

        ArrayList<HashMap<String, String>> list = dataStorage.get(stn);

        if (list != null) {
            if (list.size() == MAX_LIST_SIZE) {

                Adjust(data, missingValue, list);
                list.remove(0);
                list.trimToSize();
            } else {
                Adjust(data, missingValue, list);
            }
        } else {
            for (String key : missingValue) {
                if (!key.equals("FRSHTT")) {
                    data.put(key, "0.0");
                } else {
                    data.put(key, "000000");
                }
            }
            list = new ArrayList<>();
            list.add(data);
        }
        dataStorage.put(stn, list);
    }
}