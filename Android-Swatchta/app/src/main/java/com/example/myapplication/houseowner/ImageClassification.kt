package com.example.myapplication.houseowner

import android.content.Context
import android.graphics.Bitmap
import android.location.Location
import android.net.Uri
import android.os.Bundle
import android.provider.MediaStore
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import com.example.myapplication.R
import com.google.android.material.button.MaterialButton
import com.google.android.material.imageview.ShapeableImageView
import com.google.android.material.textview.MaterialTextView
import com.google.firebase.auth.FirebaseAuth
import com.google.firebase.database.DatabaseReference
import com.google.firebase.database.FirebaseDatabase
import com.google.firebase.firestore.FirebaseFirestore
import com.google.firebase.storage.FirebaseStorage
import com.google.firebase.storage.StorageReference
import java.io.ByteArrayOutputStream


class ImageClassification: AppCompatActivity() {

    private lateinit var auth: FirebaseAuth
    private lateinit var database: DatabaseReference
    private var imageUri: Uri? = null


    private var img_view : ShapeableImageView?=null

    private var name_view : MaterialTextView?=null
    private var phn_view : MaterialTextView?=null
    private var aadhar_view : MaterialTextView?=null
    private var address_view : MaterialTextView?=null
    private var location_view : MaterialTextView?=null
    private var btnUpload : MaterialButton?=null

    private var firebaseStore: FirebaseStorage? = null
    private var storageReference: StorageReference? = null

    private lateinit var lastlocation : Location


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_imageclassification)

        btnUpload = findViewById(R.id.btnUpload3)

        database = FirebaseDatabase.getInstance().getReference("User")
        auth = FirebaseAuth.getInstance()

        img_view = findViewById(R.id.userClickedImg)
        name_view = findViewById(R.id.name_data)
        location_view = findViewById(R.id.location_data)

        firebaseStore = FirebaseStorage.getInstance()


        //taken form previous activity to make changes in this activity
        val takenimage = intent.getParcelableExtra("TakenImage") as Bitmap?
        val lastlocation = intent.getStringExtra("TakenLocation") as String
        img_view?.setImageBitmap(takenimage)
        location_view?.setText(lastlocation)

        val userID = auth.uid!!
        lateinit var name: String

        storageReference = FirebaseStorage.getInstance().getReference("uploads/$userID")

        val complaint  = HashMap<String,Any?>()

        database.child(userID).get().addOnSuccessListener {
            name = it.child("name").value.toString()
            name_view!!.setText(it.child("name").value.toString())
        }


        btnUpload?.setOnClickListener{
            database.child(userID).get().addOnSuccessListener {
                name = it.child("name").value.toString()
            }
            complaint["name"] = name
            complaint["location"] = lastlocation
            complaint["userID"] = userID
            val db = FirebaseFirestore.getInstance()
            Toast.makeText(this,"here",Toast.LENGTH_SHORT).show()
            try{
                db.collection("complaints").document(userID).set(complaint)
                    .addOnSuccessListener {
                        Toast.makeText(this,"data written",Toast.LENGTH_SHORT).show()
                    }
                    .addOnFailureListener {
                        Toast.makeText(this,"data not written",Toast.LENGTH_SHORT).show()
                    }
            } catch(e: Exception){
                Toast.makeText(this,e.toString(),Toast.LENGTH_SHORT).show()
            }

            imageUri = getImageUri(this, takenimage!!)

            storageReference!!.putFile(imageUri!!).addOnSuccessListener {
                Toast.makeText(this,"done",Toast.LENGTH_SHORT).show()
            }

        }
    }

    fun getImageUri(inContext: Context, inImage: Bitmap): Uri? {
        val bytes = ByteArrayOutputStream()
        inImage.compress(Bitmap.CompressFormat.JPEG, 100, bytes)
        val path = MediaStore.Images.Media.insertImage(
            inContext.getContentResolver(),
            inImage,
            "Title",
            null
        )
        return Uri.parse(path)
    }
}