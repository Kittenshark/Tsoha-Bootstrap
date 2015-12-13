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
    
    public static function tilaa(){
        
    }
    
    public static function store($id){
        self::check_logged_in();
        //$tuote = Tuote::find($id);
        $params = $_POST; 
        $tuote = Tuote::find($id);

        $tilaus = new Tilaus(array(
            //'orderid' => $params['orderid'],
            'price' => $tuote->price,
            //'orderday' => time(),
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
            View::make('tuote/new.html', array('errors' => $errors));
        }
    }
    
    public static function showall(){
        $tilaukset = Tilaus::all();
        View::make('test.html', array('tilaukset' => $tilaukset));
    }
    
    public static function findyourorders(){
        $tilaukset = Tilaus::findyourorders();
         View::make('osto/omattilaukset.html', array('tilaukset' => $tilaukset));
    }
}

