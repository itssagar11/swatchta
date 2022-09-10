package com.example.myapplication.auth

import android.Manifest
import android.content.Intent
import android.content.pm.PackageManager
import android.os.Bundle
import android.os.Handler
import android.view.View
import android.widget.ProgressBar
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import com.example.myapplication.R
import com.example.myapplication.curbsidecollector.CurbsideMain
import com.example.myapplication.houseowner.HouseHoldMain
import com.example.myapplication.ui.MapFragment
import com.google.android.material.button.MaterialButton
import com.google.android.material.textfield.TextInputEditText
import com.google.firebase.auth.FirebaseAuth
import com.google.firebase.database.DatabaseReference
import com.google.firebase.database.FirebaseDatabase


class LoginActivity : AppCompatActivity() {

    private var tvRedirectSignUp: MaterialButton? =null
    private var btnLogin: MaterialButton? =null
    private var etEmail: TextInputEditText? = null
    private var etPass: TextInputEditText? = null
    private var progressbar: ProgressBar?=null
    private val handler = Handler()

    // Creating firebaseAuth object
    lateinit var auth: FirebaseAuth
    private lateinit var database: DatabaseReference


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)
        var token = getSharedPreferences("userID", MODE_PRIVATE)

        if (ActivityCompat.checkSelfPermission(
                this,
                Manifest.permission.ACCESS_FINE_LOCATION
            ) != PackageManager.PERMISSION_GRANTED ) {
            ActivityCompat.requestPermissions(this, arrayOf(Manifest.permission.CAMERA,
                                Manifest.permission.ACCESS_FINE_LOCATION),
                MapFragment.LOCATION_REQUEST_CODE
            )
        }
//        if (ActivityCompat.checkSelfPermission(
//                this,
//                Manifest.permission.REQUEST_IGNORE_BATTERY_OPTIMIZATIONS
//            ) != PackageManager.PERMISSION_GRANTED ) {
//            ActivityCompat.requestPermissions(this, arrayOf( Manifest.permission.REQUEST_IGNORE_BATTERY_OPTIMIZATIONS),
//                MapFragment.LOCATION_REQUEST_CODE
//            )
//2       }
//        if (ActivityCompat.checkSelfPermission(
//                this,
//                Manifest.permission.CAMERA
//            ) != PackageManager.PERMISSION_GRANTED ) {
//            ActivityCompat.requestPermissions(this, arrayOf( Manifest.permission.CAMERA),
//                MapFragment.CAMERA_REQUEST_CODE
//            )
//        }


        if(token.getString("loginUID"," ")!=" "){
            if(token.getString("type"," ") == "HouseHold"){
                val intent = Intent(this, HouseHoldMain::class.java)
                startActivity(intent)
                finish()
            }
            else if(token.getString("type"," ") == "Curbside"){
                val intent = Intent(this, CurbsideMain::class.java)
                startActivity(intent)
                finish()
            }else {
                Toast.makeText(this, "Problem arrived", Toast.LENGTH_SHORT).show()
            }
        }


        database = FirebaseDatabase.getInstance().getReference("User")

        // View Binding
        tvRedirectSignUp = findViewById(R.id.tvRedirectSignUp)
        btnLogin = findViewById(R.id.btnLogin)
        etEmail = findViewById(R.id.etEmailAddress)
        etPass = findViewById(R.id.etPassword)
        progressbar = findViewById(R.id.login_pb)

        // initialising Firebase auth object
        auth = FirebaseAuth.getInstance()


        btnLogin!!.setOnClickListener {
            login()
        }
        tvRedirectSignUp!!.setOnClickListener {
            val intent = Intent(this, SelectionActivity::class.java)
            startActivity(intent)
            finish()
        }
    }

    private fun login() {
        progressbar?.visibility = View.VISIBLE
        val email = etEmail?.text.toString()
        val pass = etPass?.text.toString()
        // calling signInWithEmailAndPassword(email, pass)
        // function using Firebase auth object
        // On successful response Display a Toast
        if(email.isEmpty() || pass.isEmpty()){
            Toast.makeText(this, "Email or Pass Cannot be empty", Toast.LENGTH_SHORT).show()
        }
        auth.signInWithEmailAndPassword(email, pass).addOnCompleteListener(this) {
            if (it.isSuccessful) {
                Toast.makeText(this, "Successfully LoggedIn", Toast.LENGTH_SHORT).show()
                getAndOpen()
            } else{
                Toast.makeText(this, "Log In failed ", Toast.LENGTH_SHORT).show()
                handler.postDelayed(object :Runnable{
                    override fun run(){
                        progressbar?.visibility = View.INVISIBLE
                    }
                },2000)
            }
        }
    }

    private fun getAndOpen(){
        val userId = auth.uid!!
        var token = getSharedPreferences("userID", MODE_PRIVATE)
        database.child(userId).get().addOnSuccessListener {
            var type = it.child("type").value.toString()
            if(type == "HouseHold" ){
                Toast.makeText(this, "here 2", Toast.LENGTH_SHORT).show()
                var editor = token.edit()
                editor.putString("loginUID",userId)
                editor.putString("type","HouseHold")
                editor.commit()
                val intent = Intent(this, HouseHoldMain::class.java)
                startActivity(intent)

                finish()
            }else {
                var editor = token.edit()
                editor.putString("loginUID",userId)
                editor.putString("type","Curbside")
                editor.commit()
                val intent = Intent(this, CurbsideMain::class.java)
                startActivity(intent)
                finish()
            }
        }
    }



    override fun onBackPressed() {
        super.onBackPressed()
        moveTaskToBack(true);
    }
}
