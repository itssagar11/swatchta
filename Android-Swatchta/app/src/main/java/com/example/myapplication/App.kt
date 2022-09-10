package com.example.myapplication

import android.app.Application
import android.app.NotificationChannel
import android.app.NotificationManager

class App : Application() {
    override fun onCreate() {
        super.onCreate()
        createNotificationChannel()
    }

    private fun createNotificationChannel() {
        val serviceChannel = NotificationChannel(
            CHANNEL_ID,
            "Location Access",
            NotificationManager.IMPORTANCE_NONE
        )
        val manager = getSystemService(
            NotificationManager::class.java
        )
        manager.createNotificationChannel(serviceChannel)
    }

    companion object {
        const val CHANNEL_ID = "Swachta"
    }
}