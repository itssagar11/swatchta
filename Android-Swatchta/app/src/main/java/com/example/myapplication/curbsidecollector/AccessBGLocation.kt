package com.example.myapplication.curbsidecollector

import android.Manifest
import android.R
import android.app.AlarmManager
import android.app.Notification
import android.app.PendingIntent
import android.app.Service
import android.content.Intent
import android.content.pm.PackageManager
import android.os.Build
import android.os.IBinder
import android.os.Looper
import android.widget.Toast
import androidx.core.app.ActivityCompat
import androidx.core.app.NotificationCompat
import com.example.myapplication.App.Companion.CHANNEL_ID
import com.example.myapplication.houseowner.AlarmBroadcast
import com.example.myapplication.userdata.CurbsideLocationActivity
import com.google.android.gms.location.*
import com.google.android.gms.maps.model.LatLng
import com.google.firebase.auth.FirebaseAuth
import com.google.firebase.auth.ktx.auth
import com.google.firebase.database.DatabaseReference
import com.google.firebase.database.FirebaseDatabase
import com.google.firebase.ktx.Firebase
import java.text.SimpleDateFormat
import java.util.*


class AccessBGLocation: Service() {


    private lateinit var auth: FirebaseAuth
    private lateinit var fusedLocationClient: FusedLocationProviderClient
    private lateinit var database: DatabaseReference
    private lateinit var database2: DatabaseReference
    private lateinit var database3: DatabaseReference
    private var loop_value = 0
    private lateinit var alarmManager: AlarmManager
    private lateinit var calender: Calendar
    private  var realTime:Int = 0
    private lateinit var simpleDateFormate: SimpleDateFormat
    private var x =0
    //remeber to make it true while performing there
    private var curbsideInside = true

    private val locationRequest: LocationRequest = LocationRequest.create().apply {
        interval = 7000
        fastestInterval = 9000
        priority = LocationRequest.PRIORITY_BALANCED_POWER_ACCURACY
        maxWaitTime = 10000
    }

    private var locationCallback: LocationCallback = object : LocationCallback() {
        override fun onLocationResult(locationResult: LocationResult) {
            database = FirebaseDatabase.getInstance().getReference("CurbsideUID")
            database2 = FirebaseDatabase.getInstance().getReference("CurbsideUserLocation")
            database3 = FirebaseDatabase.getInstance().getReference("User")

            var token = getSharedPreferences("userID", MODE_PRIVATE)
            val locationList = locationResult.locations
            if (locationList.isNotEmpty()) {
                val location = locationList.last()
                val currentLatLong = LatLng(location.latitude.toDouble(),location.longitude.toDouble())

                if(token.getString("loginUID"," ")!=" "){
                    //condition to check if household or curbsdie
                    if(token.getString("type"," ") == "HouseHold"){

                        calender = Calendar.getInstance()
                        simpleDateFormate = SimpleDateFormat("HH")
                        realTime = Integer.parseInt(simpleDateFormate.format(calender.time))
                        if(realTime == 24){
                            curbsideInside = true
                        }
                        if(curbsideInside){
                            checkRadius(currentLatLong)
                        }
                        //write condition to only occur after some time
                        //if()

                    }else{
                        val userId = auth.uid!!
                        var locationdb = CurbsideLocationActivity((location.latitude).toString(),(location.longitude).toString(),"no")
                        database2.child(userId).setValue(locationdb).addOnCompleteListener{}
                    }
                }
            }
        }
    }


