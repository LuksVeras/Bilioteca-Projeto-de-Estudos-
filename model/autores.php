<?php
    include_once 'crud.php';
    class autores extends Crud {
        protected  $id;
        protected  $nome;
        public function getId()
        {
            return $this->id;
        }
        public function getNome()
        {
            return $this->nome;
        }
        public function setNome($nome)
        {
            $this->nome = $nome;
        }
    }
?>