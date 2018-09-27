<?php

namespace App\Libs\Providers\Frontend;

use Session;

class CountView {

    // Check exit session viewed. viewed: true else false
    private function _isPostViewed($cate, $id)
    {
        $viewed = Session::get('viewed_'.$cate) ?? array();
        // return $viewed;
        $newTime = $this->_cleanExpiredViews($viewed); 
        $this->storePosts($newTime, $cate);
        // print_r($newTime);
        return array_key_exists($id, $viewed);
    }

    // Save session viewed
    private function _storePost($id, $cate)
    {
        $key = 'viewed_'.$cate.'.'.$id;

        Session::put($key, time());
    }

    // ($model, $id, $table, $cate)
    public function upView ($model, $table, $id, $cate) {
        if (!$this->_isPostViewed($cate, $id) ) {
            $model->find($id)->increment($table); // Save database
            $this->_storePost($id, $cate);
        }
    }


    private function _cleanExpiredViews($viewed)
    {
        $time = time();
        $throttleTime = 3600;
        // check time if time session + time view reset > time then return array new time
        return array_filter($viewed, function ($timestamp) use ($time, $throttleTime)
        {
            return ($timestamp + $throttleTime) > $time;
        });
    }
    
    private function storePosts($viewed, $cate)
    {
        Session()->put('viewed_'.$cate, $viewed);
    }
}



    
