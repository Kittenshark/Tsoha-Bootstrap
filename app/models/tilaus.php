<?php
class Tilaus extends BaseModel{
    public $orderId, $price, $orderDay, $arrivalAddress, $billingAddress, $product_id, $orderer;
    
    public function __construct($attributes){
        parent::__construct($attributes);$attributes;
       // $this->validators = array('validate_name', 'validate_pricing_is_number');
    }
    
    public static function find($orderId){
        $query = DB::connection()->prepare('SELECT * FROM Tilaus WHERE orderId = :orderId LIMIT 1');
        $query->execute(array('orderId' => $orderId));
        $row = $query->fetch();
        
        if($row){
            $tuote = new Tuote(array(
                'orderId' => $row['orderId'],
                'price' => $row['price'],
                'orderDay' => $row['orderDay'],
                'arrivalAddress' => $row['arrivalAddress'],
                'billingAddress' => $row['billingAddress'],
                'prooduct_id' => $row['prooduct_id'],
                'orderer' => $row['orderer']
            ));
            return $tilaus;
        } else {
           return null; 
        }
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Tilaus (orderDay, arrivalAddress, billingAddress, prooduct_id, orderer) VALUES (:orderDay, :arrivalAddress, :billingAddress, :prooduct_id, orderer) RETURNING id');      
        $query->execute(array('orderDay' => $this->orderDay, 'arrivalAddress' => $this->arrivalAddress, 'billingAddress' => $this->billingAddress, 'prooduct_id' => $this->prooduct_id, 'orderer' => $this->orderer));
        $row = $query->fetch();
        
        //Kint::trace();
        //Kint::dump($row);
        
        $this->orderId = $row['orderId'];
    }
    
    public function countPrice(){
        $query = DB::connection()->prepare('SELECT * FROM Tilaus INNER JOIN TUOTE ON tuote.id = $this->product_id');
        $query->execute();
        $rows = $query->fetchAll();
        
        //$this->price = Tuote::price;
    }
}
