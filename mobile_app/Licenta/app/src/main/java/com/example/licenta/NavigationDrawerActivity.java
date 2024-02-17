package com.example.licenta;

import android.content.Intent;
import android.os.Bundle;

import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.android.material.snackbar.Snackbar;

import android.view.MenuItem;
import android.view.View;

import androidx.annotation.NonNull;
import androidx.core.view.GravityCompat;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;
import androidx.navigation.NavController;
import androidx.navigation.Navigation;
import androidx.navigation.ui.AppBarConfiguration;
import androidx.navigation.ui.NavigationUI;

import com.google.android.material.navigation.NavigationView;

import androidx.drawerlayout.widget.DrawerLayout;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.view.Menu;
import android.widget.TextView;
import android.widget.Toast;

public class NavigationDrawerActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {

    private AppBarConfiguration mAppBarConfiguration;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_navigation_drawer);


        Toolbar toolbar = findViewById(R.id.toolbar);
        TextView textViewEmail = findViewById(R.id.textView);


        setSupportActionBar(toolbar);
        FloatingActionButton fab = findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent Email = new Intent(Intent.ACTION_SEND);
                Email.setType("text/email");
                Email.putExtra(Intent.EXTRA_EMAIL,
                        new String[]{"diana.georgescu@gmail.com"});  //developer 's email
                Email.putExtra(Intent.EXTRA_SUBJECT,
                        "Adăugare subiect"); // Email 's Subject
                Email.putExtra(Intent.EXTRA_TEXT, "Dear Developer Name," + "");  //Email 's Greeting text
                startActivity(Intent.createChooser(Email, "Contact medic:"));
            }
        });
        DrawerLayout drawer = findViewById(R.id.drawer_layout);
        NavigationView navigationView = findViewById(R.id.nav_view);
       // navigationView.setNavigationItemSelectedListener(this);


        mAppBarConfiguration = new AppBarConfiguration.Builder(
                R.id.nav_home, R.id.nav_gallery, R.id.nav_slideshow,
                R.id.nav_tools, R.id.nav_share, R.id.nav_send,R.id.logout,R.id.nav_consultatie, R.id.nav_internare)
                .setDrawerLayout(drawer)
                .build();
        NavController navController = Navigation.findNavController(this, R.id.nav_host_fragment);
        NavigationUI.setupActionBarWithNavController(this, navController, mAppBarConfiguration);
        NavigationUI.setupWithNavController(navigationView, navController);
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem menuItem) {
        switch(menuItem.getItemId()){
            case R.id.gallery:
                GalleryFragment galleryFragment = new GalleryFragment();
                FragmentTransaction fragmentTransaction = getSupportFragmentManager().beginTransaction();
                fragmentTransaction.add(R.id.gallery, galleryFragment);
                fragmentTransaction.commit();
                break;
            case R.id.home:
                HomeFragment homeFragment = new HomeFragment();
                FragmentTransaction fragmentTransaction2 = getSupportFragmentManager().beginTransaction();
                fragmentTransaction2.add(R.id.home, homeFragment);
                fragmentTransaction2.commit();
                break;
            case R.id.share:
                ShareFragment shareFragment = new ShareFragment();
                FragmentTransaction fragmentTransaction3 = getSupportFragmentManager().beginTransaction();
                fragmentTransaction3.add(R.id.share, shareFragment);
                fragmentTransaction3.commit();
                break;
            case R.id.tools:
                ToolsFragment parametriFragment = new ToolsFragment();
                FragmentTransaction fragmentTransaction4 = getSupportFragmentManager().beginTransaction();
                fragmentTransaction4.add(R.id.tools, parametriFragment);
                fragmentTransaction4.commit();
                break;
            case R.id.send:
                SendFragment sendFragment = new SendFragment();
                FragmentTransaction fragmentTransaction5 = getSupportFragmentManager().beginTransaction();
                fragmentTransaction5.add(R.id.send, sendFragment);
                fragmentTransaction5.commit();
                break;
            case R.id.logout:
               //SharedPrefManager.getInstance(this).logout();
              // finish();
              // startActivity(new Intent(this,MainActivity.class));
                Toast.makeText(this,"ana",Toast.LENGTH_LONG).show();
               break;
            case R.id.consultatie:
                ConsultatieFragment consultatieFragment = new ConsultatieFragment();
                FragmentTransaction fragmentTransaction6 = getSupportFragmentManager().beginTransaction();
                fragmentTransaction6.add(R.id.consultatie, consultatieFragment);
                fragmentTransaction6.commit();
                break;
            case R.id.internari:
                InternariFragment internariFragment = new InternariFragment();
                FragmentTransaction fragmentTransaction7 = getSupportFragmentManager().beginTransaction();
                fragmentTransaction7.add(R.id.internari, internariFragment);
                fragmentTransaction7.commit();
                break;
        }
        return true;
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.navigation_drawer, menu);
        return true;
    }

    @Override
    public boolean onSupportNavigateUp() {
        NavController navController = Navigation.findNavController(this, R.id.nav_host_fragment);
        return NavigationUI.navigateUp(navController, mAppBarConfiguration)
                || super.onSupportNavigateUp();
    }
    public void onBackPressed() {
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        } else {
            super.onBackPressed();
        }
    }


}
