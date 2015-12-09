<?php
require 'app/models/tuote.php';
require 'app/models/kayttaja.php';
    class UserController extends BaseController{
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
        
    public static function check_logged_in(){
        if(!isset($_SESSION['kayttaja'])){
            Redirect::to('/kirjaudu', array('message' => 'Kirjautuminen vaaditaan'));
        }
    }
        
    public function logout(){
        $_SESSION['kayttaja'] = null;
        Redirect::to('/', array('message' => 'Uloskirjautuminen onnistui'));
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
        
        $errors=$kayttaja->errors();
        
        if(count($errors)==0){
            $kayttaja->save();
            $_SESSION['kayttaja'] = $kayttaja->userid;
            Redirect::to('/kayttaja/' . $kayttaja->userid, array('message' => 'Uusi käyttäjätunnus on luotu'));
        } else {
           Redirect::to('/kirjaudu', array('errors' => $errors));
        }
        
        
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
        self::check_logged_in();
        $kayttaja = Kayttaja::remove($userid);
        
        Redirect::to('/kayttajat', array('message' => 'Käyttäjätunnus on poistettu'));
    }
    
    public static function kayttajalista(){
        $kayttajat = Kayttaja::all();
        View::make('kirjaudu/kayttajalista.html', array('kayttajat' => $kayttajat));
    }
    }


