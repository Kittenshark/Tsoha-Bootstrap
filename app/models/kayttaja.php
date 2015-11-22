<?php

class Kayttaja extends BaseModel{
    public $userid, $username, $password, $firstname, $lastname, $email;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
   /* 
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Tuote');
        $query->execute();
        
        $rows = $query->fetchAll();
        $kayttajat = array();
        
        foreach ($rows as $row) {
            $kayttajat[] = new Tuote(array(
                'userid' => $row['userid'],
                'username' => $row['username'],
                'password' => $row['password'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'email' => $row['email']
            ));
        }
        return $kayttajat;
    }
    * 
    */
    public static function authenticate($username, $password){
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE username = :username AND password = :password LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();
        
        if($row){
            $kayttaja = new Kayttaja(array(
                'userid' => $row['userid'],
                'username' => $row['username'],
                'password' => $row['password'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'email' => $row['email']
            ));
            return $kayttaja;
        } else {
            return null;
        }   
    }
    
    public static function find($userid){
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE userid = :userid LIMIT 1');
        $query->execute(array('userid' => $userid));
        $row = $query->fetch();
        
        if($row){
            $kayttaja = new Kayttaja(array(
                'userid' => $row['userid'],
                'username' => $row['username'],
                'password' => $row['password'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'email' => $row['email']
            ));
            return $kayttaja;
        } else {
            return null;
        }   
    }
}
    
    
