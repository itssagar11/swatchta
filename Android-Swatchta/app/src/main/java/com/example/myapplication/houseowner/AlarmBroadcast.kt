package com.example.myapplication.houseowner

import android.content.BroadcastReceiver
import android.content.Context
import android.content.Intent

class AlarmBroadcast: BroadcastReceiver() {
    override fun onReceive(p0: Context?, p1: Intent?) {
        var i = Intent(p0,AlarmOnActivity::class.java)
        i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK)
        p0?.startActivity(i)
    }
}