package me.campot.serverPi;

import java.io.File;
import java.io.FileWriter;
import java.time.LocalDateTime;

class Thoth extends Thread {
    public void run() {

        int hour = LocalDateTime.now().getHour();
        int year = LocalDateTime.now().getYear();
        int month = LocalDateTime.now().getMonthValue();
        int day = LocalDateTime.now().getDayOfMonth();

        String header = "STN,DATE,TIME,DEWP,STP,TEMP,SLP,VISIB,WDSP,PRCP,SNDP,FRSHTT,CLDC,WNDDIR";

        while (true) {
            String data = Queue.get();

            if (hour != LocalDateTime.now().getHour()) {
                hour = LocalDateTime.now().getHour();
            }
            if (year != LocalDateTime.now().getYear()) {
                year = LocalDateTime.now().getYear();
            }
            if (month != LocalDateTime.now().getMonthValue()) {
                month = LocalDateTime.now().getMonthValue();
            }
            if (day != LocalDateTime.now().getDayOfMonth()) {
                day = LocalDateTime.now().getDayOfMonth();
            }
            try {
                System.out.println(data);
                try {
                    String path = year + "/" + month + "/" + day + "/";
                    String filename = hour + ".csv";

                    File directory = new File(path);
                    File file = new File(path + filename);

                    if (! directory.exists()){
                        directory.mkdirs();
                    }
                    if (!file.exists()) {
                        file.createNewFile();
                        FileWriter fileWriter = new FileWriter(path + filename, true);
                        fileWriter.append(header);
                        fileWriter.flush();
                        fileWriter.close();
                    }
                    FileWriter fileWriter = new FileWriter(path + filename, true);
                    fileWriter.append(data);
                    fileWriter.flush();
                    fileWriter.close();
                } catch (Exception e) {
                    e.printStackTrace();

                }
                Thread.sleep(1000);
            } catch (InterruptedException e) {
                // TODO Auto-generated catch block
                e.printStackTrace();
            }
        }
    }
}
