<?php
class Tilaus extends BaseModel{
    public $orderId, $price, $orderDay, $arrivalAddress, $billingAddress, $product_id, $orderer;
    
    public function __construct($attributes){
        parent::__construct($attributes);$attributes;
       // $this->validators = array('validate_name', 'validate_pricing_is_number');
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Tilaus');
        $query->execute();
        
        $rows = $query->fetchAll();
        $tilaukset = array();
        
        foreach ($rows as $row) {
            $tilaukset[] = new Tilaus(array(
                'orderId' => $row['orderId'],
                'price' => $row['price'],
                'orderDay' => $row['orderDay'],
                'arrivalAddress' => $row['arrivalAddress'],
                'billingAddress' => $row['billingAddress'],
                'product_id' => $row['product_id'],
                'orderer' => $row['orderer']
            ));
        }
        return $tilaukset;
    }
    
    public static function find($orderId){
        $query = DB::connection()->prepare('SELECT * FROM Tilaus WHERE orderId = :orderId LIMIT 1');
        $query->execute(array('orderId' => $orderId));
        $row = $query->fetch();
        
        if($row){
            $tilaus = new Tilaus(array(
                'orderId' => $row['orderId'],
                'price' => $row['price'],
                'orderDay' => $row['orderDay'],
                'arrivalAddress' => $row['arrivalAddress'],
                'billingAddress' => $row['billingAddress'],
                'product_id' => $row['product_id'],
                'orderer' => $row['orderer']
            ));
            return $tilaus;
        } else {
           return null; 
        }
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Tilaus (orderDay, arrivalAddress, billingAddress, product_id, orderer) VALUES (:orderDay, :arrivalAddress, :billingAddress, :prooduct_id, orderer) RETURNING id');      
        $query->execute(array('orderDay' => $this->orderDay, 'arrivalAddress' => $this->arrivalAddress, 'billingAddress' => $this->billingAddress, 'product_id' => $this->product_id, 'orderer' => $this->orderer));
        $row = $query->fetch();
        
        $this->orderId = $row['orderId'];
    }
    
    public function countPrice(){
        $query = DB::connection()->prepare('SELECT * FROM Tilaus INNER JOIN TUOTE ON tuote.id = $this->product_id');
        $query->execute();
        $rows = $query->fetchAll();
        
        //$this->price = Tuote::price;
    }
    
    public static function find_all_orders(){
        $query = DB::connection()->prepape('SELECT Tuote.fname, Tuote.price, Tuote.sale, Kayttaja.userid FROM Tilaus INNER JOIN Tuote ON Tilaus.orderer = Kayttaja.userid' );
        $query->execute();
        
    }
}
