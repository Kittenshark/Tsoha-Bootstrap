<?php
class Tilaus extends BaseModel{
    public $orderid, $price, $orderday, $arrivaladdress, $billingaddress, $product_id, $orderer;
    
    public function __construct($attributes){
        parent::__construct($attributes);$attributes;
       $this->validators = array('validate_address');
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Tilaus');
        $query->execute();
        
        $rows = $query->fetchAll();
        $tilaukset = array();
        $tilaukset = self::rivitKuntoon($rows);
        return $tilaukset;
    }
    
    public static function find($orderid){
        $query = DB::connection()->prepare('SELECT * FROM Tilaus WHERE orderid = :orderid LIMIT 1');
        $query->execute(array('orderid' => $orderid));
        $row = $query->fetch();
        
        if($row){
            $tilaus = new Tilaus(array(
                'orderid' => $row['orderid'],
                'price' => $row['price'],
                'orderday' => $row['orderday'],
                'arrivaladdress' => $row['arrivaladdress'],
                'billingaddress' => $row['billingaddress'],
                'product_id' => $row['product_id'],
                'orderer' => $row['orderer']
            ));
            return $tilaus;
        } else {
           return null; 
        }
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Tilaus (price, orderday, arrivaladdress, billingaddress, product_id, orderer) VALUES (:price, :orderday, :arrivaladdress, :billingaddress, :product_id, :orderer) RETURNING orderid');      
        $query->execute(array('price' => $this->price, 'orderday' => $this->orderday, 'arrivaladdress' => $this->arrivaladdress, 'billingaddress' => $this->billingaddress, 'product_id' => $this->product_id, 'orderer' => $this->orderer));
        $row = $query->fetch();
        
        $this->orderid = $row['orderid'];
    }
    
    public function update(){
        $query = DB::connection()->prepare('UPDATE Tilaus SET arrivaladdress = :arrivaladdress, billingaddress = :billingaddress, price = :price, orderday = :orderday, product_id = :product_id, orderer = :orderer WHERE orderid = :orderid');
        $query->execute(array('orderid' => $this->orderid, 'arrivaladdress' => $this->arrivaladdress, 'billingaddress' => $this->billingaddress, 'price' => $this->price, 'orderday' => $this->orderday, 'product_id' => $this->product_id, 'orderer' => $this->orderer));
        
        //Kint::dump($row);
    }
    
    public function remove($orderid){
        $query = DB::connection()->prepare('DELETE FROM Tilaus WHERE orderid = :orderid');
        $query->execute(array('orderid' => $orderid));
    }

    public static function  findyourorders(){
        $query = DB::connection()->prepare('SELECT * FROM Tilaus INNER JOIN Kayttaja ON tilaus.orderer = kayttaja.userid');
        $query->execute();
        
        $rows = $query->fetchAll();
        $tilaukset = array();
        $tilaukset = self::rivitKuntoon($rows);
        return $tilaukset;
    }
    
    public static function rivitKuntoon($rows){
        foreach ($rows as $row) {
            $tilaukset[] = new Tilaus(array(
                'orderid' => $row['orderid'],
                'price' => $row['price'],
                'orderday' => $row['orderday'],
                'arrivaladdress' => $row['arrivaladdress'],
                'billingaddress' => $row['billingaddress'],
                'product_id' => $row['product_id'],
                'orderer' => $row['orderer']
            ));
        }
        return $tilaukset;
    }
    
    public static function listuserorders($orderer){
        $query = DB::connection()->prepare('SELECT * FROM Tilaus WHERE orderer = :orderer');
        $query->execute(array('orderer' => $orderer));
        $rows = $query->fetchAll();
        
        $tilaukset = array();
        $tilaukset = self::rivitKuntoon($rows);
        
        return $tilaukset;
    }

    public function validate_address(){
        $errors = array();
        if($this->arrivaladdress== '' || $this->arrivaladdress== null || $this->billingaddress == '' || $this->billingaddress == null){
            $errors[] ='Täytä tyhjät kentät';
        }
        
        return $errors;     
    }
}
