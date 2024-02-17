package com.example.licenta;

import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.DialogFragment;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class MainActivity extends AppCompatActivity {
    private EditText email;
    private EditText parola;
    private TextView info;
    private Button login;
    public static List<Boala> BoliList;
    public static List<Vaccinuri> VaccinuriList;
    public static List<Consultatie> ConsultatiiList;
    public static List<Parametri> ParametriList;
    public static List<Internare> InternariList;
    public static InfoGen infoGen;
    public  static int id_pacient;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
       /* if(SharedPrefManager.getInstance(this).isLoggedIn()){
            finish();
            startActivity(new Intent(this, NavigationDrawerActivity.class));
            return;
        }*/

        email=(EditText) findViewById(R.id.editEmail);
        parola=(EditText) findViewById(R.id.editPassword);
        login =(Button)findViewById(R.id.buttonLogin);

        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                userLogin();
               id_pacient= SharedPrefManager.getInstance(getApplicationContext()).isLoggedIn();
               loadDataBoli();
               loadDataInformatiiGenerale();
               loadDataVaccinuri();
               loadDataParametri();
               //loadDataProgramare();
                loadDataConsultatii();
                loadDataInternare();

            }
        });

    }

   public void userLogin(){
       final String emailUser = email.getText().toString().trim();
       final String passwordUser = parola.getText().toString().trim();
       StringRequest stringRequest=new StringRequest(
               Request.Method.POST,
               Constants.URL_LOGIN,
               new Response.Listener<String>() {
                   public void onResponse(String response) {
                       try{
                           JSONObject obj = new JSONObject(response);
                           SharedPrefManager.getInstance(getApplicationContext()).userLogin(
                                   obj.getInt("id"),
                                   obj.getString("email")
                           );

                           if(obj.getBoolean("error")){

                               SharedPrefManager.getInstance(getApplicationContext()).userLogin(
                                       obj.getInt("id"),
                                       obj.getString("email")
                               );
                           }else{
                               Intent myIntent = new Intent(getApplicationContext(),NavigationDrawerActivity.class);
                               startActivity(myIntent);
                               finish();
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
                       Toast.makeText(
                               getApplicationContext(),
                               error.getMessage(),
                               Toast.LENGTH_LONG
                       ).show();
                   }
               }
       ){
           protected Map<String, String > getParams() throws AuthFailureError{
               Map<String,String> params = new HashMap<>();
               params.put("email", emailUser);
               params.put("password", passwordUser);
               return  params;
           }
       };
       RequestHandler.getInstance(this).addToRequestQueue(stringRequest);
   }

    public void loadDataBoli() {
        BoliList = new ArrayList<>();
        RequestQueue queue = Volley.newRequestQueue(this);
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, Constants.URL_BOLI+"?pacient="+id_pacient, null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                for (int i = 0; i < response.length(); i++) {
                    try {
                        JSONObject songObject = response.getJSONObject(i);
                        Boala b= new Boala();
                        b.setDenumire(songObject.getString("denumire").toString());
                        b.setData(songObject.getString("data").toString());
                        b.setTratament(songObject.getString("tratament").toString());
                        BoliList.add(b);
                        System.out.println(BoliList.get(i).getData());
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("tag", "onErrorResponse: " + error.getMessage());
            }
        });

        queue.add(jsonArrayRequest);
    }

    public void loadDataInformatiiGenerale() {
        infoGen= new InfoGen();
        RequestQueue queue = Volley.newRequestQueue(this);
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, Constants.URL_INFOGEN, null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                for (int i = 0; i < response.length(); i++) {
                    try {
                        JSONObject songObject = response.getJSONObject(i);
                        infoGen.setData_naster(songObject.getString("data_nastere").toString());
                        infoGen.setGreutate(songObject.getString("greutate").toString());
                        infoGen.setInaltime(songObject.getString("inaltime").toString());
                        infoGen.setGrupa_sange(songObject.getString("grupa_sange").toString());
                        infoGen.setPuls(songObject.getString("puls").toString());
                        infoGen.setRh(songObject.getString("rh").toString());
                        infoGen.setTensiune(songObject.getString("tensiune").toString());

                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("tag", "onErrorResponse: " + error.getMessage());
            }
        });

        queue.add(jsonArrayRequest);
    }

    public void loadDataVaccinuri() {
        VaccinuriList = new ArrayList<>();
        RequestQueue queue = Volley.newRequestQueue(this);
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, Constants.URL_VACCIN+"?pacient="+id_pacient, null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                for (int i = 0; i < response.length(); i++) {
                    try {
                        JSONObject songObject = response.getJSONObject(i);
                        Vaccinuri v= new Vaccinuri();
                        v.setDenumire(songObject.getString("denumire").toString());
                        v.setData(songObject.getString("data").toString());
                        VaccinuriList.add(v);
                        System.out.println(VaccinuriList.get(i).getData());
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("tag", "onErrorResponse: " + error.getMessage());
            }
        });

        queue.add(jsonArrayRequest);
    }

    public void loadDataParametri() {
        ParametriList = new ArrayList<>();
        RequestQueue queue = Volley.newRequestQueue(this);
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, Constants.URL_PARAMETRI+"?pacient="+id_pacient, null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                for (int i = 0; i < response.length(); i++) {
                    try {
                        JSONObject songObject = response.getJSONObject(i);
                        Parametri v= new Parametri();
                        v.setPuls(songObject.getString("puls").toString());
                        v.setTensiune(songObject.getString("tensiune").toString());
                        v.setInaltime(songObject.getString("inaltime").toString());
                        v.setGreutate(songObject.getString("greutate").toString());
                        v.setData(songObject.getString("data").toString());
                        ParametriList.add(v);
                        System.out.println(ParametriList.get(i).getPuls());
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("tag", "onErrorResponse: " + error.getMessage());
            }
        });

        queue.add(jsonArrayRequest);
    }

    public void loadDataConsultatii() {
        ConsultatiiList = new ArrayList<>();
        RequestQueue queue = Volley.newRequestQueue(this);
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, Constants.URL_CONSULTATIE+"?pacient="+id_pacient, null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                for (int i = 0; i < response.length(); i++) {
                    try {
                        JSONObject songObject = response.getJSONObject(i);
                        Consultatie v= new Consultatie();
                        v.setData_consultatie(songObject.getString("data_consultatie").toString());
                        v.setOra(songObject.getString("ora").toString());
                        v.setDiagnostic(songObject.getString("diagnostic").toString());
                        v.setTratament(songObject.getString("tratament").toString());
                        v.setPret(songObject.getString("pret").toString());
                        ConsultatiiList.add(v);
                        System.out.println(ConsultatiiList.get(i).getTratament());

                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("tag", "onErrorResponse: " + error.getMessage());
            }
        });

        queue.add(jsonArrayRequest);
    }
    public void loadDataInternare() {
        InternariList = new ArrayList<>();
        RequestQueue queue = Volley.newRequestQueue(this);
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, Constants.URL_INTERNARI+"?pacient="+id_pacient, null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                for (int i = 0; i < response.length(); i++) {
                    try {
                        JSONObject songObject = response.getJSONObject(i);
                        Internare v= new Internare();
                        v.setData_externare(songObject.getString("data_internare").toString());
                        v.setData_internare(songObject.getString("data_externare").toString());
                        v.setDiagnostic_externare(songObject.getString("diagnostic_externare").toString());
                        v.setDiagonstic_internare(songObject.getString("diagnostic_externare").toString());
                        v.setTratament(songObject.getString("tratament").toString());
                        v.setSpital(songObject.getString("spital").toString());
                        InternariList.add(v);
                        System.out.println(InternariList.get(i).getData_externare());
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }

            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("tag", "onErrorResponse: " + error.getMessage());
            }
        });

        queue.add(jsonArrayRequest);
    }
}
