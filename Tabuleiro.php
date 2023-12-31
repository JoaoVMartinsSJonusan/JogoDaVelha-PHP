<?php

class Tabuleiro {
    public $jogo = array(array());
    public $exemploJogo = array(array());
    public $tamanhoJogo;

    //Cria um tabuleiro de acordo com a escolha do jogador preenchendo com "-" ao iniciar o programa.
    public function novoTabuleiro() {
        for ($i = 0; $i < $this->tamanhoJogo; $i++) {
            for ($j = 0; $j < $this->tamanhoJogo; $j++) {
                $this->jogo[$i][$j] = "-";
            }
        }
    }
    //o tabuleiro que esta rodando para o jogo atual.
    public function tabuleiroJogado() {
        for ($i = 0; $i < $this->tamanhoJogo; $i++) {
            for ($j = 0; $j < $this->tamanhoJogo; $j++) {
                echo $this->jogo[$i][$j] . " ";
            }
            echo "\n";
        }
    }
    //um exemplo de tabuleiro para o jogador saber em qual casa escolher.
    public function exemploTabuleiro() {
        $preencher = 1;
        for ($i = 0; $i < $this->tamanhoJogo; $i++) {
            for ($j = 0; $j < $this->tamanhoJogo; $j++) {
                $this->exemploJogo[$i][$j] = strval($preencher);
                echo $this->exemploJogo[$i][$j] . " ";
                $preencher++;
            }
            echo "\n";
        }
        echo "----------------------------\n";
    }
    //escolhas do Jogador 1.
    public function escolhaJG1($escolha) {
        $linha = floor(($escolha - 1) / $this->tamanhoJogo);
        $coluna = floor(($escolha - 1) % $this->tamanhoJogo);
        if ($escolha >= 1 && $escolha <= $this->tamanhoJogo * $this->tamanhoJogo && $this->jogo[$linha][$coluna] === "-") {
            $this->jogo[$linha][$coluna] = "X";
        } else {
            echo "Escolha inválida, você perdeu a jogada!\n";
        }
    }
    //escolhas do Jogador 2.
    public function escolhaJG2($escolha) {
        $linha = floor(($escolha - 1) / $this->tamanhoJogo);
        $coluna = floor(($escolha - 1) % $this->tamanhoJogo);
        if ($escolha >= 1 && $escolha <= 9 && $this->jogo[$linha][$coluna] === "-") {
            $this->jogo[$linha][$coluna] = "O";
        } else {
            echo "Escolha inválida, você perdeu a jogada!\n";
        }
    }
    //escolhas random do Robo.
    public function escolhaRobo() {
        $cont = 0;
        do {
            $escolha = rand(1, $this->tamanhoJogo * $this->tamanhoJogo);
            $linha = intdiv($escolha - 1, $this->tamanhoJogo);
            $coluna = ($escolha - 1) % $this->tamanhoJogo;
            if ($escolha >= 1 && $escolha <= $this->tamanhoJogo * $this->tamanhoJogo && $this->jogo[$linha][$coluna] === "-") {
                $this->jogo[$linha][$coluna] = "O";
                $cont++;
            }
        } while ($cont === 0);
    }
}
