package com.example.myapplication.adapter

import android.content.Context
import androidx.fragment.app.Fragment
import androidx.fragment.app.FragmentManager
import androidx.fragment.app.FragmentPagerAdapter

internal class ViewPagerAdapter (
    private val context: Context,
    fm:FragmentManager?,
    val list : ArrayList<Fragment>
    ) : FragmentPagerAdapter(fm!!) {
    override fun getCount(): Int {
       return 3
    }

    //return no. of fragments
    override fun getItem(position: Int): Fragment {
        return list[position]
    }

    //return titles of page
    override fun getPageTitle(position: Int): CharSequence? {
        return TAB_TITLES[position]
    }

    companion object{
        val TAB_TITLES = arrayOf("Points","Complaint","Track")
    }

}
