<?php

class Tuote extends BaseModel{
    public $id, $fname, $price, $sale, $description, $orderit, $reserve, $groupid;
    
    public function __construct($attributes){
        parent::__construct($attributes);$attributes;
        $this->validators = array('validate_name', 'validate_pricing_is_number');
    }
    //'validate_price', 'validate_sale', 'validate_description'
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Tuote ORDER BY fname');
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
        $query = DB::connection()->prepare('INSERT INTO Tuote (fname, price, sale, description, groupid, orderit, reserve) VALUES (:fname, :price, :sale, :description, :groupid, :orderit, :reserve) RETURNING id');      
        $query->execute(array('fname' => $this->fname, 'price' => $this->price, 'sale' => $this->sale, 'description' => $this->description, 'groupid' => $this->groupid, 'orderit' => $this->orderit, 'reserve' => $this->reserve));
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
    public function update(){
        //$query = DB::connection()->prepare('SELECT * FROM Tuote WHERE id = :id LIMIT 1');
        //$query->execute(array('id' => $id));
        //$query = "UPDATE fname, price, sale, description, orderIt, reserve SET :fname, :price, :sale, :description, :orderIt, :reserve WHERE id=:id";
        //$query = DB::connection()->prepare('UPDATE Tuote SET (fname, price, sale, description) = (:fname, :price, :sale, :description) WHERE id = :id');
        //$query->execute(array('id' => $this->id, 'fname' => $fname, 'price' => $price, 'sale' => $sale, 'description' => $description));
        
        $query = DB::connection()->prepare('UPDATE Tuote SET fname = :fname, price = :price, sale = :sale, description = :description, orderit = :orderit, reserve = :reserve WHERE id = :id');
        $query->execute(array('id' => $this->id, 'fname' => $this->fname, 'price' => $this->price, 'sale' => $this->sale, 'description' => $this->description, 'orderit' => $this->orderit, 'reserve' => $this->reserve));
        
        //Kint::dump($row);
    }
    public function remove($id){
        $query = DB::connection()->prepare('DELETE FROM Tuote WHERE id = :id');
        $query->execute(array('id' => $id));
    }
    //$this->id
    
    public function validate_name(){
        
        $errors = array();
        if($this->fname== '' || $this->fname== null){
            $errors[] ='Nimi ei saa olla tyhjä';
        }
        return $errors; 
         
    }
    
    //validate price ja sale
    public function validate_pricing_is_number(){
        $errors = array();
        if (!is_numeric($this->price) || (!is_numeric($this->sale))){
            $errors[] ='Hinnan ja alennuksen oltava numeroita';
        }
        return $errors;
    }
     
}

