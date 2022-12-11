<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

require 'vendor/autoload.php';
//preparando para o teste
$leilao= new Leilao('Fusca');

$maira=new Usuario('maira');

$joao=new Usuario('joao');

$leilao->recebeLance(new Lance($maira,2000));

$leilao->recebeLance(new Lance($joao,2500));

$leiloeiro = new Avaliador();

//executa o teste
$leiloeiro->avalia($leilao);

$maiorValor=$leiloeiro->getMaiorValor();

echo $maiorValor.PHP_EOL;

//saida do teste
$valorEsperado=2500;

if($maiorValor == $valorEsperado){
    echo "Ok";
}else{
    echo "Falhou";
}