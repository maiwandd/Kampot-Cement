package me.campot.serverPi;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.Socket;

class WorkerRunnable implements Runnable {
    private final Socket clientSocket;

    WorkerRunnable(Socket clientSocket) {
        this.clientSocket = clientSocket;
    }

    @Override
    public void run() {

        try {
            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));
            StringBuilder stringBuilder = new StringBuilder();
            try {
                String currentLine;
                boolean recording = false;
                while ((currentLine = bufferedReader.readLine()) != null) {
                    if (currentLine.contains("<?xml version=\"1.0\"?>")) {
                        recording = true;
                    }

                    if (recording) {
                        stringBuilder.append(currentLine);
                    }

                    if (currentLine.contains("</WEATHERDATA>")) {
                        recording = false;

                        (new XMLParser(stringBuilder.toString())).run();

                        stringBuilder.setLength(0);
                    }
                }
            } catch (Exception e) {
                e.printStackTrace();
                System.out.println(e.getMessage());
            }
        } catch (Exception e) {
            e.printStackTrace();
            System.out.println(e.getMessage());
        }
    }
}
