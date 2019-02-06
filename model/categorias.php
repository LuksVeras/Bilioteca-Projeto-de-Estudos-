<?php
    include_once 'crud.php';
    class categorias extends Crud {
        protected $id;
        protected $genero;
        public function getGenero()
        {
            return $this->genero;
        }
        public function getId()
        {
            return $this->id;
        }
        public function setGenero($genero)
        {
            $this->genero = $genero;
        }
    }
?>