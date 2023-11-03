<?php
    require_once 'Tabuleiro.php';
    require_once "Historico.php";
    require_once "Jogador.php";
    class Jogadas extends Tabuleiro {   
        public function __construct() {
        }
        //Escolha caso o jogo for contra o computador.
        public function jogarContraRobo($jogador, $tamanhoTabu) {
            $arquivo = new Historico();
            $this->tamanhoJogo = $tamanhoTabu;
            $this->novoTabuleiro();

            do {
                $this->limparTela();

                if ($this->verificaVelha()) {
                    echo "Deu Velha, ninguém ganhou!\n";
                    break;
                }

                echo "Olá " . $jogador->getNome() . ", Bem vindo ao jogo da velha contra a Máquina!\n";
                echo "Aqui está o Tabuleiro:\n";
                $this->exemploTabuleiro();
                $this->tabuleiroJogado();
                echo $jogador->getNome() . "\n Digite sua escolha no tabuleiro: ";
                $escolha = intval(fgets(STDIN));
                $this->escolhaJG1($escolha);

                if ($this->verificarVencedor()) {
                    echo "Parabéns " . $jogador->getNome() . ", Você venceu!\n";
                    $arquivo->salvaDados($jogador->getNome(), 1);

                    break;
                }

                if (!$this->verificaVelha()) {
                    $this->escolhaRobo();
                }

                if ($this->verificarVencedor()) {
                    $arquivo->salvaDados($jogador->getNome(), 0);
                    echo "Que pena, você perdeu para o Robô :(\n";

                    break;
                }
            } while (!$this->verificarVencedor());
        }
        //Escolha caso o jogo for contra outro jogador.
        public function jogadorContraJogador($jogador1, $jogador2, $tamanhoTabu) {
            $arquivo = new Historico();
            $this->tamanhoJogo = $tamanhoTabu;
            $this->novoTabuleiro();

            do {
                $this->limparTela();

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
                    echo "Parabéns " . $jogador1->getNome() . ", Você venceu!\n";
                    $arquivo->salvaDados($jogador1->getNome(), 1);

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
                    $arquivo->salvaDados($jogador2->getNome(), 1);

                    break;
                }
            } while (!$this->verificarVencedor());
        }
        //Funcao para verificar as condições de vitoria.
        public function verificarVencedor() {
            // Verifica linhas.
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

                    return true;
                }
            }
            
            // Verifica colunas.
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

                    return true;
                }
            }

            // Verifica diagonal esquerda.
            $primeiroElemento = $this->jogo[0][0];
            $vencedorEncontrado = true;
            for ($i = 1; $i < $this->tamanhoJogo; $i++) {
                if ($this->jogo[$i][$i] !== $primeiroElemento || $primeiroElemento === "-") {
                    $vencedorEncontrado = false;

                    break;
                }
            }

            // Verifica diagonal direita.
            $primeiroElemento = $this->jogo[0][$this->tamanhoJogo - 1];
            $vencedorEncontrado = true;
            for ($i = 1; $i < $this->tamanhoJogo; $i++) {
                if ($this->jogo[$i][$this->tamanhoJogo - 1 - $i] !== $primeiroElemento || $primeiroElemento === "-") {
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
        //Verifica se o jogo deu velha.
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

        //Funcao para "limpar tela".
        public function limparTela() {
            for ($i=0; $i < 50; $i++) { 
                echo " \n";
            }
        }
    }
?>
