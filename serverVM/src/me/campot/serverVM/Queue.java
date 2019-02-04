package me.campot.serverVM;

class Queue {

    private static final StringBuilder measurementData = new StringBuilder();
    private static final StringBuilder queue = new StringBuilder();

    private static boolean locked;

    public static synchronized void add(StringBuilder row) {

        if (!locked) {

            int len = queue.length();

            if (len != 0) {
                measurementData.append(queue);
                queue.setLength(0);
                measurementData.append(row);
            } else {
                measurementData.append(row);
            }
        } else {
            queue.append(row);
        }
    }

    public static synchronized String get() {

        locked = true;

        StringBuilder stringBuilder = new StringBuilder(measurementData);
        measurementData.setLength(0);
        System.out.println(measurementData);
        locked = false;

        String test = "";

        int length = stringBuilder.length();

        if (length != 0) {
            StringBuilder builder = new StringBuilder();
            //stringBuilder.setLength(Math.max(length - 1, 0));

            builder.append(stringBuilder);

            //test = "" + stringBuilder.toString();
            return String.valueOf(builder);
        }
        return test;
    }
}