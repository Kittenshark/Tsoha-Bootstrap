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
}
