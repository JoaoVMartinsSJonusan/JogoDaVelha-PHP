<?php
    class Historico {
        public function __construct() {
        }
        //Salva os dados em um arquivo csv.
        public function salvaDados($nomeAdd, $valor){
            $arquivo  = fopen('Historico.csv', 'a');
            $dados = [
                [
                    $nomeAdd, $valor
                ],
            ];
            foreach ($dados as $linha) {
                fputcsv($arquivo, $linha);
            }
            fclose($arquivo);
        }
        //mostra o ranking de acordo com a quantidade de vitorias usando um array associativo.
        public function ranking(){
            $historico = array();
            if (($handle = fopen('Historico.csv', 'r')) !== FALSE) {
                while (($linha = fgetcsv($handle, 1000, ',')) !== FALSE) {
                    if(array_key_exists($linha[0], $historico)){
                        $historico[$linha[0]] += $linha[1];
                    } else {
                        $historico[$linha[0]] = $linha[1];
                    }
                }
                fclose($handle);
            } else {
                echo "Não foi possível abrir o arquivo CSV.";
            }
            arsort($historico);

            $posi = 1;
            foreach ($historico as $nome => $vitorias) {
                echo "#" . $posi . ": " .$nome . ", Vitorias: " . $vitorias . "\n";
                $posi++;
            }
        }
        //mostra o historico de partidas usando um array multidimensional.
        public function historico(){
            $historico = array();
            if (($handle = fopen('Historico.csv', 'r')) !== FALSE) {
                while (($linha = fgetcsv($handle, 1000, ',')) !== FALSE) {
                    $historico[$linha[0]][] = $linha[1];
                }
                fclose($handle);
            } else {
                echo "Não foi possível abrir o arquivo CSV.";
            }
            
            foreach ($historico as $nome => $value) {
                foreach ($value as $v => $value) {
                    if($value == 1){
                        echo "Vitoria de: " .$nome . "\n";
                    } else if ($value == 0){
                        echo "Derrota de: " .$nome . " para o Robo\n";
                    }
                }
            }
        }
    }
?>
