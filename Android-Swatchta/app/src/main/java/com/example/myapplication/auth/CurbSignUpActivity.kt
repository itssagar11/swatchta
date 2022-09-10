package com.example.myapplication.auth

import android.content.Intent
import android.os.Bundle
import android.view.View
import android.widget.ProgressBar
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.appcompat.widget.Toolbar
import com.example.myapplication.R
import com.example.myapplication.curbsidecollector.CurbsideMain
import com.example.myapplication.userdata.UserActivity
import com.google.android.material.button.MaterialButton
import com.google.android.material.textfield.TextInputEditText
import com.google.firebase.auth.FirebaseAuth
import com.google.firebase.auth.ktx.auth
import com.google.firebase.database.DatabaseReference
import com.google.firebase.database.FirebaseDatabase
import com.google.firebase.ktx.Firebase

class CurbSignUpActivity : AppCompatActivity() {
    private var etEmail: TextInputEditText? =null
    private var etname: TextInputEditText? =null
    private var etPass: TextInputEditText? =null
    private var btnSignUp: MaterialButton? =null
    private var btnlogin: MaterialButton? =null
    private var progressBar: ProgressBar? = null

    // create Firebase authentication object
    private lateinit var auth: FirebaseAuth
    private lateinit var database: DatabaseReference
    private lateinit var database2: DatabaseReference


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_signup)



        //Toolbar Setup
        val toolbar = findViewById(R.id.toolbar) as Toolbar
        setSupportActionBar(toolbar)
        toolbar?.title = "Swachta 2.0"


        //database (realtime)
        database = FirebaseDatabase.getInstance().getReference("User")
        database2 = FirebaseDatabase.getInstance().getReference("CurbsideUID")
        auth = Firebase.auth  // Initialising auth object

        // View Bindings
        progressBar = findViewById(R.id.createUser_pb)
        etEmail = findViewById(R.id.etemail)
        etname = findViewById(R.id.etname)
        etPass = findViewById(R.id.etpass)
        btnSignUp = findViewById<MaterialButton>(R.id.btnSSigned)
        btnlogin = findViewById<MaterialButton>(R.id.btn_login)


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
            Toast.makeText(this, "Name, Email and Password can't be blank", Toast.LENGTH_SHORT).show()
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
                editor.putString("type","Curbside")
                editor.commit()

                val intent = Intent(this, CurbsideMain::class.java)
                startActivity(intent)
                finish()
            } else {
                Toast.makeText(this, "Singed Up Failed!", Toast.LENGTH_SHORT).show()
            }
        }
    }

    //fun to save data on databse realtime
    private fun saveData(){
        val email = etEmail?.text.toString()
        val name = etname?.text.toString()
        val userId = auth.uid!!
        var curbside = UserActivity(email, name, "Curbside")
        var cCount: String = "0"

        database2.child("curbCount").get().addOnSuccessListener {
            if(it.value.toString() != "null"){
                cCount = (it.value.toString().toInt() + 1).toString()
            }
            database2.child("curbCount").setValue(cCount).addOnCompleteListener {}
            database2.child(cCount).setValue(userId).addOnCompleteListener {}
        }.addOnFailureListener{}
        database.child(userId).setValue(curbside).addOnCompleteListener{}
    }

    override fun onBackPressed() {
        super.onBackPressed()
        val intent = Intent(this, SelectionActivity::class.java)
        startActivity(intent)
    }
}