    private fun checkRadius(location: LatLng) {

        database = FirebaseDatabase.getInstance().getReference("CurbsideUID")
        database2 = FirebaseDatabase.getInstance().getReference("CurbsideUserLocation")
        database3 = FirebaseDatabase.getInstance().getReference("User")

        var loop = 0
        database.child("curbCount").get().addOnSuccessListener{
            loop = it.value.toString().toInt()
            loop_value = loop
            for(i in 0..loop){
                database.child(i.toString()).get().addOnSuccessListener {
                    var userID = it.value.toString()
                    database2.child(userID).get().addOnSuccessListener{
                        val enable = it.child("enable").value.toString()
                        if(enable == "yes"){
                            if(it.child("latitude").value.toString() != "null"){
                                var latitude = it.child("latitude").value.toString()
                                var longitude = it.child("longitude").value.toString()
                                database3.child(userID).get().addOnSuccessListener {
                                    val currentLatLong = LatLng(latitude.toDouble(),longitude.toDouble())
                                    var distance = CalculationByDistance(location,currentLatLong)
                                    if (distance < 10) {
                                        curbsideInside = false
                                        alarmManager = getSystemService(ALARM_SERVICE) as AlarmManager
                                        val intent = Intent(this, AlarmBroadcast::class.java)
                                        val pendingIntent = PendingIntent.getBroadcast(
                                            this,
                                            111,
                                            intent,
                                            PendingIntent.FLAG_IMMUTABLE or PendingIntent.FLAG_CANCEL_CURRENT)
                                        alarmManager.set(AlarmManager.RTC_WAKEUP,System.currentTimeMillis()+ 1000,pendingIntent)
                                    }
                                }.addOnFailureListener{}
                            }
                        }
                    }.addOnFailureListener{}
                }.addOnFailureListener{}
            }
        }
    }

    fun CalculationByDistance(StartP: LatLng, EndP: LatLng): Double {
        val Radius = 6371 // radius of earth in Km
        val lat1 = StartP.latitude
        val lat2 = EndP.latitude
        val lon1 = StartP.longitude
        val lon2 = EndP.longitude
        val dLat = Math.toRadians(lat2 - lat1)
        val dLon = Math.toRadians(lon2 - lon1)
        val a = (Math.sin(dLat / 2) * Math.sin(dLat / 2)
                + (Math.cos(Math.toRadians(lat1))
                * Math.cos(Math.toRadians(lat2)) * Math.sin(dLon / 2)
                * Math.sin(dLon / 2)))
        val c = 2 * Math.asin(Math.sqrt(a))
        val valueResult = Radius * c
       // val km = valueResult / 1
       // val newFormat = DecimalFormat("####")
       // val kmInDec: Int = Integer.valueOf(newFormat.format(km))
        val meter = valueResult % 1000
      //  val meterInDec: Int = Integer.valueOf(newFormat.format(meter))
        return meter
    }


    override fun onCreate() {
        super.onCreate()

        auth = Firebase.auth
        database = FirebaseDatabase.getInstance().getReference("CurbsideUID")
        database2 = FirebaseDatabase.getInstance().getReference("CurbsideUserLocation")
        database3 = FirebaseDatabase.getInstance().getReference("User")


        fusedLocationClient = LocationServices.getFusedLocationProviderClient(this)

        if (Build.VERSION.SDK_INT > Build.VERSION_CODES.O) else startForeground(2, Notification())

        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION)
            != PackageManager.PERMISSION_GRANTED
            && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION)
            != PackageManager.PERMISSION_GRANTED) {

            Toast.makeText(applicationContext, "Permission required", Toast.LENGTH_LONG).show()
            return
        }else {
            fusedLocationClient?.requestLocationUpdates(
                locationRequest,
                locationCallback,
                Looper.getMainLooper()
            )
        }
    }

    override fun onStartCommand(intent: Intent?, flags: Int, startId: Int): Int {
        val input = intent!!.getStringExtra("inputExtra")

        val notificationIntent = Intent(this, CurbsideMain::class.java)
        val pendingIntent = PendingIntent.getActivity(
            applicationContext,
            0,
            notificationIntent,
            PendingIntent.FLAG_IMMUTABLE or PendingIntent.FLAG_CANCEL_CURRENT
        )

        val notification: Notification = NotificationCompat.Builder(this, CHANNEL_ID)
            .setContentTitle("Swachta")
            .setContentText(input)
            .setSmallIcon(R.drawable.ic_delete)
            .setContentIntent(pendingIntent)
            .setOngoing(true)
            .build()


        startForeground(1, notification)

        //do heavy work on a background thread
        //stopSelf();


        //do heavy work on a background thread
        //stopSelf();
        return START_STICKY
    }

    override fun onDestroy() {
        super.onDestroy()
        fusedLocationClient.removeLocationUpdates(locationCallback)
    }

    override fun onBind(p0: Intent?): IBinder? {
       return null
    }
}