package com.example.licenta;

public class Consultatie {
    String data_consultatie;
    String ora;

    public Consultatie() {
    }

    public String getData_consultatie() {
        return data_consultatie;
    }

    public void setData_consultatie(String data_consultatie) {
        this.data_consultatie = data_consultatie;
    }

    public String getOra() {
        return ora;
    }

    public void setOra(String ora) {
        this.ora = ora;
    }

    public String getPret() {
        return pret;
    }

    public void setPret(String pret) {
        this.pret = pret;
    }

    public String getDiagnostic() {
        return diagnostic;
    }

    public void setDiagnostic(String diagnostic) {
        this.diagnostic = diagnostic;
    }

    public String getTratament() {
        return tratament;
    }

    public void setTratament(String tratament) {
        this.tratament = tratament;
    }

    String pret;
    String diagnostic;
    String tratament;
}
