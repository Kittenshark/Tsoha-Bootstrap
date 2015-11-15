<?php

class Tuote extends BaseModel{
    public $Tid, $fname, $price, $sale, $description, $orderIt, $reserve;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Tuote');
        $query->execute();
        
        $rows = $query->fetchAll();
        $tuotteet = array();
        
        foreach ($rows as $row) {
            $tuotteet[] = new Tuote(array(
                'tid' => $row['tid'],
                'fname' => $row['fname'],
                'price' => $row['price'],
                'sale' => $row['sale'],
                'descripotion' => $row['description'],
                'orderit' => $row['orderit'],
                'reserve' => $row['reserve']
            ));
        }
        return $tuotteet;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Tuote WHERE tid = :tid LIMIT 1');
        $query->execute(array('tid' => $tid));
        $row = $query->fetch();
        
        if($row){
            $tuote = new Tuote(array(
                'tid' => $row['tid'],
                'fname' => $row['fname'],
                'price' => $row['price'],
                'sale' => $row['sale'],
                'descripotion' => $row['description'],
                'orderit' => $row['orderit'],
                'reserve' => $row['reserve']
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

