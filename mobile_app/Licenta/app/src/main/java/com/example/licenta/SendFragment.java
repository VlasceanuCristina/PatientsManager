package com.example.licenta;

import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import androidx.annotation.NonNull;
import androidx.fragment.app.DialogFragment;
import androidx.fragment.app.Fragment;

public class SendFragment extends Fragment {
    public static Programare programare;
    Context thiscontext;
    private TextView datac;
    private TextView numec;
    private TextView orac;
    private TextView prenumec;

    private Button data;
    private Button save;
    private EditText nume;
    private EditText ora;
    private EditText prenume;
    private Spinner spinner;

    public View onCreateView(@NonNull LayoutInflater inflater,
                             ViewGroup container, Bundle savedInstanceState) {

        View root = inflater.inflate(R.layout.fragment_send, container, false);
        thiscontext = container.getContext();

        numec=(TextView) root.findViewById(R.id.textView_nume);
        prenumec=(TextView) root.findViewById(R.id.textView_prenume);
        orac=(TextView) root.findViewById(R.id.textView_ora);


        prenume=(EditText) root.findViewById(R.id.editText_prenume);
        nume=(EditText) root.findViewById(R.id.editText_nume);
        data=(Button) root.findViewById(R.id.button_data);
        save=(Button) root.findViewById(R.id.save);

        spinner = (Spinner) root.findViewById(R.id.SpinnerFeedbackType);


        /*programare=new Programare();
        programare.setNume(nume.getText().toString());
        programare.setPrenume(prenume.getText().toString());
        programare.setData(CustomDatePickerFragment.datasel);
        programare.setOra("10:00AM-10:30AM");*/
        System.out.println(nume.getText().toString());
        System.out.println(prenume.getText().toString());
        System.out.println("10:00AM-10:30AM");

        data.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                DialogFragment newFragment = new CustomDatePickerFragment();
                newFragment.show(getFragmentManager() , "DatePicker");
            }
        });

        save.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                loadDataProgramare();
                Toast.makeText(getActivity(), "Programare facuta cu succes:" ,
                       Toast.LENGTH_LONG).show();

            }
        });

        return root;
    }

    public void loadDataProgramare(){
        StringRequest stringRequest=new StringRequest(
                Request.Method.POST,
                Constants.URL_PROGRAMARE,
                new Response.Listener<String>() {
                    public void onResponse(String response) {
                        try{
                            JSONObject obj = new JSONObject(response);
                           /* SharedPrefManager.getInstance(getApplicationContext()).userLogin(
                                    obj.getInt("id"),
                                    obj.getString("email")
                            );*/

                            if(obj.getBoolean("error")){

                               /* SharedPrefManager.getInstance(getApplicationContext()).userLogin(
                                        obj.getInt("id"),
                                        obj.getString("email")
                                );*/
                            }else{
                               /* Intent myIntent = new Intent(getApplicationContext(),NavigationDrawerActivity.class);
                                startActivity(myIntent);
                                finish();*/
                            }
                        }
                        catch (JSONException e){
                            e.printStackTrace();
                        }

                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {

                    }
                }
        ){
            protected Map<String, String > getParams() throws AuthFailureError {
                Map<String,String> params = new HashMap<>();
                params.put("nume", nume.getText().toString());
                params.put("prenume", prenume.getText().toString() );
                String datasel= SharedPrefManager.getInstance(thiscontext).getData();
                params.put("data", datasel);
                System.out.println(datasel);
                params.put("ora",spinner.getSelectedItem().toString());
                System.out.println(spinner.getSelectedItem().toString());
                int id_pacient= SharedPrefManager.getInstance(thiscontext).isLoggedIn();
                System.out.println(id_pacient);
                params.put("id_pacient",String.valueOf(id_pacient));
                return  params;
            }
        };
        RequestHandler.getInstance(thiscontext).addToRequestQueue(stringRequest);
    }
}
