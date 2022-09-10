package com.example.myapplication.curbsidecollector

import android.Manifest
import android.content.Intent
import android.content.pm.PackageManager
import android.location.Location
import android.os.Bundle
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import com.example.myapplication.R
import com.example.myapplication.ui.MapFragment
import com.google.android.gms.location.FusedLocationProviderClient
import com.google.android.gms.location.LocationServices
import com.google.android.gms.maps.CameraUpdateFactory
import com.google.android.gms.maps.GoogleMap
import com.google.android.gms.maps.OnMapReadyCallback
import com.google.android.gms.maps.SupportMapFragment
import com.google.android.gms.maps.model.LatLng
import com.google.android.gms.maps.model.Marker
import com.google.android.material.button.MaterialButton
import com.google.android.material.switchmaterial.SwitchMaterial
import com.google.firebase.auth.FirebaseAuth
import com.google.firebase.auth.ktx.auth
import com.google.firebase.database.DatabaseReference
import com.google.firebase.database.FirebaseDatabase
import com.google.firebase.ktx.Firebase

class CurbsideMain: AppCompatActivity(), OnMapReadyCallback, GoogleMap.OnMarkerClickListener{

    private lateinit var mapFragment : SupportMapFragment
    private lateinit var lastlocation: Location
    private lateinit var fusedLocationClient: FusedLocationProviderClient
    private lateinit var mMap: GoogleMap

    private lateinit var auth: FirebaseAuth
    private lateinit var database: DatabaseReference


    private lateinit var livelocBtn: SwitchMaterial
    private lateinit var vcomplaintBtn: MaterialButton
//   private lateinit var mHandler: Handler
//
//    var mLocationService: LocationAccess = LocationAccess()
//    lateinit var mServiceIntent: Intent


    override fun onCreate(savedInstanceState: Bundle?) {
        super<AppCompatActivity>.onCreate(savedInstanceState)
        setContentView(R.layout.activity_curbsidemain)


        livelocBtn = findViewById(R.id.liveLocation)
        vcomplaintBtn = findViewById(R.id.vcomplaint)

        database = FirebaseDatabase.getInstance().getReference("CurbsideUserLocation")
        auth = Firebase.auth
        val userID = auth.uid.toString()

        mapFragment = supportFragmentManager.findFragmentById(R.id.map) as SupportMapFragment
        mapFragment.getMapAsync(this)

        fusedLocationClient = LocationServices.getFusedLocationProviderClient(this)

        livelocBtn.setOnClickListener {
            if(livelocBtn.isChecked){
                callUpdateLocation()
                database.child(userID).child("enable").setValue("yes").addOnCanceledListener {  }
                Toast.makeText(this, "service started", Toast.LENGTH_SHORT).show()
            }else{
                val intent2 = Intent(this, AccessBGLocation::class.java)
                stopService(intent2);
                database.child(userID).child("enable").setValue("no").addOnCanceledListener {  }
                Toast.makeText(this, "service stopped", Toast.LENGTH_SHORT).show()
            }
        }

        vcomplaintBtn.setOnClickListener{
            val intent = Intent(this, ViewComplaint::class.java)
            startActivity(intent)
        }

    }
    override  fun onMapReady(googleMap: GoogleMap){
        mMap = googleMap
        mMap.uiSettings.isZoomControlsEnabled = true
        mMap.setOnMarkerClickListener(this)
        setUpMAP()
//        mHandler = Handler()
//        mStatusChecker.run();
    }

    private fun setUpMAP() {
        if (ActivityCompat.checkSelfPermission(
                this,
                Manifest.permission.ACCESS_FINE_LOCATION
            ) != PackageManager.PERMISSION_GRANTED ) {
            ActivityCompat.requestPermissions(this, arrayOf( Manifest.permission.ACCESS_FINE_LOCATION),
                MapFragment.LOCATION_REQUEST_CODE
            )
        }
        if (ActivityCompat.checkSelfPermission(this,
                Manifest.permission.ACCESS_BACKGROUND_LOCATION)
            != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this, arrayOf( Manifest.permission.ACCESS_BACKGROUND_LOCATION),
                MapFragment.LOCATION_REQUEST_CODE
            )
        }

        mMap.isMyLocationEnabled = true
        fusedLocationClient.lastLocation.addOnSuccessListener(this) { location ->

            if(location !=null){
                lastlocation = location
                //saving in databse
                val currentLatLong = LatLng(location.latitude,location.longitude)
                mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(currentLatLong,16f))
            }
        }
    }

    private fun callUpdateLocation() {
        val serviceIntent = Intent(this, AccessBGLocation::class.java)
        serviceIntent.putExtra("inputExtra", "Live Location Shared")
        ContextCompat.startForegroundService(this, serviceIntent);

    }

//    private var mStatusChecker: Runnable = object : Runnable {
//        override fun run() {
//            try {
//                setUpMAP() //this function can change value of mInterval.
//            } finally {
//                // 100% guarantee that this always happens, even if
//                // your update method throws an exception
//                mHandler.postDelayed(this,1000)
//            }
//        }
//    }

//    private fun placeMarkerOnMap(currentLatLong: LatLng) {
//        val markerOptions = MarkerOptions().position(currentLatLong)
//        markerOptions.title("$currentLatLong")
//        mMap.addMarker(markerOptions)
//    }
    override fun onMarkerClick(p0: Marker) = false

    override fun onDestroy() {
        super<AppCompatActivity>.onDestroy()
      //  stopRepeatingTask()
    }
//    private fun stopRepeatingTask() {
//        mHandler.removeCallbacks(mStatusChecker);
//    }

}