<?php
    class Config{
        protected $con = null;
        function __construct() {
            try {
                $this->con = new PDO('mysql:host=localhost;dbname=biblioteca', "root", "");
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'ERROR: não conectou!';
            }
        }
        public function getConect(){
            return $this->con;
        }
    }
?>