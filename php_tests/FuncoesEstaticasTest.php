<?php
require_once "./config-application.php";


class FuncoesEstaticasTest extends \PHPUnit_Framework_TestCase
{
    //Configurações especiais para início dos testes.
    public function setUp()
    {
        //var_dump("test set up function"); //debug

    }


    //somenteNum
    public function test_somenteNum_dados()
    {
        $dadosTesteInt = 1252.52;
        $dadosTesteString = "212,212,212,122.52";
        $dadosTesteStringAlpha = "212qwe212,212,122.52";
        $dadosTesteVazio = "";

        $this->assertEquals(FuncoesEstaticas::somenteNum($dadosTesteInt), "125252");
        $this->assertEquals(FuncoesEstaticas::somenteNum($dadosTesteString), "21221221212252");
        $this->assertEquals(FuncoesEstaticas::somenteNum($dadosTesteStringAlpha), "21221221212252");
        $this->assertEquals(FuncoesEstaticas::somenteNum($dadosTesteVazio), "");
    }


    //valorGravar
    public function test_valorGravar_dados()
    {
        $dadosTesteString = "212.212.212.122,52";
        $dadosTesteVazio = "";

        $this->assertEquals(FuncoesEstaticas::valorGravar($dadosTesteString), "212212212122.52");
        $this->assertEquals(FuncoesEstaticas::valorGravar($dadosTesteVazio), "");
    }


    //formatarValorGenericoLer
    public function test_formatarValorGenericoLer_dados()
    {
        $dadosTesteStringCPF = "07888889969";
        $dadosTesteStringCNPJ = "12345678912345";
        $dadosTesteVazio = "";

        $this->assertEquals(FuncoesEstaticas::formatarValorGenericoLer($dadosTesteStringCPF), "078.888.899-69");
        $this->assertEquals(FuncoesEstaticas::formatarValorGenericoLer($dadosTesteStringCNPJ), "12.345.678/9123-45");
        $this->assertEquals(FuncoesEstaticas::formatarValorGenericoLer($dadosTesteVazio), "");

    }


    //mascaraValorLer
    public function test_mascaraValorLer_dados()
    {
        $dadosTesteString = "212212212122.52";
        $dadosTesteVazio = "";

        $this->assertEquals(FuncoesEstaticas::mascaraValorLer($dadosTesteString), "212.212.212.122,52");
        $this->assertEquals(FuncoesEstaticas::mascaraValorLer($dadosTesteVazio), "");
    }


    //dataLeitura
    public function test_dataLeitura_dados()
    {
        $dadosTestePT = "2020-05-30";
        $dadosTesteEN = "2020-05-30";
        $dadosTesteVazio = "";

        $this->assertEquals(FuncoesEstaticas::dataLeitura($dadosTestePT, 1, 1), "30/05/2020");
        $this->assertEquals(FuncoesEstaticas::dataLeitura($dadosTesteEN, 2, 1), "05/30/2020");
        $this->assertEquals(FuncoesEstaticas::dataLeitura($dadosTesteVazio, 1, 1), "");
    }

}

?>