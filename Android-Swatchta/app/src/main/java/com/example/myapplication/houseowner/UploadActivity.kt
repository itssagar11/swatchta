package com.example.myapplication.houseowner

import android.content.Intent
import android.graphics.Bitmap
import android.net.Uri
import android.os.Bundle
import android.provider.MediaStore
import android.widget.Button
import android.widget.ImageView
import android.widget.TextView
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import com.example.myapplication.R
import com.example.myapplication.ml.Android

import com.google.firebase.storage.FirebaseStorage
import com.google.firebase.storage.StorageReference
import org.tensorflow.lite.support.image.TensorImage
import java.io.IOException

class UploadActivity : AppCompatActivity() {

    private val PICK_IMAGE_REQUEST = 71
    private var filePath: Uri? = null
    private var firebaseStore: FirebaseStorage? = null
    private var storageReference: StorageReference? = null

    private lateinit var image_preview : ImageView
    private lateinit var btn_choose_image : Button
    private lateinit var btn_upload_image : Button
    private lateinit var text_preview : TextView

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_upload)

        firebaseStore = FirebaseStorage.getInstance()
        storageReference = FirebaseStorage.getInstance().reference

        image_preview = findViewById(R.id.image_preview)
        btn_choose_image = findViewById(R.id.btn_choose_image)
        btn_upload_image = findViewById(R.id.btn_upload_image)
        text_preview = findViewById(R.id.text_preview)
        btn_choose_image.setOnClickListener {
            launchGallery()
        }
        btn_upload_image.setOnClickListener {
            findType()
        }
    }

    private fun findType() {
        val model = Android.newInstance(applicationContext)

// Creates inputs for reference.
        val bitmap = MediaStore.Images.Media.getBitmap(contentResolver, filePath)
        val img = Bitmap.createScaledBitmap(bitmap,320,320,true)
        val image = TensorImage.fromBitmap(img)

// Runs model inference and gets result.
        val outputs = model.process(image)
        val detectionResult = outputs.detectionResultList.get(0)

// Gets result from DetectionResult.
        val location = detectionResult.scoreAsFloat;
        val category = detectionResult.locationAsRectF;
        val score = detectionResult.categoryAsString;

        text_preview.setText(score.toString() + category.toString() + location.toString())

// Releases model resources if no longer used.
        model.close()

    }

    private fun launchGallery() {
        val intent = Intent()
        intent.type = "image/*"
        intent.action = Intent.ACTION_GET_CONTENT
        startActivityForResult(Intent.createChooser(intent, "Select Picture"), PICK_IMAGE_REQUEST)
    }

//    private fun uploadImage(){
//        if(filePath != null){
//            val ref = storageReference?.child("uploads/" + UUID.randomUUID().toString())
//            val uploadTask = ref?.putFile(filePath!!)
//
//            val urlTask = uploadTask?.continueWithTask(Continuation<UploadTask.TaskSnapshot, Task<Uri>> { task ->
//                if (!task.isSuccessful) {
//                    task.exception?.let {
//                        throw it
//                    }
//                }
//                return@Continuation ref.downloadUrl
//            })?.addOnCompleteListener { task ->
//                if (task.isSuccessful) {
//                    val downloadUri = task.result
//                    addUploadRecordToDb(downloadUri.toString())
//                    Toast.makeText(this, "got image", Toast.LENGTH_SHORT).show()
//                } else {
//                    // Handle failures
//                }
//            }?.addOnFailureListener{
//
//            }
//        }else{
//            Toast.makeText(this, "Please Upload an Image", Toast.LENGTH_SHORT).show()
//        }
//    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)


        if (requestCode == PICK_IMAGE_REQUEST && resultCode == RESULT_OK) {
            if(data == null || data.data == null){
                return
            }

            filePath = data.data
            try {
                val bitmap = MediaStore.Images.Media.getBitmap(contentResolver, filePath)
                image_preview.setImageBitmap(bitmap)
                Toast.makeText(this, "here", Toast.LENGTH_SHORT).show()
            } catch (e: IOException) {
                e.printStackTrace()
            }
        }
    }

//    private fun addUploadRecordToDb(uri: String){
//        val db = FirebaseFirestore.getInstance()
//
//        val data = HashMap<String, Any>()
//        data["imageUrl"] = uri
//
//        db.collection("posts")
//            .add(data)
//            .addOnSuccessListener { documentReference ->
//                Toast.makeText(this, "Saved to DB", Toast.LENGTH_LONG).show()
//            }
//            .addOnFailureListener { e ->
//                Toast.makeText(this, "Error saving to DB", Toast.LENGTH_LONG).show()
//            }
//    }

}