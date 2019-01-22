package me.campot.serverVM;

import java.util.ArrayList;
import java.util.List;

public class StationStorage {
    public List<String> data;
    public StationStorage() {
        this.data = new ArrayList<>();
    }
    public void addData(String input) {
        data.add(input);
    }
}