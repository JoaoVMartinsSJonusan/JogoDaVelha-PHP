<?php
    require_once 'Tabuleiro.php';
    require_once "Historico.php";
    class Jogadas extends Tabuleiro {   
        public function __construct() {
            
        }
        public function jogarContraRobo($jogador, $tamanhoTabu) {
            
            $this->tamanhoJogo = $tamanhoTabu;
            $this->novoTabuleiro();
            do {
                //$this->limparTela();
                if ($this->verificaVelha()) {
                    echo "Deu Velha, ninguém ganhou!\n";
                    break;
                }

                echo "Olá " . $jogador->getNome() . ", Bem vindo ao jogo da velha contra a Máquina!\n";
                echo "Aqui está o Tabuleiro:\n";
                $this->exemploTabuleiro();
                $this->tabuleiroJogado();
                echo "\nDigite sua escolha no tabuleiro: ";
                $escolha = intval(fgets(STDIN));
                $this->escolhaJG1($escolha);

                if ($this->verificarVencedor()) {
                    echo "Parabéns " . $jogador->getNome() . ", Você venceu!\n";
                    break;
                }

                if (!$this->verificaVelha()) {
                    $this->escolhaRobo();
                }

                if ($this->verificarVencedor()) {
                    echo "Que pena, você perdeu para o Robô :(\n";
                    break;
                }
            } while (!$this->verificarVencedor());
        }

        public function jogadorContraJogador($jogador1, $jogador2, $tamanhoTabu) {
            $arquivo = new Historico();
            $this->tamanhoJogo = $tamanhoTabu;
            $this->novoTabuleiro();
            do {
                if ($this->verificaVelha()) {
                    echo "Deu Velha, ninguém ganhou!\n";
                    break;
                }

                echo "Olá " . $jogador1->getNome() . " e " . $jogador2->getNome() . ", Sejam bem vindos ao jogo da velha!\n";
                echo "Aqui está o Tabuleiro:\n";
                $this->exemploTabuleiro();
                $this->tabuleiroJogado();
                echo "\n" . $jogador1->getNome() . ", digite sua escolha no tabuleiro: ";
                $escolha = intval(fgets(STDIN));
                $this->escolhaJG1($escolha);
                $this->exemploTabuleiro();
                $this->tabuleiroJogado();

                if ($this->verificaVelha()) {
                    echo "Deu Velha, ninguém ganhou!\n";
                    break;
                }

                echo "Olá " . $jogador1->getNome() . " e " . $jogador2->getNome() . ", Sejam bem vindos ao jogo da velha!\n";
                echo "Aqui está o Tabuleiro:\n";
                $this->exemploTabuleiro();
                $this->tabuleiroJogado();

                if ($this->verificarVencedor()) {
                    $nomeAdd = $jogador1->getNome();
                    echo "Parabéns " . $jogador1->getNome() . ", Você venceu!\n";
                    $arquivo->salvaDados($nomeAdd);
                    break;
                }

                echo $jogador2->getNome() . ", digite sua escolha no tabuleiro: ";
                $escolha = intval(fgets(STDIN));
                $this->escolhaJG2($escolha);

                if ($this->verificaVelha()) {
                    echo "Deu Velha, ninguém ganhou!\n";
                    break;
                }

                echo "Olá " . $jogador1->getNome() . " e " . $jogador2->getNome() . ", Sejam bem vindos ao jogo da velha!\n";
                echo "Aqui está o Tabuleiro:\n";
                $this->exemploTabuleiro();
                $this->tabuleiroJogado();

                if ($this->verificarVencedor()) {
                    echo "Parabéns " . $jogador2->getNome() . ", Você venceu!\n";
                    break;
                }
            } while (!$this->verificarVencedor());
        }

        public function verificarVencedor() {
            // Verifica linhas
            for ($i = 0; $i < $this->tamanhoJogo; $i++) {
                $primeiroElemento = $this->jogo[$i][0];
                $vencedorEncontrado = true;
                for ($j = 1; $j < $this->tamanhoJogo; $j++) {
                    if ($this->jogo[$i][$j] !== $primeiroElemento || $primeiroElemento === "-") {
                        $vencedorEncontrado = false;

                        break;
                    }
                }

                if ($vencedorEncontrado) {
                    $this->tabuleiroJogado();
                    echo "Fim de Jogo!!!\n";

                    return true; // Vencedor encontrado em uma linha
                }
            }
            
            // Verifica colunas
            for ($j = 0; $j < $this->tamanhoJogo; $j++) {
                $primeiroElemento = $this->jogo[0][$j];
                $vencedorEncontrado = true;
                for ($i = 1; $i < $this->tamanhoJogo; $i++) {
                    if ($this->jogo[$i][$j] !== $primeiroElemento || $primeiroElemento === "-") {
                        $vencedorEncontrado = false;

                        break;
                    }
                }

                if ($vencedorEncontrado) {
                    $this->tabuleiroJogado();
                    echo "Fim de Jogo!!!\n";

                    return true; // Vencedor encontrado em uma coluna
                }
            }

            // Verifica diagonais 
            $primeiroElemento = $this->jogo[0][0];
            $vencedorEncontrado = true;
            for ($i = 1; $i < $this->tamanhoJogo; $i++) {
                if ($this->jogo[$i][$i] !== $primeiroElemento || $primeiroElemento === "-") {
                    $vencedorEncontrado = false;

                    break;
                }
            }

            if ($vencedorEncontrado) {
                $this->tabuleiroJogado();
                echo "Fim de Jogo!!!\n";
                
                return true;
            }

            return false;
        }

        private function verificaVelha() {
            $cont = 0;
            for ($i = 0; $i < $this->tamanhoJogo; $i++) {
                for ($j = 0; $j < $this->tamanhoJogo; $j++) {
                    if ($this->jogo[$i][$j] === "-") {
                        $cont++;
                    }
                }
            }
        
            if ($cont === 0) {
                echo "Deu Velha, ninguém ganhou!\n";

                return true;
            }
        
            return false;
        }

        public function limparTela() {
            for ($i=0; $i < 50; $i++) { 
                echo " \n";
            }
        }
    }
?>
