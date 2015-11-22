<?php
require 'app/models/tuote.php';
class TuoteController extends BaseController{
    public static function index(){
        $tuotteet = Tuote::all();
        View::make('tuote/tuotelista.html', array('tuotteet' => $tuotteet));
    }
    
    public static function kimput(){
        $tuotteet = Tuote::all();
        View::make('tuote/listaKimput.html', array('tuotteet' => $tuotteet));
    }
}
/*
 * tällä hetkellä kaikki hello_world_controller.php:ssa 
 */