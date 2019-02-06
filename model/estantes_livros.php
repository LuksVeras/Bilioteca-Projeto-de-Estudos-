<?php
    include_once 'crud.php';
    class estantes_livros extends Crud {
        protected $idLivros;
        protected $idEstantes;
        protected $id;

            public function getIdLivros() {
                return $this->idLivros;
            }

            public function setIdLivros($idLivros) {
                $this->idLivros = $idLivros;
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