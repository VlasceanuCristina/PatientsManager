package com.example.licenta;

public class Parametri {
    private String puls;
    private String data;

    public String getData() {
        return data;
    }

    public void setData(String data) {
        this.data = data;
    }

    public Parametri() {
    }

    public String getPuls() {
        return puls;
    }

    public void setPuls(String puls) {
        this.puls = puls;
    }

    public String getTensiune() {
        return tensiune;
    }

    public void setTensiune(String tensiune) {
        this.tensiune = tensiune;
    }

    public String getInaltime() {
        return inaltime;
    }

    public void setInaltime(String inaltime) {
        this.inaltime = inaltime;
    }

    public String getGreutate() {
        return greutate;
    }

    public void setGreutate(String greutate) {
        this.greutate = greutate;
    }

    private String tensiune;
    private String inaltime;
    private String greutate;
}
