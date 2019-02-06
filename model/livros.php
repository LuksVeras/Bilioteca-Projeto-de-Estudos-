<?php
    include_once 'crud.php';
    class livros extends Crud {
        protected $id;
        protected $titulo;
        protected $lancamento;
        protected $sinopse;
        protected $idCategorias;

        public function getId() {
            return $this->id;
        }
        public function getIdCategorias() {
            return $this->idCategorias;
        }

        public function setIdCategorias($idCategorias) {
            $this->idCategorias = $idCategorias;
        }

        public function getTitulo() {
            return $this->titulo;
        }
        public function setTitulo($titulo) {
            $this->titulo = $titulo;
        }
        public function getLancamento() {
            return $this->lancamento;
        }
        public function setLancamento($lancamento) {
            $this->lancamento = $lancamento;
        }
        public function getSinopse() {
            return $this->sinopse;
        }
        public function setSinopse($sinopse) {
            $this->sinopse = $sinopse;
        }


    }