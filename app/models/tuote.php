<?php

class Tuote extends BaseModel{
    public $id, $fname, $price, $sale, $description, $orderit, $reserve;
    
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
                'id' => $row['id'],
                'fname' => $row['fname'],
                'price' => $row['price'],
                'sale' => $row['sale'],
                'description' => $row['description'],
                'orderit' => $row['orderit'],
                'reserve' => $row['reserve'],
                'groupid' => $row['groupid']
            ));
        }
        return $tuotteet;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Tuote WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $tuote = new Tuote(array(
                'id' => $row['id'],
                'fname' => $row['fname'],
                'price' => $row['price'],
                'sale' => $row['sale'],
                'description' => $row['description'],
                'orderit' => $row['orderit'],
                'reserve' => $row['reserve'],
                'groupid' => $row['groupid']
            ));
            return $tuote;
        } else {
           return null; 
        }
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Tuote (fname, price, sale, description) VALUES (:fname, :price, :sale, :description) RETURNING id');      
        $query->execute(array('fname' => $this->fname, 'price' => $this->price, 'sale' => $this->sale, 'description' => $this->description));
        $row = $query->fetch();
        
        //Kint::trace();
        //Kint::dump($row);
        
        $this->id = $row['id'];
    }
    
    /*
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Tuote (fname, price, sale, description, orderit, reserve, groupid)'
                . 'VALUES (:fname, :price, :sale, :description, :orderit, :reserve,  :groupid) RETURNING id');      
        $query->execute(array('fname' => $this->fname, 'price' => $this->price, 'sale' => $this->sale, 'description' => $this->description, 'orderit' => $this->orderit, 'reserve' => $this->reserve, 'groupid' => $this->groupid));
        
        $row = $query->fetch();
        Kint::trace();
        Kint::dump($row);
        
        //$this->tid = $row['tid'];
    }
  */
    
    public function update($id){
        //$query = DB::connection()->prepare('SELECT * FROM Tuote WHERE id = :id LIMIT 1');
        //$query->execute(array('id' => $id));
        //$query = "UPDATE fname, price, sale, description, orderIt, reserve SET :fname, :price, :sale, :description, :orderIt, :reserve WHERE id=:id";
        $query = DB::connection()->prepare('UPDATE Tuote SET (fname, price, sale, description) VALUES (:fname, :price, :sale, :description');
        $query->execute(array('fname' => $fname, 'price' => $price, 'sale' => $sale, 'description' => $description));
        
        $row = $query->fetch();
        
        Kint::dump($row);
    }
    
    public function remove($id){
        //$query = DB::connection()->prepare('SELECT * FROM Tuote WHERE id = :id LIMIT 1');
        $query = DB::connection()->prepare('DELETE FROM Tuote WHERE id = :id');
        $query->execute(array('id' => $id));
        //$query = "DELETE FROM Tuote WHERE id='$id'";
        //$row = $query->fetch();
    }
    //$this->id
}

