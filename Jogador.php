<?php
    class Jogador {
        private $nome;

        public function __construct() {
        }

        public function getNome() {
            return $this->nome;
        }
        public function setNome($nome) {
           $this->nome = $nome;
        }
    }
?>
