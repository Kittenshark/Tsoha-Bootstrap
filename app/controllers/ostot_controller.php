<?php
class OstoController extends BaseController{
    public static function tilausLista($userid){
        $tilaus = Tilaus::all();
        View::make('tuote/tuotelista.html', array('tuotteet' => $tuotteet));
    }
    
    public static function tilaajanLista($userid){
        
    }
    
    public static function create($id){
        self::check_logged_in();
        $tuote = Tuote::find($id);
        View::make('osto/createTilaus.html', array('tuote' => $tuote)); 
    }
    
    public static function fortest(){
        $tilaukset = Tilaus::all();
        View::make('osto/createTilaus.html', array('tilaukset' => $tilaukset));
    }
    
    public static function showTilaus($orderid){
        self::check_logged_in();
        $tilaus = Tilaus::find($orderid);
        View::make('osto/tilaus.html', array('tilaus' => $tilaus));
    }
    
    public static function store($id){
        self::check_logged_in();
        //$tuote = Tuote::find($id);
        $params = $_POST; 
        $tuote = Tuote::find($id);
        $timestamp = date('Y-m-d G:i:s');
        $tilaus = new Tilaus(array(
            //'orderid' => $params['orderid'],
            'price' => $tuote->price,
            'orderday' => $timestamp,
            'arrivaladdress' => $params['arrivaladdress'],
            'billingaddress' => $params['billingaddress'],
            'product_id' => $tuote->id,
            'orderer' => $_SESSION['kayttaja']
        ));
        
        $errors = $tilaus->errors();
        
        
        if(count($errors) == 0){
             $tilaus->save();
             Redirect::to('/tilaus/' . $tilaus->orderid, array('message' => 'Tuote on tilattu'));
        } else {
            View::make('osto/createTilaus.html', array('errors' => $errors, 'params' => $params));
        }
    }
    
    public static function edit($orderid){
        self::check_logged_in();
        $tilaus = Tilaus::find($orderid);
        View::make('osto/editTilaus.html', array('tilaus' => $tilaus));
    }
    
    public static function updateOrder($orderid){
        self::check_logged_in();
        
        $params = $_POST;
        
        $attributes = array(
            'orderid' => $orderid,
            'arrivaladdress' => $params['arrivaladdress'],
            'billingaddress' => $params['billingaddress'],
            'price' => $params['price'],
            'orderday' => $params['orderday'],
            'product_id' => $params['product_id'],
            'orderer' => $params['orderer']
                );
 
        $tilaus = new Tilaus($attributes);
        $errors = $tilaus->errors();
        
        if(count($errors) > 0){
            $tilaus = Tilaus::find($orderid);
            View::make('osto/editTilaus.html', array('errors' => $errors, 'attributes' => $attributes, 'tilaus' => $tilaus));
        } else {
            $tilaus->update();
            Redirect::to('/tilaus/' . $tilaus->orderid, array('message' => 'Tilauksen onnistunut muokkaus') );
        }
    }
    
    public static function removeOrder($orderid){
        self::check_logged_in();
        $tilaus = Tilaus::remove($orderid);
        $id = $_SESSION['kayttaja'];
        
        Redirect::to('/kayttaja/'.$id, array('message' => 'Tilaus on peruttu'));
    }
    
    public static function showall(){
        $tilaukset = Tilaus::all();
        View::make('test.html', array('tilaukset' => $tilaukset));
    }
    
    public static function findyourorders(){
        $tilaukset = Tilaus::findyourorders();
         View::make('osto/omattilaukset.html', array('tilaukset' => $tilaukset));
    }
    
    public static function listuserorders($id){
        $tilaukset = Tilaus::listuserorders($id);
        View::make('osto/omattilaukset.html', array('tilaukset' => $tilaukset));
    }
}

