package com.example.licenta;

import android.app.Activity;
import android.app.Application;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.util.Log;
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

import androidx.recyclerview.widget.LinearLayoutManager;

public class Boli extends Application {
    private String s;


    public RequestQueue requestQueue;

    public void showToast (Context c){
        String pref = c.getSharedPreferences("PATH", Context.MODE_PRIVATE).getString("p", "Error");
        //Toast.makeText(c.getApplicationContext(), s + pref, Toast.LENGTH_LONG).show();
        s=pref;
    }

   /* public  static String[] denumire = new String[]{
            "Tuse convulsiva",
            "Hepatita A",
            "Pneumonie"

    };
    public static String[] data = new String[]{
            "25/09/2009",
            "25/07/2009",
            "25/08/2009",
            "25/08/2009",
            "25/08/2009",
            "25/08/2009",
            "25/08/2009",
            "25/08/2009",

    };
    public static String[] tratament = new String[]{
            "Nurofen",
            "Paracetamol",
            "Parasinus"

    };

    public  static String[] denumire;
    public  static String[] data;
    public  static String[] tratament;
*/

}





