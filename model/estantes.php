<?php
    include_once 'crud.php';
    class estantes extends Crud {
        protected  $id = null;
        protected  $codigo;
        public function getCodigo()
        {
            return $this->codigo;
        }
        public function setCodigo($codigo)
        {
            $this->codigo = $codigo;
        }
        public function getId()
        {
            return $this->id;
        }
    }
?>