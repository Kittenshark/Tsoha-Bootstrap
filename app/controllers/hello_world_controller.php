<?php
require 'app/models/tuote.php';
require 'app/models/kayttaja.php';
  class HelloWorldController extends BaseController{
/*
    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	 echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
        
        $tuotteet = Tuote::all();
        
        $Kint::dump($tuotteet);

    }
 
  */
    public static function sandbox(){
        $ruusu = new Tuote(array(
            'fname' => '',
            'price' => '2',
            'sale' => '0',
            'description' => 'Punainen'
        ));
        
        $errors = $ruusu->errors();
        
        Kint::dump($errors);
    }
    
    public static function home(){
        View::make('homepage.html');
    }
    
    public static function tuotelista(){
        $tuotteet = Tuote::all();
        View::make('tuote/tuotelista.html', array('tuotteet' => $tuotteet));
    }
    
    public static function store(){
        $params = $_POST;
        $tuote = new Tuote(array(
            'fname' => $params['fname'],
            'price' => $params['price'],
            'sale' => $params['sale'],
            'description' => $params['description']
        ));
        
        $errors = $tuote->errors();
        
        if(count($errors) == 0){
             $tuote->save();
             Redirect::to('/tuote/' . $tuote->id, array('message' => 'Uusi tuote on luotu'));
        } else {
            View::make('tuote/new.html', array('errors' => $errors));
        }
       
    }
    
    public static function create(){
        View::make('tuote/new.html');
    }
    
    public static function show($id){
        $tuote = Tuote::find($id);
        View::make('tuote/show.html', array('tuote' => $tuote));
    }
    
    public static function kimput(){
        $tuotteet = Tuote::all();
        View::make('tuote/listaKimput.html', array('tuotteet' => $tuotteet));
    }
    
    public static function edit($id){
        $tuote = Tuote::find($id);
        View::make('tuote/edit.html', array('attributes' => $tuote));
    }
    
    public static function update($id){
        /*
        $params = $_POST;
        
        $attributes = array(
            'fname' => $params['fname'],
            'price' => $params['price'],
            'sale' => $params['sale'],
            'description' => $params['description']
                );
        
        $tuote = new Tuote($attributes);
         * 
         */
        //$errors = $tuote->errors();
        //$tuote->update();
        /*
        if(count($errors) > 0){
            View::make('tuote/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $tuote->update();
        }
         * 
         */
        //$tuote = Tuote::find($id);
        $tuote = Tuote::update($id);
        
        $errors = $tuote->errors();
        
        if(count($errors) == 0){
            Redirect::to('/tuote/' . $id, array('message' => 'Muokkaus onnistui'));
        } else {
            Redirect::to('/tuote/' . $id . '/edit', array('message' => 'Muokkaus ei onnistunut'));
        } 
        
        // Redirect::to('/tuote/' . $tuote->id, array('message' => 'Muokkaus onnistui'));
    }
    
    public static function remove($id){
        //$tuote = new Tuote(array('id' => $id));
        $tuote = Tuote::remove($id);
        
        Redirect::to('/tuotteet', array('message' => 'Tuotteen poisto onnistui'));
    }
    
    public static function login(){
            View::make('kirjaudu/kirjaudu.html');
    }
    
    public static function handle_login(){
            $params = $_POST;
            
            $kayttaja = Kayttaja::authenticate($params['username'], $params['password']);
            
            if (!$kayttaja){
                View::make('kirjaudu/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana', 'username' => $params['username']));
            } else{
                $_SESSION['kayttaja'] = $kayttaja->userid;
                
                Redirect::to('/', array('message' => 'Tervetuloa' . $kayttaja->username));
            }
        }
    
    public function logout(){
        $_SESSION['kayttaja'] = null;
        Redirect::to('/kirjaudu', array('message' => 'Uloskirjautuminen onnistui'));
    }    
        
    //luodaan uusi käyttäjä
    public static function userStore(){
        $params = $_POST;
        $kayttaja = new Kayttaja(array(
            'username' => $params['username'],
            'password' => $params['password'],
            'firstname' => $params['firstname'],
            'lastname' => $params['lastname'],
            'email' => $params['email']
        ));
        
        $kayttaja->save();
        $_SESSION['kayttaja'] = $kayttaja->userid;
        Redirect::to('/kayttaja/' . $kayttaja->userid, array('message' => 'Uusi käyttäjätunnus on luotu'));
        //$errors = $kayttaja->errors();
        
        /*
        if(count($errors) == 0){
             $kayttaja->save();
             Redirect::to('/kayttaja/' . $kayttaja->userid, array('message' => 'Uusi käyttäjätunnus on luotu'));
        } else {
            View::make('kirjaudu/rekisterointi.html', array('errors' => $errors));
        }
         * 
         */
        }
        
        public static function userCreate(){
        View::make('kirjaudu/rekisterointi.html');
    }    
    
    public static function userShow($userid){
        $kayttaja = Kayttaja::find($userid);
        View::make('kirjaudu/kayttaja.html', array('kayttaja' => $kayttaja));
    }
    
    public static function userRemove($userid){
        $kayttaja = Kayttaja::remove($userid);
        
        Redirect::to('/kayttajat', array('message' => 'Käyttäjätunnus on poistettu'));
    }
    
    public static function kayttajalista(){
        $kayttajat = Kayttaja::all();
        View::make('kirjaudu/kayttajalista.html', array('kayttajat' => $kayttajat));
    }
  }
