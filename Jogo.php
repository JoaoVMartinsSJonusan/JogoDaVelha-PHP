<?php
require_once 'Jogadas.php';
require_once 'Jogador.php';
require_once "Historico.php";

class Jogo {
    public static function main() {
        $stdin = fopen('php://stdin', 'r');
        $jogador = new Jogador();
        $arquivo = new Historico();
        echo "Bem vindo ao Jogo da Velha, qual seu nome? ";
        $nome = trim(fgets($stdin));
        $jogador->setNome($nome);
        $nome = null;
        
        
        do {
            
            echo "Bem vindo ao Jogo da Velha, abaixo temos as opções Disponiveis para voce:\n\n";
            echo "[1] Jogar contra Maquina\n";
            echo "[2] Jogar contra Jogador\n";
            echo "[3] Historico\n";
            echo "[4] Ranking\n";
            echo "[5] Sair\n\n";
            echo "Qual sua escolha: ";
            $escolha = intval(fgets($stdin));
            if ($escolha == 1) {

                $jogadas = new Jogadas();
                echo "Digitando apenas um numero, Qual o tamanho do tabuleiro: ";
                $tamanhoTabu = intval(fgets($stdin));
                $jogadas->jogarContraRobo($jogador, $tamanhoTabu);
            } else if ($escolha == 2) {
                echo "Qual o nome do jogador 2: ";
                $nomeJogador2 = trim(fgets($stdin));
                $jogador2 = new Jogador($nomeJogador2);
                $jogadas = new Jogadas();
                echo "Digitando apenas um numero, Qual o tamanho do tabuleiro: ";
                $tamanhoTabu = intval(fgets($stdin));
                $jogadas->jogadorContraJogador($jogador, $jogador2, $tamanhoTabu);
            } else if($escolha == 3){
                $arquivo->historico();
            } else if($escolha == 4){
                $arquivo->ranking();
            }
            
        } while ($escolha != 5);
        fclose($stdin);
    }
}

Jogo::main();
?>
