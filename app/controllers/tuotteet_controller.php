<?php
/*
 * tällä hetkellä kaikki hello_world_controlle.php:ssa 
 */
require 'app/models/tuote.php';
class TuoteController extends BaseController{
    public static function index(){
        $tuotteet = Tuote::all();
        View::make('tuotteet/tuotelista.html', array('tuotteet' => $tuotteet));
    }
}
