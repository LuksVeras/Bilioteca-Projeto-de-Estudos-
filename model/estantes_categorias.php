<?php
    include_once 'crud.php';
    class estantes_categorias extends Crud {
        protected $idCategorias;
        protected $idEstantes;
        protected $id;

        public function getIdCategorias() {
            return $this->idCategorias;
        }

        public function setIdCategorias($idCategorias) {
            $this->idCategorias = $idCategorias;
        }

        public function getIdEstantes() {
            return $this->idEstantes;
        }

        public function setIdEstantes($idEstantes) {
            $this->idEstantes = $idEstantes;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }
    }
?>