<?php

class Tuote extends BaseModel{
    public $id, $nimi, $hinta, $alennus, $kuvas, $varata, $tilata;
    
    public function _construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Tuote');
        $query->execute();
        
        $rows = $query->fetchAll();
        $tuotteet = array();
        
        foreach ($rows as $row) {
            $tuotteet[] = new Tuote(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'hinta' => $row['hinta'],
                'alennus' => $row['alennus'],
                'kuvaus' => $row['kuvaus'],
                'varata' => $row['varata'],
                'tilata' => $row['tilata']
            ));
        }
        return $tuotteet;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Tuote WHERE id =:id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $tuote = new Tuote(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'hinta' => $row['hinta'],
                'alennus' => $row['alennus'],
                'kuvaus' => $row['kuvaus'],
                'varata' => $row['varata'],
                'tilata' => $row['tilata']
            ));
            return $tuote;
        }
        return null;
    }
    
    public static function save(){
        $query = DB::connection()->prepare('INSERT INTO Tuote (nimi, hinta, alennus, kuvaus, varata, tilata) VALUES (:nimi, :hinta, :alennus, :kuvaus, :varata, :tilata) RETURNING id');      
        $query->execute(array('nimi' => $this->nimi, 'hinta' => $this->hinta, 'alennus' => $this->alennus, 'kuvaus' => $this->kuvaus, 'varata' => $this->varata, 'tilata' => $this->tilata));
        
        $row = $query->fetch();
        
        $this->id = $row['id'];
    }
}

 $testi = new Tuote(array('id' => 1, 'nimi' => 'Tulppaani', 'alennus' => 0.00, 'kuvaus' => 'Uusi', 'varata' => false, 'tilata' => false));

