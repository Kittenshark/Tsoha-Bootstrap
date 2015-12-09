<?php
class OstoController extends BaseController{
    public static function tilausLista($userid){
        $tilaus = Tilaus::all();
        View::make('tuote/tuotelista.html', array('tuotteet' => $tuotteet));
    }
}

