<?php
    include_once 'crud.php';
    class livros_autores extends Crud {
        protected $idLivros;
        protected $idAutores;
        protected $id;

        public function getIdLivros() {
            return $this->idLivros;
        }

        public function setIdLivros($idLivros)
        {
            $this->idLivros = $idLivros;
        }

        public function getIdAutores() {
            return $this->idAutores;
        }

        public function setIdAutores($idAutores) {
            $this->idAutores = $idAutores;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }
    }
?>