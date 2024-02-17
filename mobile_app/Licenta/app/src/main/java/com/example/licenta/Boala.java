package com.example.licenta;

public class Boala {
    private String data;
    private String tratament;
    private String denumire;

    public Boala() {
    }

    public Boala(String data, String tratament, String denumire) {
        this.data = data;
        this.tratament = tratament;
        this.denumire = denumire;
    }

    public String getData() {
        return data;
    }

    public void setData(String data) {
        this.data = data;
    }

    public String getTratament() {
        return tratament;
    }

    public void setTratament(String tratament) {
        this.tratament = tratament;
    }

    public String getDenumire() {
        return denumire;
    }

    public void setDenumire(String denumire) {
        this.denumire = denumire;
    }
}
