package com.example.myapplication.houseowner

import android.content.Intent
import android.media.MediaPlayer
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import com.example.myapplication.R
import com.google.android.material.button.MaterialButton
import java.text.SimpleDateFormat
import java.util.*

class AlarmOnActivity: AppCompatActivity() {

    private var stopbtn: MaterialButton?= null
    private lateinit var calender: Calendar
    private  var hour:Int = 0
    private lateinit var simpleDateFormate: SimpleDateFormat


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_alarmonactivity)

        var token = getSharedPreferences("userID", MODE_PRIVATE)
        var editor = token.edit()
        calender = Calendar.getInstance()
        simpleDateFormate = SimpleDateFormat("HH")
        hour = Integer.parseInt(simpleDateFormate.format(calender.time))
        editor.putString("alarmTime",hour.toString())
        editor.commit()

        var mp: MediaPlayer = MediaPlayer.create(applicationContext, R.raw.swachbharatsong)
        mp.start()

        stopbtn = findViewById(R.id.btnstop)
        stopbtn?.setOnClickListener{
            mp.stop()
            val intent = Intent(this, HouseHoldMain::class.java)
            startActivity(intent)
            finish()
        }
    }
}