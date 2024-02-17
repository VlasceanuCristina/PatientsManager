package com.example.licenta;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.Observer;
import androidx.lifecycle.ViewModelProviders;

public class HomeFragment extends Fragment {
    private TextView data_nastere;
    private TextView puls;
    private TextView tensiune;
    private TextView inaltime;
    private TextView greutate;
    private TextView grupa_sange;
    private TextView rh;


    private TextView data_nasterec;
    private TextView pulsc;
    private TextView tensiunec;
    private TextView inaltimec;
    private TextView greutatec;
    private TextView grupa_sangec;
    private TextView rhc;
    public View onCreateView(@NonNull LayoutInflater inflater,
                             ViewGroup container, Bundle savedInstanceState) {

        View root = inflater.inflate(R.layout.fragment_home, container, false);
        data_nastere=(TextView) root.findViewById(R.id.textView_data_nastere);
        puls=(TextView) root.findViewById(R.id.textView_puls);
        tensiune=(TextView) root.findViewById(R.id.textView_tensiune);
        grupa_sange=(TextView) root.findViewById(R.id.textView_grupa_sange);
        rh=(TextView) root.findViewById(R.id.textView_rh);
        greutate=(TextView) root.findViewById(R.id.textView_greutate);
        inaltime=(TextView) root.findViewById(R.id.textView_inaltime);


        data_nasterec=(TextView) root.findViewById(R.id.textView_data_nasterec);
        pulsc=(TextView) root.findViewById(R.id.textView_pulsc);
        tensiunec=(TextView) root.findViewById(R.id.textView_tensiunec);
        grupa_sangec=(TextView) root.findViewById(R.id.textView_grupa_sangec);
        rhc=(TextView) root.findViewById(R.id.textView_rhc);
        greutatec=(TextView) root.findViewById(R.id.textView_greutatec);
        inaltimec=(TextView) root.findViewById(R.id.textView_inaltimec);


        inaltime.setText(MainActivity.infoGen.getInaltime()+" m");
        greutate.setText(MainActivity.infoGen.getGreutate()+" kg");
        data_nastere.setText(MainActivity.infoGen.getData_naster());
        puls.setText(MainActivity.infoGen.getPuls()+" batai/min");
        tensiune.setText(MainActivity.infoGen.getTensiune()+" mm Hg");
        grupa_sange.setText(MainActivity.infoGen.getGrupa_sange());
        rh.setText(MainActivity.infoGen.getRh());



        return root;
    }
}
