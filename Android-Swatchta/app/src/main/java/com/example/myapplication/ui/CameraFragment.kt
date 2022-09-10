package com.example.myapplication.ui

import android.Manifest
import android.app.Activity
import android.content.Intent
import android.content.pm.PackageManager
import android.graphics.Bitmap
import android.location.Address
import android.location.Geocoder
import android.location.Location
import android.os.Bundle
import android.os.Handler
import android.provider.MediaStore
import android.util.Base64
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ProgressBar
import android.widget.Toast
import androidx.core.app.ActivityCompat
import androidx.fragment.app.Fragment
import com.chaquo.python.PyObject
import com.chaquo.python.Python
import com.example.myapplication.R
import com.example.myapplication.houseowner.ImageClassification
import com.google.android.gms.location.FusedLocationProviderClient
import com.google.android.gms.location.LocationServices
import com.google.android.material.button.MaterialButton
import com.google.android.material.imageview.ShapeableImageView
import com.google.android.material.textview.MaterialTextView
import java.io.ByteArrayOutputStream
import java.io.IOException
import java.util.*


// TODO: Rename parameter arguments, choose names that match
// the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
private const val ARG_PARAM1 = "param1"
private const val ARG_PARAM2 = "param2"

/**
 * A simple [Fragment] subclass.
 * Use the [CameraMain.newInstance] factory method to
 * create an instance of this fragment.
 */
open class CameraFragment : Fragment(){
    // TODO: Rename and change types of parameters
    private var param1: String? = null
    private var param2: String? = null
    private var btnClick: MaterialButton? = null
    private var btnValidate: MaterialButton? = null
    private var btninstruction: MaterialTextView?= null
    private var btnunderins: MaterialTextView?= null
    private var btnExample: MaterialTextView?= null
    private var imageGarbage: ShapeableImageView? =null
    private lateinit var fusedLocationClient: FusedLocationProviderClient
    private lateinit var lastlocation: Location

