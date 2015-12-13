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
                'reserve' => $row['reserve']
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
                'reserve' => $row['reserve']
            ));
            return $tuote;
        } else {
           return null; 
        }
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Tuote (fname, price, sale, description, orderit, reserve) VALUES (:fname, :price, :sale, :description, :orderit, :reserve) RETURNING id');      
        $query->execute(array('fname' => $this->fname, 'price' => $this->price, 'sale' => $this->sale, 'description' => $this->description, 'orderit' => $this->orderit, 'reserve' => $this->reserve));
        $row = $query->fetch();
        
        //Kint::trace();
        //Kint::dump($row);
        
        $this->id = $row['id'];
    }
    
    public function update(){
        $query = DB::connection()->prepare('UPDATE Tuote SET fname = :fname, price = :price, sale = :sale, description = :description, orderit = :orderit, reserve = :reserve WHERE id = :id');
        $query->execute(array('id' => $this->id, 'fname' => $this->fname, 'price' => $this->price, 'sale' => $this->sale, 'description' => $this->description, 'orderit' => $this->orderit, 'reserve' => $this->reserve));
        
        //Kint::dump($row);
    }
    public function remove($id){
        self::removeTuoteYhdiste($id);
        $query = DB::connection()->prepare('DELETE FROM Tuote WHERE id = :id');
        $query->execute(array('id' => $id));
    }
    //$this->id
    
    public function getTuoteryhmat(){
        $tuoteryhmat = array();
        $query = DB::connection()->prepare('SELECT * FROM Tuoteryhmä WHERE groupid IN (SELECT * FROM TuoteJaRyhmaYhdiste WHERE product_id = :product_id');
        $query->execute(array('product_id' => $this->product_id));
        $row = $query->fetchAll();
        
        foreach ($rows as $row) {
            $tuoteryhmat[] = new Tuoteryhma(array(
                'groupid' => $row['groupid'],
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
                'orderit' => $row['orderit'],
                'reserve' => $row['reserve']
            ));
        }
        return $tuotteet;
    }
    
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
                'orderit' => $row['orderit'],
                'reserve' => $row['reserve']
            ));
        }
        return $tuotteet;
    }
 
    //validate metodit
    public function validate_name(){
        
        $errors = array();
        if($this->fname== '' || $this->fname== null){
            $errors[] ='Nimi ei saa olla tyhjä';
        }
        return $errors; 
         
    }
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
     
}

