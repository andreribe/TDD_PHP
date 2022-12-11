<?php

namespace Alura\Leilao\Tests\Model;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    /**
     * @var Avaliador 
     */
    public function testLeilaoDeveReceberLancesRepetidos()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Usuario nao pode propor 2 lances iguais');
        $maira= new Usuario('Maria');
        $leilao = new Leilao('Variante');
        
        $leilao->recebeLance(new Lance($maira,1500));   
        $leilao->recebeLance(new Lance($maira,1000));   

        // static::assertCount(1,$leilao->getLances());
        // static::assertEquals(1500,$leilao->getLances()[0]->getValor());
    }

    public function testLeilaoNaoDeveAceitarMaisDe5LancesPorUsuario()
    {
        $leilao = new Leilao('Brasília Amarela');
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Usuario nao pode fazer mais de 5 lances');
        
        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($maria, 1500));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 3000));
        $leilao->recebeLance(new Lance($maria, 3500));
        $leilao->recebeLance(new Lance($joao, 4000));
        $leilao->recebeLance(new Lance($maria, 4500));
        $leilao->recebeLance(new Lance($joao, 5000));
        $leilao->recebeLance(new Lance($maria, 5500));
        $leilao->recebeLance(new Lance($joao, 6000));

        // static::assertCount(10, $leilao->getLances());
        // static::assertEquals(5500, $leilao->getLances()[array_key_last($leilao->getLances())]->getValor());
    }

    /** 
     * @dataProvider geraLances 
    */
    public function testLeilaoDeveReceberLances(
        int $qtdLances,
        Leilao $leilao,
        array $valores)
    {
        // $joao = new Usuario('joao');
        // $maira= new Usuario('Maria');
        // static::assertCount($qtdLances, $leilao->getLances());
        // $leilao=new Leilao('Fiat 147 0KM');
        // $leilao->recebeLance(new Lance($joao,1000));
        // $leilao->recebeLance(new Lance($maira,2000));
        static::assertCount($qtdLances, $leilao->getLances());

        foreach ($valores as $i => $valorEsperado) {
            static::assertEquals($valorEsperado,$leilao->getLances()[$i]->getValor());
        }
        // static::assertCount($qtdLances,$leilao->getLances());
        // static::assertEquals($qtdLances,$leilao->getLances()[0]->getValor());
        // static::assertEquals($qtdLances,$leilao->getLances()[1]->getValor());
        
    }

    public function geraLances()
    {
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');
    
        $leilaoCom2Lances = new Leilao('Fiat 147 0KM');
        $leilaoCom2Lances->recebeLance(new Lance($joao, 1000));
        $leilaoCom2Lances->recebeLance(new Lance($maria, 2000));
    
        $leilaoCom1Lance = new Leilao('Fusca 1972 0KM');
        $leilaoCom1Lance->recebeLance(new Lance($maria, 5000));
    
        return [
            '2-lances' => [2, $leilaoCom2Lances, [1000, 2000]],
            '1-lance' => [1, $leilaoCom1Lance, [5000]]
        ];
    }
}