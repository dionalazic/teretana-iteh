<?php

    class Trening {
        public $id;
        public $naziv;
        public $kategorija_id;
        public $sala;
        public $datum;
        public $vreme;

        
        public function __construct($id = null, $naziv = null, $kategorija_id = null, $sala = null, $datum = null, $vreme = null)
        {
            $this -> id = $id;
            $this -> naziv = $naziv;
            $this -> kategorija_id = $kategorija_id;
            $this -> sala = $sala;
            $this -> datum = $datum;
            $this -> vreme = $vreme;
        }


        public static function getAll(mysqli $conn){
            $query = "SELECT * FROM trening";
            return $conn->query($query);
        }


        public static function deleteById($id, mysqli $conn){
            $query = "DELETE FROM trening WHERE id=$id";
            return $conn->query($query);
        }


        public static function updateById ($id, $naziv,$kategorija_id,$sala,$datum,$vreme, mysqli $conn){
            $query = "UPDATE trening set naziv = $naziv,
                                         kategorija_id = $kategorija_id,
                                         sala = $sala,
                                         datum = $datum,
                                         vreme = $vreme 
                                         WHERE id = $id";
            return $conn->query($query);
        }


        public static function insert($naziv,$kategorija_id,$sala,$datum,$vreme, mysqli $conn){
            $query = "INSERT INTO trening(naziv, kategorija_id, sala, datum, vreme) 
                             values('$naziv', 
                                    '$kategorija_id',
                                    '$sala',
                                    '$datum',
                                    '$vreme')";

            return $conn -> query($query);
        }


        public static function getById($id, mysqli $conn){
            $query = "SELECT * FROM trening WHERE id = $id";
            $obj = array();

            if($msqlObj = $conn->query($query)){
                while($red = $msqlObj->fetch_array(1)){
                    $obj[] = $red;
                }
            }
            return $obj;
        }
        
    }



?>