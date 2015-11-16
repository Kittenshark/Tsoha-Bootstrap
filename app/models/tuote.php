<?php

class Tuote extends BaseModel{
    public $tid, $fname, $price, $sale, $description, $orderit, $reserve;
    
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
    
    public static function find($tid){
        $query = DB::connection()->prepare('SELECT * FROM Tuote WHERE tid = :tid LIMIT 1');
        $query->execute(array('tid' => $tid));
        $row = $query->fetch();
        
        if($row){
            $tuote = new Tuote(array(
                'tid' => $row['tid'],
                'fname' => $row['fname'],
                'price' => $row['price'],
                'sale' => $row['sale'],
                'description' => $row['description'],
                'orderit' => $row['orderit'],
                'reserve' => $row['reserve']
            ));
            return $tuote;
        }
        return null;
    }
    
    
    public static function save(){
        $query = DB::connection()->prepare('INSERT INTO Tuote (fname, price, sale, description, orderit, reserve) VALUES (:fname, :price, :sale, :description, :orderit, :reserve) RETURNING tid');      
        $query->execute(array('fname' => $this->fname, 'price' => $this->price, 'sale' => $this->sale, 'description' => $this->description, 'orderit' => $this->orderit, 'reserve' => $this->reserve));
        
        $row = $query->fetch();
        Kint::trace();
        Kint::dump($row);
        
        //$this->tid = $row['tid'];
    }
}

