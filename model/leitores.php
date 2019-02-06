<?php
    include_once 'crud.php';
    class leitores extends Crud {
        protected  $id;
        protected  $nome;
        protected  $cpf;
        public function getNome()
        {
            return $this->nome;
        }
        public function getId()
        {
            return $this->id;
        }
        public function setNome($nome)
        {
            $this->nome = $nome;
        }
        public function getCpf()
        {
            return $this->cpf;
        }
        public function setCpf($cpf)
        {
            $this->cpf = $cpf;
        }
    }
?>

