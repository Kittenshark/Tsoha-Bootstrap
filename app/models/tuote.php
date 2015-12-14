<?php

class Tuote extends BaseModel{
    public $id, $fname, $price, $sale, $description, $orderit, $reserve, $groupid;
    
    public function __construct($attributes){
        parent::__construct($attributes);$attributes;
        $this->validators = array('validate_pricing_is_number', 'validate_not_empty');
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
                'orderit' => $row['orderit']
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
                'orderit' => $row['orderit']
            ));
            return $tuote;
        } else {
           return null; 
        }
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Tuote (fname, price, sale, description, orderit) VALUES (:fname, :price, :sale, :description, :orderit) RETURNING id');      
        $query->execute(array('fname' => $this->fname, 'price' => $this->price, 'sale' => $this->sale, 'description' => $this->description, 'orderit' => $this->orderit));
        $row = $query->fetch();
        
        //Kint::trace();
        //Kint::dump($row);
        
        $this->id = $row['id'];
    }
    
    public function update(){
        $query = DB::connection()->prepare('UPDATE Tuote SET fname = :fname, price = :price, sale = :sale, description = :description, orderit = :orderit WHERE id = :id');
        $query->execute(array('id' => $this->id, 'fname' => $this->fname, 'price' => $this->price, 'sale' => $this->sale, 'description' => $this->description, 'orderit' => $this->orderit));
        
        //Kint::dump($row);
    }
    public function remove($id){
        self::removeTuoteYhdiste($id);
        $query = DB::connection()->prepare('DELETE FROM Tuote WHERE id = :id');
        $query->execute(array('id' => $id));
    }
    //tuotteen tuoteryhmät
    public function getTuoteryhmat($id){
        $tuoteryhmat = array();
        $query = DB::connection()->prepare('SELECT * FROM Tuoteryhma WHERE EXISTS (SELECT * FROM TuoteJaRyhmaYhdiste AS y WHERE Tuoteryhma.id = y.groupid AND y.product_id = :id)');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        
        foreach ($rows as $row) {
            $tuoteryhmat[] = new Tuoteryhma(array(
                'id' => $row['id'],
                'fname' => $row['fname'],
                'description' => $row['description']
            ));
        }
        return $tuoteryhmat;
    }
    
    public function createTuoteYhdiste($product_id, $groupid){
        $query = DB::connection()->prepare('INSERT INTO TuoteJaRyhmaYhdiste (product_id, groupid) VALUES (:product_id, :groupid)');      
        $query->execute(array('product_id' => $product_id, 'groupid' => $groupid));
    }
    
    public function removeTuoteYhdiste($product_id){
        $query = DB::connection()->prepare('DELETE FROM TuoteJaRyhmaYhdiste WHERE product_id = :product_id');
        $query->execute(array('product_id' => $product_id));
    }
    
    public static function listSales(){
        $query = DB::connection()->prepare('SELECT * FROM Tuote WHERE sale > 0 ORDER BY fname');
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
                'orderit' => $row['orderit']
            ));
        }
        return $tuotteet;
    }
    //halutun tuoteryhman tuotteiden listaus
    public static function listThings($groupid){
        $query = DB::connection()->prepare('SELECT * FROM Tuote WHERE EXISTS (SELECT * FROM TuoteJaRyhmaYhdiste AS y WHERE Tuote.id = y.product_id AND groupid = :groupid)');
        $query->execute(array('groupid' => $groupid));
        
        $rows = $query->fetchAll();
        $tuotteet = array();
        
        foreach ($rows as $row) {
            $tuotteet[] = new Tuote(array(
                'id' => $row['id'],
                'fname' => $row['fname'],
                'price' => $row['price'],
                'sale' => $row['sale'],
                'description' => $row['description'],
                'orderit' => $row['orderit']
            ));
        }
        return $tuotteet;
    }
 
    //validate metodit
    public function validate_pricing_is_number(){
        $errors = array();
        if (!is_numeric($this->price) || (!is_numeric($this->sale))){
            $errors[] ='Hinnan ja alennuksen oltava numeroita';
        }
        return $errors;
    }
    public function validate_description_not_too_long(){
        $errors = array();
        if (!is_numeric($this->sale) || (!is_numeric($this->sale))){
            $errors[] ='Hinnan ja alennuksen oltava numeroita';
        }
        return $errors;
    }
    
    public function validate_not_empty(){
        $errors = array();
        if ($this->description == null || $this->description == '' || $this->fname== '' || $this->fname== null){
            $errors[] ='Täytä puuttuvat kentät';
        }
        return $errors;
    }
     
}

