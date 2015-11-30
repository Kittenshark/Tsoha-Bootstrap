<?php

  class BaseController{

    public static function get_user_logged_in(){
      if(isset($_SESSION['kayttaja'])){
          $userid = $_SESSION['kayttaja'];
          $kayttaja = Kayttaja::find($userid);
          return $kayttaja;
      }
      return null;
    }

    public static function check_logged_in(){
      if(!isset($_SESSION['user'])){
          Redirect::to('/kirjaudu', array('message' => 'Kirjautuminen vaaditaan'));
      }
    }

  }
