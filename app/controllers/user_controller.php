<?php
require 'app/models/tuote.php';
require 'app/models/kayttaja.php';
    class UserController extends BaseController{
        public static function login(){
            View::make('kirjaudu/kirjaudu.html');
        }
        
        public static function handle_login(){
            $params = $_POST;
            
            $user = User::authenticate($params['username'], $params['password']);
            
            if (!user){
                View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana', 'username' => $params['username']));
            } else{
                $_SESSION['user'] = $user->userid;
                
                Redirect::to('/', array('message' => 'Tervetuloa' . $user->username));
            }
        }
        
        public function logout(){
        $_SESSION['user'] = null;
        Redirect::to('/kirjaudu', array('message' => 'Uloskirjautuminen onnistui'));
        }
        
        //uuden käyttäjän luonti
        public static function store(){
        $params = $_POST;
        $kayttaja = new Kayttaja(array(
            'username' => $params['username'],
            'password' => $params['password'],
            'firstname' => $params['firstname'],
            'lastname' => $params['lastname'],
            'email' => $params['email']
        ));
        
        $errors = $kayttaja->errors();
        
        if(count($errors) == 0){
             $kayttaja->save();
             Redirect::to('/kayttaja/' . $kayttaja->userid, array('message' => 'Uusi käyttäjätunnus on luotu'));
        } else {
            View::make('kirjaudu/rekisterointi.html', array('errors' => $errors));
        }
        }
        
        public static function create(){
        View::make('kirjaudu/rekisterointi.html');
    }
    }


