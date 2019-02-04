package me.campot.serverPi;

import java.io.IOException;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.concurrent.ArrayBlockingQueue;
import java.util.concurrent.BlockingQueue;
import java.util.concurrent.TimeUnit;

class Main {
    /**
     * Main method that initiates the threadpool and listens for connections in a endless loop.
     *
     * @param args The port number the system needs to listen to provided via commandline.
     */
    public static void main(String[] args) {

        int portNumber = Integer.parseInt(args[0]);

        if (args.length != 1) {
            System.err.println("Usage: java -jar serverPi <port number>");
            System.exit(1);
        }

        // Filter incoming data based on customer needs
        Station.generateList();
        // Print stations to console
        for (Station tl : Station.testList) {
            System.out.println("STN: " + tl.STN + " is named " + tl.NAME);
        }

        new Thoth().start();

        // Initialize BlockingQueue
        BlockingQueue<Runnable> blockingQueue = new ArrayBlockingQueue<>(200);
        // Initialize ThreadPool
        CustomThreadPoolExecutor executor = new CustomThreadPoolExecutor(800,
                1000, 5000, TimeUnit.MILLISECONDS, blockingQueue);

        executor.setRejectedExecutionHandler((r, executor1) -> {
            try {
                Thread.sleep(25);
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
            executor1.execute(r);
        });

        // Create all threads before accepting connections in order to reduce initial load
        executor.prestartAllCoreThreads();

        try {
            ServerSocket serverSocket = new ServerSocket(portNumber);

            while (true) {
                Socket clientSocket = serverSocket.accept();
                executor.execute(new WorkerRunnable(clientSocket));
            }
        } catch (IOException e) {
            System.out.println("Exception caught when trying to listen on port "
                    + portNumber + " or listening for a connection");
            System.out.println(e.getMessage());
        }
    }
}
