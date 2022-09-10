package com.example.myapplication.auth

import android.content.Intent
import android.os.Bundle
import android.view.View
import android.widget.ProgressBar
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.appcompat.widget.Toolbar
import com.example.myapplication.R
import com.example.myapplication.houseowner.HouseHoldMain
import com.example.myapplication.userdata.HouseUserData
import com.google.android.material.button.MaterialButton
import com.google.android.material.textfield.TextInputEditText
import com.google.firebase.auth.FirebaseAuth
import com.google.firebase.auth.ktx.auth
import com.google.firebase.database.DatabaseReference
import com.google.firebase.database.FirebaseDatabase
import com.google.firebase.ktx.Firebase

class HomeSignUpActivity : AppCompatActivity() {
    private var etEmail: TextInputEditText? =null
    private var etname: TextInputEditText? =null
    private var etPass: TextInputEditText? =null
    private var btnSignUp: MaterialButton? =null
    private var btnlogin: MaterialButton? =null
    private var progressBar: ProgressBar? = null

    // create Firebase authentication object
    private lateinit var auth: FirebaseAuth
    private lateinit var database: DatabaseReference


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_signup)

        //Toolbar Setup
        val toolbar = findViewById(R.id.toolbar) as Toolbar
        setSupportActionBar(toolbar)
        toolbar?.title = "Swachta 2.0"


        //database (realtime)
        database = FirebaseDatabase.getInstance().getReference("User")
        auth = Firebase.auth  // Initialising auth object

        // View Bindings
        progressBar = findViewById(R.id.createUser_pb)
        etEmail = findViewById(R.id.etemail)
        etname = findViewById(R.id.etname)
        etPass = findViewById(R.id.etpass)
        btnSignUp = findViewById(R.id.btnSSigned)
        btnlogin = findViewById(R.id.btn_login)

        btnSignUp!!.setOnClickListener {
            signUpUser()
        }

        btnlogin!!.setOnClickListener {
            val intent = Intent(this, LoginActivity::class.java)
            startActivity(intent)
            finish()
        }
    }

    private fun signUpUser() {
        val email = etEmail?.text.toString()
        val pass = etPass?.text.toString()
        val name = etname?.text.toString()
        var token = getSharedPreferences("userID", MODE_PRIVATE)

        // check pass
        if (email.isBlank() || pass.isBlank() || name.isBlank()) {
            Toast.makeText(this, "Email and Password can't be blank", Toast.LENGTH_SHORT).show()
            return
        }
        // If all credential are correct
        // We call createUserWithEmailAndPassword
        // using auth object and pass the
        // email and pass in it.
        auth.createUserWithEmailAndPassword(email, pass).addOnCompleteListener(this) {
            if (it.isSuccessful) {
                progressBar!!.visibility = View.VISIBLE
                Toast.makeText(this, "Successfully Singed Up", Toast.LENGTH_SHORT).show()
                saveData()
                val userId = auth.uid!!
                var editor = token.edit()
                editor.putString("loginUID",userId)
                editor.putString("type","HouseHold")
                editor.commit()

                val intent = Intent(this, HouseHoldMain::class.java)
                startActivity(intent)
                finish()
            } else {
                Toast.makeText(this, "Singed Up Failed!", Toast.LENGTH_SHORT).show()
            }
        }
    }

    //fun to save data on databse realtimet
    private fun saveData(){
        val email = etEmail?.text.toString()
        val name = etname?.text.toString()
        val userId = auth.uid!!
        var house = HouseUserData(email, name, "HouseHold","10")


        database.child(userId).setValue(house).addOnCompleteListener{}
    }

    override fun onBackPressed() {
        super.onBackPressed()
        val intent = Intent(this, SelectionActivity::class.java)
        startActivity(intent)
    }
}
