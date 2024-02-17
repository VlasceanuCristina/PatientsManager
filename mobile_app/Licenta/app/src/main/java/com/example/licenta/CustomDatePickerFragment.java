package com.example.licenta;

import android.app.DatePickerDialog;
import android.app.Dialog;
import android.content.Context;
import android.os.Bundle;
import android.view.ViewGroup;
import android.widget.DatePicker;
import android.widget.Toast;

import java.util.Calendar;

import androidx.fragment.app.DialogFragment;

public class CustomDatePickerFragment extends DialogFragment {
    //Context thiscontext;
    @Override
    public Dialog onCreateDialog(Bundle savedInstanceState) {
        final Calendar calendar = Calendar.getInstance();
        int year = calendar.get(Calendar.YEAR);
        int month = calendar.get(Calendar.MONTH);
        int day = calendar.get(Calendar.DAY_OF_MONTH);
        //thiscontext = container.getContext();
        return new DatePickerDialog(getActivity(), dateSetListener, year, month, day);
    }

    private DatePickerDialog.OnDateSetListener dateSetListener =
            new DatePickerDialog.OnDateSetListener() {

                public void onDateSet(DatePicker view, int year, int month, int day) {
                    Toast.makeText(getActivity(), "Data selectata este:  " + view.getYear() +
                            " / " + (view.getMonth() + 1) +
                            " / " + view.getDayOfMonth(), Toast.LENGTH_SHORT).show();
                    String datasel;
                    if((view.getMonth()+1)<10){
                        datasel= view.getYear() +
                                "/0" + (view.getMonth() + 1) +
                                "/" + view.getDayOfMonth();
                    }
                    else{
                        if(view.getDayOfMonth()<10){
                             datasel= view.getYear() +
                                    "/" + (view.getMonth() + 1) +
                                    "/0" + view.getDayOfMonth();
                        }
                        else{
                            if(((view.getMonth()+1)<10) || (view.getDayOfMonth()<10)){
                                datasel= view.getYear() +
                                        "/0" + (view.getMonth() + 1) +
                                        "/0" + view.getDayOfMonth();
                            }
                            else{
                                 datasel= view.getYear() +
                                        "/" + (view.getMonth() + 1) +
                                        "/" + view.getDayOfMonth();
                            }
                        }
                    }

                    SharedPrefManager.getInstance(getActivity()).setData(datasel);
                }
            };
}
