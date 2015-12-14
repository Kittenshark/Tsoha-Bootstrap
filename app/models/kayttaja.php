<?php

class Kayttaja extends BaseModel{
    public $userid, $username, $password, $firstname, $lastname, $email;
    
    public function __construct($attributes){
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_password', 'validate_email', 'validate_username_not_taken', 'validate_real_name');
    }
    
    //listataan kaikki käyttäjät
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
        $query->execute();
        
        $rows = $query->fetchAll();
        $kayttajat = array();
        
        foreach ($rows as $row) {
            $kayttajat[] = new Kayttaja(array(
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
    
    //luodaan uusi käyttäjä
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Kayttaja (username, password, firstname, lastname, email) VALUES (:username, :password, :firstname, :lastname, :email) RETURNING userid');      
        $query->execute(array('username' => $this->username, 'password' => $this->password, 'firstname' => $this->firstname, 'lastname' => $this->lastname, 'email' => $this->email));
        $row = $query->fetch();
        
        //Kint::trace();
        //Kint::dump($row);
        
        $this->userid = $row['userid'];
    }
    
    public function remove($userid){
        $query = DB::connection()->prepare('DELETE FROM Kayttaja WHERE userid = :userid');
        $query->execute(array('userid' => $userid));
    }
    
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
    
    public static function findUsername($username){
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE username = :username');
        $query->execute(array('username' => $username));
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
            return true;
        } else {
            return false;
        }   
    }
    
    public function validate_name(){
        $errors = array();
        if($this->username== '' || $this->username== null){
            $errors[] ='Käyttäjätunnus puuttuu';
        }
        return $errors; 
         
    }
    
    public function validate_real_name(){
        $errors = array();
        if($this->firstname== '' || $this->firstname== null){
            $errors[] ='Nimi puuttuu';
        }
        //$errors = $this->check_empty($this->firstname, $errors);
        //$this->check_empty($this->lastname, $errors);
        
        return $errors;
    }

    public function validate_password(){
        $errors = array();
        if(strlen($this->password) < 3 || $this->password == null || $this->password == ''){
            $errors[] ='Salasanan oltava vähintään 4 merkkiä';
        }
        return $errors; 
         
    }
    
    public function validate_email(){
        $errors = array();
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors[] ='Sähköpostiosoite ei ole kunnollinen';
        }
        return $errors;
    }
    
    public function validate_username_not_taken(){
        $errors = array();
        if($this->findUsername($this->username)){
            $errors[] ='Käyttäjätunnus on varattu';
        }
        return $errors;
    }
    
    public function validate_not_empty(){
        $errors = array();
        if ($this->password == null || $this->password == '' || $this->username== '' || $this->username== null){
            $errors[] ='Täytä puuttuvat kentät';
        }
        return $errors;
    }
}
    
    
