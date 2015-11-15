<?php

class TuoteController extends BaseController{
    
    public static function index(){
        $tuotteet = Tuote::all();
        
        View::make('tuotteet/index.html', array('tuotteet' => $tuotteet));
    }
}

