<?php
    include_once 'crud.php';
    class leitores_livros extends Crud
    {
        protected $idLeitores;
        protected $idLivros;
        protected $id;

        public function getIdLeitores()
        {
            return $this->idLeitores;
        }

        public function setIdLeitores($idLeitores)
        {
            $this->idLeitores = $idLeitores;
        }

        public function getIdLivros()
        {
            return $this->idLivros;
        }

        public function setIdLivros($idLivros)
        {
            $this->idLivros = $idLivros;
        }

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
        }
    }
?>