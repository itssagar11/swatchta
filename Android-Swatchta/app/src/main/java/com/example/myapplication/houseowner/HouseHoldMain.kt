package com.example.myapplication.houseowner

import android.app.AlarmManager
import android.app.PendingIntent
import android.content.Intent
import android.graphics.Bitmap
import android.graphics.Color
import android.graphics.drawable.ColorDrawable
import android.os.Bundle
import android.view.*
import android.widget.Toast
import androidx.appcompat.app.AlertDialog
import androidx.appcompat.app.AppCompatActivity
import androidx.appcompat.widget.AppCompatImageView
import androidx.appcompat.widget.Toolbar
import androidx.core.content.ContextCompat
import androidx.fragment.app.Fragment
import com.chaquo.python.Python
import com.chaquo.python.android.AndroidPlatform
import com.example.myapplication.R
import com.example.myapplication.adapter.ViewPagerAdapter
import com.example.myapplication.auth.LoginActivity
import com.example.myapplication.curbsidecollector.AccessBGLocation
import com.example.myapplication.databinding.ActivityHouseholdmainBinding
import com.example.myapplication.ui.CameraFragment
import com.example.myapplication.ui.MapFragment
import com.example.myapplication.ui.PointFragment
import com.google.firebase.auth.FirebaseAuth
import com.google.zxing.BarcodeFormat
import com.google.zxing.WriterException
import com.google.zxing.qrcode.QRCodeWriter


class HouseHoldMain: AppCompatActivity() {

    private var binding: ActivityHouseholdmainBinding?=null
    lateinit var auth: FirebaseAuth
    private lateinit var alarmManager: AlarmManager





    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityHouseholdmainBinding.inflate(layoutInflater)
        setContentView(binding!!.root)
        callUpdateLocation()
        auth = FirebaseAuth.getInstance()


        if (! Python.isStarted()) {
            Python.start(AndroidPlatform(this));
        }

        var token = getSharedPreferences("userID", MODE_PRIVATE)

        val toolbar = findViewById<Toolbar>(R.id.toolbar_main)
        toolbar.inflateMenu(R.menu.main_menu)

        val onMenuItemClickListener = Toolbar.OnMenuItemClickListener { item ->
            when (item.itemId) {
                R.id.alarm -> {
                    var editor = token.edit()
                    editor.putString("loginUID"," ")
                    editor.putString("alarmTime"," ")
                    editor.commit()
                    val intent = Intent(this, LoginActivity::class.java)
                    startActivity(intent)
                    val intent2 = Intent(this, AccessBGLocation::class.java)
                    stopService(intent2);
                    Toast.makeText(this, "Logged Out ", Toast.LENGTH_SHORT).show()
                }
                R.id.qr -> {
                    var uid = auth.uid
                    var writer = QRCodeWriter()
                    try{
                        //create the qr
                        val bitMAtrix = writer.encode(uid,BarcodeFormat.QR_CODE,512,512)
                        val width = bitMAtrix.width
                        val height = bitMAtrix.height
                        val bmp = Bitmap.createBitmap(width,height,Bitmap.Config.RGB_565)
                        for(x in 0 until width) {
                            for(y in 0 until height){
                                bmp.setPixel(x,y, if(bitMAtrix[x,y]) Color.BLACK else Color.WHITE)
                            }
                        }
                        //set the qr
                        val builder = AlertDialog.Builder(this)
                        val dialog = builder.create()
                        val inflater: LayoutInflater = layoutInflater
                        val dialogLayout: View = inflater.inflate(R.layout.qr_viewer_alert, null)
                        val imageview = dialogLayout.findViewById(R.id.image_view) as AppCompatImageView
                       // val ivCross = dialogLayout.findViewById(R.id.ivCross) as AppCompatImageView
//                        ivCross.setOnClickListener {
//                            dialog.dismiss()
//                        }
                        imageview.setImageBitmap(bmp)
                        dialog.setView(dialogLayout)
                        dialog.requestWindowFeature(Window.FEATURE_NO_TITLE)
                        dialog.window?.setBackgroundDrawable(ColorDrawable(Color.TRANSPARENT))
                        dialog.setCanceledOnTouchOutside(true)
                        dialog.show()

                    }catch (e:WriterException){
                        e.printStackTrace()
                    }
                }

                R.id.appSetting ->{
                    alarmManager = getSystemService(ALARM_SERVICE) as AlarmManager
                    val intent = Intent(this, AlarmBroadcast::class.java)
                    val pendingIntent = PendingIntent.getBroadcast(
                        this,
                        111,
                        intent,
                        PendingIntent.FLAG_IMMUTABLE or PendingIntent.FLAG_CANCEL_CURRENT)
                    alarmManager.set(AlarmManager.RTC_WAKEUP,System.currentTimeMillis()+ 1000,pendingIntent)
                }

            }
            false
        }
        toolbar.setOnMenuItemClickListener(onMenuItemClickListener)

        val fragmentArrayList = ArrayList<Fragment>()

        fragmentArrayList.add(PointFragment())
        fragmentArrayList.add(CameraFragment())
        fragmentArrayList.add(MapFragment())

        val adapter= ViewPagerAdapter(this,supportFragmentManager,fragmentArrayList)

        binding!!.viewPager.adapter = adapter
        binding!!.tabs.setupWithViewPager(binding!!.viewPager)
    }
    private fun callUpdateLocation() {
        val serviceIntent = Intent(this, AccessBGLocation::class.java)
        serviceIntent.putExtra("inputExtra", "Live Location Shared")
        ContextCompat.startForegroundService(this, serviceIntent);
    }

    override fun onCreateOptionsMenu(menu: Menu?): Boolean {
        menuInflater.inflate(R.menu.main_menu,menu)
        return true
    }

    override fun onOptionsItemSelected(item: MenuItem): Boolean {
        return super.onOptionsItemSelected(item)
    }

}