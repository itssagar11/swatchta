package com.example.myapplication.ui

import android.Manifest
import android.content.pm.PackageManager
import android.location.Location
import android.os.Bundle
import android.os.Handler
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.core.app.ActivityCompat
import androidx.fragment.app.Fragment
import com.example.myapplication.R
import com.google.android.gms.location.FusedLocationProviderClient
import com.google.android.gms.location.LocationServices
import com.google.android.gms.maps.CameraUpdateFactory
import com.google.android.gms.maps.GoogleMap
import com.google.android.gms.maps.OnMapReadyCallback
import com.google.android.gms.maps.SupportMapFragment
import com.google.android.gms.maps.model.*
import com.google.android.material.card.MaterialCardView
import com.google.firebase.database.DatabaseReference
import com.google.firebase.database.FirebaseDatabase


// TODO: Rename parameter arguments, choose names that match
// the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
private const val ARG_PARAM1 = "param1"
private const val ARG_PARAM2 = "param2"

/**
 * A simple [Fragment] subclass.
 * Use the [MapMain.newInstance] factory method to
 * create an instance of this fragment.
 */
class MapFragment : Fragment() , OnMapReadyCallback ,GoogleMap.OnMarkerClickListener {
    // TODO: Rename and change types of parameters
    private var param1: String? = null
    private var param2: String? = null

    private lateinit var lastlocation: Location
    private lateinit var fusedLocationClient: FusedLocationProviderClient
    private lateinit var mapFragment : SupportMapFragment
    private var mMap: GoogleMap?= null

