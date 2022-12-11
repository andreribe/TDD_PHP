<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    private $leiloeiro;
    // public function criaAvaliador()
    // {
    //     $this->leiloeiro= new Avaliador(); 
    // }
    /**
     * @var Avaliador 
     */
    protected function setUp() :void
    {
        $this->leiloeiro= new Avaliador(); 
    }

    /**
     * @dataProvider leilaoEmOrdemAleatoria
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     */  
    public function testAvaliadorDeveEncontrarOMaiorValorDeLances(Leilao $leilao)
    {
        // Arrange - Given / Preparamos o cenário do teste
        //$this->criaAvaliador();

        // Act - When / Executamos o código a ser testado
        $this->leiloeiro->avalia($leilao);

        $maiorValor = $this->leiloeiro->getMaiorValor();

        // Assert - Then / Verificamos se a saída é a esperada
        self::assertEquals(2500, $maiorValor);

    }
    public function testLeilaoVazioNaoPodeSerAvaliador()
    {
        // try {
            $this->expectException(\DomainException::class);
            $this->expectExceptionMessage('Error Lances Vazios');

            $leilao=new Leilao('Fusca normal');
            $this->leiloeiro->avalia($leilao); 

        //     static::fail('Deveira ter um lance');
        // } catch (\DomainException $exception) {
        //     static::assertEquals('Nao pode ser avalidado',$exception->getMessage());
        // }
    }

    /**
     * @dataProvider leilaoEmOrdemAleatoria
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     */  
    public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemCrescente(Leilao $leilao)
    {
        // Arrange - Given
        // $leilao = new Leilao('Fiat 147 0KM');

        // $maria = new Usuario('Maria');
        // $joao = new Usuario('João');

        // $leilao->recebeLance(new Lance($joao, 2000));
        // $leilao->recebeLance(new Lance($maria, 2500));

        // $leilao=$this->leilaoEmOrdemDecrescente();
        
        //$this->criaAvaliador();

        // Act - When
        $this->leiloeiro->avalia($leilao);

        $maiorValor = $this->leiloeiro->getMaiorValor();

        // Assert - Then
        self::assertEquals(2500, $maiorValor);
    }
    /**
     * @dataProvider leilaoEmOrdemAleatoria
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     */  
    public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemDecrescente(Leilao $leilao)
    {
        // Arrange - Given
        // $leilao = new Leilao('Fiat 147 0KM');

        // $maria = new Usuario('Maria');
        // $joao = new Usuario('João');

        // $leilao->recebeLance(new Lance($maria, 2500));
        // $leilao->recebeLance(new Lance($joao, 2000));

        // $leilao = $this->leilaoEmOrdemDecrescente();

        //$this->criaAvaliador();

        // Act - When
        $this->leiloeiro->avalia($leilao);

        $maiorValor = $this->leiloeiro->getMaiorValor();

        // Assert - Then
        self::assertEquals(2500, $maiorValor);
    }
    /**
     * @dataProvider leilaoEmOrdemAleatoria
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     */  
    public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemDecrescente(Leilao $leilao)
    {
        // Arrange - Given
        // $leilao = new Leilao('Fiat 147 0KM');

        // $maria = new Usuario('Maria');
        // $joao = new Usuario('João');

        // $leilao->recebeLance(new Lance($maria, 2500));
        // $leilao->recebeLance(new Lance($joao, 2000));

        // $leilao = $this->leilaoEmOrdemCrescente();

        //$this->criaAvaliador();

        // Act - When
        $this->leiloeiro->avalia($leilao);

        $menorValor = $this->leiloeiro->getMenorValor();

        // Assert - Then
        self::assertEquals(1700, $menorValor);
    }
    /**
     * @dataProvider leilaoEmOrdemAleatoria
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     */  
    public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemCrescente(Leilao $leilao)
    {
        // Arrange - Given
        // $leilao = new Leilao('Fiat 147 0KM');

        // $maria = new Usuario('Maria');
        // $joao = new Usuario('João');

        // $leilao->recebeLance(new Lance($joao, 2000));
        // $leilao->recebeLance(new Lance($maria, 2500));
        
        // $leilao = $this->leilaoEmOrdemDecrescente();

        //$this->criaAvaliador();

        // Act - When
        $this->leiloeiro->avalia($leilao);

        $menorValor = $this->leiloeiro->getMenorValor();

        // Assert - Then
        self::assertEquals(1700, $menorValor);
    }
    /**
     * @dataProvider leilaoEmOrdemAleatoria
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     */  
    public function testAvaliadorDeveBuscar3MaioresValores(Leilao $leilao)
    {
        // $leilao = new Leilao('Fiat 147 0KM');
        // $joao = new Usuario('João');
        // $maria = new Usuario('Maria');
        // $ana = new Usuario('Ana');
        // $jorge = new Usuario('Jorge');

        // $leilao->recebeLance(new Lance($ana, 1500));
        // $leilao->recebeLance(new Lance($joao, 1000));
        // $leilao->recebeLance(new Lance($maria, 2000));
        // $leilao->recebeLance(new Lance($jorge, 1700));

        //$this->criaAvaliador();
        $this->leiloeiro->avalia($leilao);

        $maiores = $this->leiloeiro->getMaioresLances();
        static::assertCount(3, $maiores);
        static::assertEquals(2500, $maiores[0]->getValor());
        static::assertEquals(2000, $maiores[1]->getValor());
        static::assertEquals(1700, $maiores[2]->getValor());
    }

    public function testLeilaoFinalizadoNaoPodeSerAvaliado()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Leilao Finalizado');
        $leilao = new Leilao('Fiat 147 0km');
        $leilao->recebeLance(new Lance(new Usuario('Teste'),2000));
        $leilao->finaliza();

        $this->leiloeiro->avalia($leilao);
    }

    public function leilaoEmOrdemCrescente()
    {
        echo "Criando em ordem crescente" . PHP_EOL;
        $leilao = new Leilao('Fiat 147 0km');
    
        $maria = new Usuario('Maria');
        $joao = new Usuario('Joao');
        $ana = new Usuario('Ana');
    
        $leilao->recebeLance(new Lance($ana, 1700));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));

        // return $leilao;
        return [
            'ordem-crescente'=>[$leilao]
        ];
    }
    
    public function leilaoEmOrdemDecrescente()
    {
        echo "Criando em ordem decrescente" . PHP_EOL;
        $leilao = new Leilao('Fiat 147 0km');
    
        $maria = new Usuario('Maria');
        $joao = new Usuario('Joao');
        $ana = new Usuario('Ana');
    
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($ana, 1700));
    
    
        // return $leilao;
        return [
            'ordem-decrescente'=>[$leilao]
        ];
    }

    public function leilaoEmOrdemAleatoria()
    {
        echo "Criando em ordem aleatoria" . PHP_EOL;
        $leilao = new Leilao('Fiat 147 0km');
    
        $maria = new Usuario('Maria');
        $joao = new Usuario('Joao');
        $ana = new Usuario('Ana');
    
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($ana, 1700));

//        return $leilao;
        return [
            'ordem-aleatoria'=>[$leilao]
        ];
    }

    public function entregaLeiloes()
    {
        return [
            [$this->leilaoEmOrdemCrescente()],
            [$this->leilaoEmOrdemDecrescente()],
            [$this->leilaoEmOrdemAleatoria()],
            ];
    
    }

}