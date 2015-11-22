<?php
require 'app/models/tuote.php';
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
                $_SESSION['user'] = $user->id;
                
                Redirect::to('/', array('message' => 'Tervetuloa' . $user->name));
            }
        }
    }


