package com.example.controllongrange;

import androidx.appcompat.app.AppCompatActivity;

import android.bluetooth.BluetoothAdapter;
import android.bluetooth.BluetoothDevice;
import android.bluetooth.BluetoothSocket;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.view.WindowManager;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Spinner;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Set;
import java.util.UUID;

public class MainActivity extends AppCompatActivity {
    Spinner devices_show;
    BluetoothAdapter btadpt;
    Set<BluetoothDevice>btd;
    String address,prv="";

    BluetoothSocket btsh;
    UUID uuid=UUID.fromString("00001101-0000-1000-8000-00805F9B34FB");
    Runnable r;
    Handler h;
    StringRequest st;

    RequestQueue q;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        getWindow().addFlags(WindowManager.LayoutParams.FLAG_KEEP_SCREEN_ON);

        h=new Handler();
        devices_show=findViewById(R.id.bluetooth_devices);
        btadpt=BluetoothAdapter.getDefaultAdapter();
        if(btadpt.isEnabled())
        {
            btd=btadpt.getBondedDevices();
            ArrayList l=new ArrayList();
            l.add("-SELECT-");
            if (btd.size()>0)
            {
                for(BluetoothDevice d:btd)
                {
                    l.add(d.getAddress());
                }
                devices_show.setAdapter(new ArrayAdapter(this,android.R.layout.simple_expandable_list_item_1,l));
                devices_show.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
                    @Override
                    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                        if (position!=0)
                        {
                            address=devices_show.getSelectedItem().toString();
                            try
                            {
                                BluetoothDevice d=btadpt.getRemoteDevice(address);
                                btsh=d.createRfcommSocketToServiceRecord(uuid);
                                BluetoothAdapter.getDefaultAdapter().cancelDiscovery();
                                btsh.connect();
                                if (btsh.isConnected())
                                {
                                    msg("connected");
                                    h.postDelayed(r, 1000);
                                }
                                else {
                                    msg("not connected");
                                }
                            }catch (IOException e)
                            {

                            }
                        }
                    }

                    @Override
                    public void onNothingSelected(AdapterView<?> parent) {

                    }
                });
            }
            else {
                msg("No paired devices..!");
            }
        }
        else {
            msg("Please turn on Bluetooth");
            finish();
        }

        st=new StringRequest(Request.Method.POST, "https://souravsaha1234.000webhostapp.com/transfer/get.php", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                h.postDelayed(r,1000);
                response=response.trim();
                if (!prv.equals(response))
                {
                    send(response);
                    prv=response;
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                h.postDelayed(r,1000);
            }
        });
        q= Volley.newRequestQueue(getApplicationContext());

        //time exe
        r=new Runnable() {
            @Override
            public void run() {
                q.add(st);
                q.getCache().clear();
            }
        };

    }
    void msg(String s)
    {
        Toast.makeText(getApplicationContext(),s,Toast.LENGTH_SHORT).show();
    }
    void send(String s)
    {
        try {
            btsh.getOutputStream().write(s.getBytes());
        }catch (IOException e)
        {

        }
    }
}
