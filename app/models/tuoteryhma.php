<?php
class Tuoteryhma extends BaseModel{
    public $id, $fname, $description;
    public function __construct($attributes){
        parent::__construct($attributes);$attributes;
        //$this->validators = array('validate_name', 'validate_pricing_is_number');
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Tuoteryhma');
        $query->execute();
        
        $rows = $query->fetchAll();
        $tuoteryhmat = array();
        
        foreach ($rows as $row) {
            $tuoteryhmat[] = new Tuoteryhma(array(
                'id' => $row['id'],
                'fname' => $row['fname'],
                'description' => $row['description']
            ));
        }
        return $tuoteryhmat;
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Tuoteryhma WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $tuoteryhma = new Tuoteryhma(array(
                'id' => $row['id'],
                'fname' => $row['fname'],
                'description' => $row['description']
            ));
            return $tuoteryhma;
        } else {
           return null; 
        }
    }
    
    public static function findIdByName($fname){
        $query = DB::connection()->prepare('SELECT * FROM Tuoteryhma WHERE fname = :fname LIMIT 1');
        $query->execute(array('fname' => $fname));
        $row = $query->fetch();
        
        if($row){
            $tuoteryhma = new Tuoteryhma(array(
                'id' => $row['id'],
                'fname' => $row['fname'],
                'description' => $row['description']
            ));
            return $tuoteryhma->id;
        } else {
           return null; 
        }
    }
}
