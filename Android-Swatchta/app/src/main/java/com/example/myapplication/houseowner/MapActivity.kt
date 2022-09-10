package com.example.myapplication.houseowner

import android.Manifest
import android.content.pm.PackageManager
import android.location.Location
import android.os.Bundle
import android.widget.Toast
import androidx.core.app.ActivityCompat
import androidx.fragment.app.FragmentActivity
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
import com.google.android.gms.maps.model.MarkerOptions

class MapActivity : FragmentActivity(), OnMapReadyCallback ,GoogleMap.OnMarkerClickListener {

    private lateinit var mapFragment : SupportMapFragment
    private lateinit var lastlocation: Location
    private lateinit var fusedLocationClient: FusedLocationProviderClient
    private lateinit var mMap: GoogleMap


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_map)

        Toast.makeText(this, "5", Toast.LENGTH_SHORT).show()
        mapFragment = supportFragmentManager.findFragmentById(R.id.map) as SupportMapFragment
        mapFragment.getMapAsync(this)

        fusedLocationClient = LocationServices.getFusedLocationProviderClient(this)

    }

    override  fun onMapReady(googleMap: GoogleMap){
        mMap = googleMap
        mMap.uiSettings.isZoomControlsEnabled = true
        mMap.setOnMarkerClickListener(this)
        Toast.makeText(this, "1", Toast.LENGTH_SHORT).show()
        setUpMAP()
    }

    private fun setUpMAP() {
        Toast.makeText(this, "2", Toast.LENGTH_SHORT).show()
        if (ActivityCompat.checkSelfPermission(
                this,
                Manifest.permission.ACCESS_FINE_LOCATION
            ) != PackageManager.PERMISSION_GRANTED ) {
            ActivityCompat.requestPermissions(this, arrayOf( Manifest.permission.ACCESS_FINE_LOCATION),
                MapFragment.LOCATION_REQUEST_CODE
            )
            return
        }
        Toast.makeText(this, "here", Toast.LENGTH_SHORT).show()

        mMap.isMyLocationEnabled = true
        fusedLocationClient.lastLocation.addOnSuccessListener(this) { location ->

            if(location !=null){
                lastlocation = location
                val currentLatLong = LatLng(location.latitude,location.longitude)
                placeMarkerOnMap(currentLatLong)
                mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(currentLatLong,12f))
            }
        }
    }

    private fun placeMarkerOnMap(currentLatLong: LatLng) {
        val markerOptions = MarkerOptions().position(currentLatLong)
        markerOptions.title("$currentLatLong")
        mMap.addMarker(markerOptions)
    }
    override fun onMarkerClick(p0: Marker) = false
}