    private val REQUEST_CODE = 42
    private var imageString: String = ""
    private var pyobj:PyObject= Python.getInstance().getModule("imageLabel")
    private var obj:PyObject?= null
    private var progressbar: ProgressBar?=null
    private val handler = Handler()
    private lateinit var takenImage: Bitmap


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        arguments?.let {
            param1 = it.getString(ARG_PARAM1)
            param2 = it.getString(ARG_PARAM2)
        }
    }

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        // Inflate the layout for this fragment

        return inflater.inflate(R.layout.fragment_camera_main, container, false)
    }

    override fun onViewCreated(view: View, savedInstanceState: Bundle?) {

        btninstruction = getView()?.findViewById(R.id.tvTitle)
        btnunderins = getView()?.findViewById(R.id.tvDes1)
        btnExample = getView()?.findViewById(R.id.tvTitle2)


        btnClick =getView()?.findViewById(R.id.btnContinue)
        btnValidate =getView()?.findViewById(R.id.btnValidate)
        progressbar = getView()?.findViewById(R.id.validate_pb)


        btnClick?.setOnClickListener{
            if (ActivityCompat.checkSelfPermission(
                    requireContext(),
                    Manifest.permission.CAMERA
                ) != PackageManager.PERMISSION_GRANTED ) {
                ActivityCompat.requestPermissions(requireActivity(), arrayOf( Manifest.permission.CAMERA),
                    MapFragment.CAMERA_REQUEST_CODE
                )
            }
            val  takePictureIntent = Intent(MediaStore.ACTION_IMAGE_CAPTURE)
            if(takePictureIntent.resolveActivity(requireActivity().packageManager)!=null){
                startActivityForResult(takePictureIntent,REQUEST_CODE)
            }else{
                Toast.makeText(requireContext(),"Unable to open camera",Toast.LENGTH_SHORT).show()
            }
        }

        fusedLocationClient = LocationServices.getFusedLocationProviderClient(requireContext())

        btnValidate?.setOnClickListener {
            progressbar?.visibility = View.VISIBLE
            //python validation
            if(imageString != ""){
                obj = pyobj.callAttr("main",imageString)
            }
            if (obj == null) {
                Toast.makeText(requireContext(), "Take Photo first", Toast.LENGTH_SHORT).show()
            } else if (obj.toString() == "-1") {
                Toast.makeText(requireContext(), "Try Again, Image Not Valid!!", Toast.LENGTH_SHORT)
                    .show()
            } else {
                Toast.makeText(requireContext(), "Trash Detected", Toast.LENGTH_SHORT).show()
                val intent = Intent(requireContext(), ImageClassification::class.java)
                var address = getAddress(lastlocation.latitude,lastlocation.longitude)
                intent.putExtra("TakenImage",takenImage)
                intent.putExtra("TakenLocation",address)
                startActivity(intent)
            }
            handler.postDelayed(object :Runnable{
                override fun run(){
                    progressbar?.visibility = View.INVISIBLE
                }
            },1000)
        }

    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        if(requestCode == REQUEST_CODE && resultCode == Activity.RESULT_OK){
            imageGarbage = getView()?.findViewById(R.id.imageViewGarbage)
            takenImage = data?.extras?.get("data") as Bitmap
            imageGarbage!!.setImageBitmap(takenImage)
            imageString = BitMapToString(takenImage)

            //accesslocation
            if (ActivityCompat.checkSelfPermission(
                    requireActivity(),
                    Manifest.permission.ACCESS_FINE_LOCATION
                ) != PackageManager.PERMISSION_GRANTED ) {
                ActivityCompat.requestPermissions(requireActivity(), arrayOf( Manifest.permission.ACCESS_FINE_LOCATION),
                    MapFragment.LOCATION_REQUEST_CODE
                )
                return
            }
            fusedLocationClient.lastLocation.addOnSuccessListener(requireActivity()) { location ->
                //for household marker
                if(location !=null){
                    lastlocation = location
                }
            }

        }
        super.onActivityResult(requestCode, resultCode, data)
    }

    private fun BitMapToString(bitmap: Bitmap): String {
        val baos = ByteArrayOutputStream()
        bitmap.compress(Bitmap.CompressFormat.PNG, 100, baos)
        val b = baos.toByteArray()
        return Base64.encodeToString(b, Base64.DEFAULT)
    }

    open fun getAddress(lat: Double, lng: Double): String {
        val geocoder = Geocoder(requireContext(), Locale.getDefault())
        try {
            val addresses: List<Address> = geocoder.getFromLocation(lat, lng, 1)
            val obj: Address = addresses[0]
            var add: String = obj.getAddressLine(0)
//            add = """
//            $add
//            ${obj.getCountryName()}
//            """.trimIndent()
//            add = """
//            $add
//            ${obj.getCountryCode()}
//            """.trimIndent()
//            add = """
//            $add
//            ${obj.getAdminArea()}
//            """.trimIndent()
//            add = """
//            $add
//            ${obj.getPostalCode()}
//            """.trimIndent()
//            add = """
//            $add
//            ${obj.getSubAdminArea()}
//            """.trimIndent()
//            add = """
//            $add
//            ${obj.getLocality()}
//            """.trimIndent()
//            add = """
//            $add
//            ${obj.getSubThoroughfare()}
//            """.trimIndent()
            return add
            // TennisAppActivity.showDialog(add);
        } catch (e: IOException) {
            // TODO Auto-generated catch block
            e.printStackTrace()
            Toast.makeText(requireContext(), "Problem in taking location retry", Toast.LENGTH_SHORT).show()
        }
        return "Try again"
    }

    override fun onResume() {
        fusedLocationClient = LocationServices.getFusedLocationProviderClient(requireActivity())
        imageGarbage?.setImageLevel(R.drawable.garbageexample)
        super.onResume()
    }


    companion object {
        /**
         * Use this factory method to create a new instance of
         * this fragment using the provided parameters.
         *
         * @param param1 Parameter 1.
         * @param param2 Parameter 2.
         * @return A new instance of fragment CameraMain.
         */
        // TODO: Rename and change types and number of parameters
        @JvmStatic
        fun newInstance(param1: String, param2: String) =
            CameraFragment().apply {
                arguments = Bundle().apply {
                    putString(ARG_PARAM1, param1)
                    putString(ARG_PARAM2, param2)
                }
            }
    }
}