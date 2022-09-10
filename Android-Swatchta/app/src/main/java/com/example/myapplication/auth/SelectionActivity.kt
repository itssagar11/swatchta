package com.example.myapplication.auth

import android.content.Intent
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import com.example.myapplication.R
import com.google.android.material.button.MaterialButton

class SelectionActivity: AppCompatActivity() {

    private var btnhome: MaterialButton? =null
    private var btncurb: MaterialButton? =null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_selection)

        btnhome = findViewById(R.id.btn_house)
        btncurb = findViewById(R.id.btn_curbside)

        btnhome!!.setOnClickListener(){
            val intent = Intent(this, HomeSignUpActivity::class.java)
            startActivity(intent)
            finish()
        }

        btncurb!!.setOnClickListener(){
            val intent = Intent(this, CurbSignUpActivity::class.java)
            startActivity(intent)
            finish()
        }
    }

    override fun onBackPressed() {
        super.onBackPressed()
        val intent = Intent(this, LoginActivity::class.java)
        startActivity(intent)
    }

}