    private lateinit var database: DatabaseReference
    private lateinit var database2: DatabaseReference
    private lateinit var database3: DatabaseReference
    private lateinit var myIcon: BitmapDescriptor
    private lateinit var mHandler: Handler
    private var locationArrayList: ArrayList<Marker?> = ArrayList()
    private var location: ArrayList<Location> = ArrayList()
    private var loop_value = 0
    private var cardView: MaterialCardView? = null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        arguments?.let {
            param1 = it.getString(ARG_PARAM1)
            param2 = it.getString(ARG_PARAM2)
        }

    }

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        return inflater.inflate(R.layout.fragment_map_main, container, false)
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {

        cardView = getView()?.findViewById(R.id.cardmap) as MaterialCardView
        database = FirebaseDatabase.getInstance().getReference("CurbsideUID")
        database2 = FirebaseDatabase.getInstance().getReference("CurbsideUserLocation")
        database3 = FirebaseDatabase.getInstance().getReference("User")

        if(mMap == null){
            mapFragment = childFragmentManager.findFragmentById(R.id.map2) as SupportMapFragment
            mapFragment.getMapAsync(this)
        }
        fusedLocationClient = LocationServices.getFusedLocationProviderClient(requireActivity())
    }



    override  fun onMapReady(googleMap: GoogleMap){
        mMap = googleMap
        mMap!!.uiSettings.isZoomControlsEnabled = true
        mMap!!.setOnMarkerClickListener(this)
        setUpMAP()
    }

    private fun setUpMAP() {


        if (ActivityCompat.checkSelfPermission(
                requireActivity(),
                Manifest.permission.ACCESS_FINE_LOCATION
            ) != PackageManager.PERMISSION_GRANTED ) {
            ActivityCompat.requestPermissions(requireActivity(), arrayOf( Manifest.permission.ACCESS_FINE_LOCATION),
                LOCATION_REQUEST_CODE)
            return
        }

        mMap!!.isMyLocationEnabled = true
        fusedLocationClient.lastLocation.addOnSuccessListener(requireActivity()) { location ->
            //for household marker
            if(location !=null){
                lastlocation = location
                val currentLatLong = LatLng(location.latitude,location.longitude)
                mMap!!.animateCamera(CameraUpdateFactory.newLatLngZoom(currentLatLong,16f))
            }
        }
        curbsideMarker()
    }

    private var mStatusChecker: Runnable = object : Runnable {
        override fun run() {
            try {
                 updatecurbsideMarker() //this function can change value of mInterval.
            } finally {
                // 100% guarantee that this always happens, even if
                // your update method throws an exception
                //dont change this value of daley ...muktiple marker will occur
                mHandler.postDelayed(this,100)
            }
        }
    }

    //for curbside marker
    public fun curbsideMarker() {
        var loop = 0
        locationArrayList.clear()
        location.clear()
        database.child("curbCount").get().addOnSuccessListener{
            loop = it.value.toString().toInt()
            loop_value = loop
            for(i in 0..loop){
                database.child(i.toString()).get().addOnSuccessListener {
                    var userID = it.value.toString()
                    database2.child(userID).get().addOnSuccessListener{
                        val enable = it.child("enable").value.toString()
                            if(it.child("latitude").value.toString() != "null"){
                                var latitude = it.child("latitude").value.toString()
                                var longitude = it.child("longitude").value.toString()
                                database3.child(userID).get().addOnSuccessListener {
                                    var name = it.child("name").value.toString()
                                    val currentLatLong = LatLng(latitude.toDouble(),longitude.toDouble())
                                        placeMarkerOnMap(currentLatLong, name,enable)
                                }.addOnFailureListener{}
                            }
                    }.addOnFailureListener{}
                }.addOnFailureListener{}
            }
        }
    }


    private fun placeMarkerOnMap(currentLatLong: LatLng,name: String,enable: String) {
        //initial curbside location
        var local: Location = Location("dummyprovider");
        local.latitude = currentLatLong.latitude
        local.longitude = currentLatLong.longitude
        location.add(local)

        val markerOption = MarkerOptions().position(currentLatLong)
        markerOption.title(name)
        markerOption.rotation(local.bearing)
        markerOption.anchor(0.5.toFloat(), 0.5.toFloat())
        markerOption.icon(BitmapDescriptorFactory.fromResource(com.example.myapplication.R.drawable.garbagetruck))
        var userMarkerLocation = mMap!!.addMarker(markerOption)
        //marker location of curbside
        locationArrayList.add(userMarkerLocation)
        mHandler = Handler()
        mStatusChecker.run()
    }

    private fun updatecurbsideMarker() {
        var loop = 0
        database.child("curbCount").get().addOnSuccessListener{
            loop = it.value.toString().toInt()
            if(loop != loop_value){
                curbsideMarker()
            }
            for(i in 0..loop){
                database.child(i.toString()).get().addOnSuccessListener {
                    var userID = it.value.toString()
                    database2.child(userID).get().addOnSuccessListener{
                            val enable = it.child("enable").value.toString()
                            if (it.child("latitude").value.toString() != "null") {
                                var latitude = it.child("latitude").value.toString()
                                var longitude = it.child("longitude").value.toString()
                                database3.child(userID).get().addOnSuccessListener {
                                    var name = it.child("name").value.toString()
                                    val currentLatLong = LatLng(latitude.toDouble(), longitude.toDouble())
                                        updateMarkerOnMap(currentLatLong, name, i,enable)
                                }.addOnFailureListener {}
                            }
                    }.addOnFailureListener{}
                }.addOnFailureListener{}
            }
        }
    }


    private fun updateMarkerOnMap(currentLatLong: LatLng,name: String,i: Int, enable: String) {
//        if(enable == "no"){
//            locationArrayList.get(i)?.isVisible = false
//            return
//        }else {
//            locationArrayList.get(i)?.isVisible = true
//        }
        if(location.isEmpty() || locationArrayList.isEmpty()){
            //when coming back to this frag the above condition is true then we restart frag...its taking 5 sec to resart until that the code goes like that only
            //childFragmentManager.beginTransaction().detach(mapFragment).attach(mapFragment).commit()
            return
        }else{


            val latlong = LatLng(currentLatLong.latitude,currentLatLong.longitude)
            locationArrayList.get(i)?.position = latlong
            locationArrayList.get(i)?.rotation = location.get(i).bearing

        }
    }

    override fun onMarkerClick(p0: Marker) = false

    companion object {

        const val LOCATION_REQUEST_CODE = 1
        const val CAMERA_REQUEST_CODE = 2

        /**
         * Use this factory method to create a new instance of
         * this fragment using the provided parameters.
         *
         * @param param1 Parameter 1.
         * @param param2 Parameter 2.
         * @return A new instance of fragment MapMain.
         */
        // TODO: Rename and change types and number of parameters
        @JvmStatic
        fun newInstance(param1: String, param2: String) =
            MapFragment().apply {
                arguments = Bundle().apply {
                    putString(ARG_PARAM1, param1)
                    putString(ARG_PARAM2, param2)
                }
            }
    }
    override fun onDestroy() {
        super.onDestroy()
        stopRepeatingTask()
    }
    override fun onResume() {
        super.onResume()
    }

    private fun stopRepeatingTask() {
        mHandler.removeCallbacks(mStatusChecker);
    }
}
