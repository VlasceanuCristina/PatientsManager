package com.example.licenta;

public class Internare {
    String data_internare;
    String spital;
    String data_externare;

    public String getData_internare() {
        return data_internare;
    }

    public void setData_internare(String data_internare) {
        this.data_internare = data_internare;
    }

    public Internare() {
    }

    public String getSpital() {
        return spital;
    }

    public void setSpital(String spital) {
        this.spital = spital;
    }

    public String getData_externare() {
        return data_externare;
    }

    public void setData_externare(String data_externare) {
        this.data_externare = data_externare;
    }

    public String getTratament() {
        return tratament;
    }

    public void setTratament(String tratament) {
        this.tratament = tratament;
    }

    public String getDiagonstic_internare() {
        return diagonstic_internare;
    }

    public void setDiagonstic_internare(String diagonstic_internare) {
        this.diagonstic_internare = diagonstic_internare;
    }

    public String getDiagnostic_externare() {
        return diagnostic_externare;
    }

    public void setDiagnostic_externare(String diagnostic_externare) {
        this.diagnostic_externare = diagnostic_externare;
    }

    String tratament;
    String diagonstic_internare;
    String diagnostic_externare;
}
