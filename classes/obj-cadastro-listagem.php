<?php
class ObjCadastroListagem
{
	//Propriedades.
	//----------------------
	public $arrParametros = NULL;
	public $resultadoCadastroListagem = NULL;
	//----------------------
	
	//Construtor.
	//**************************************************************************************
	public function __construct($arrParametros)
	{
		$this->arrParametros = $arrParametros;
	}
	//**************************************************************************************
	
	
	//Função para buscar listagem.
	//**************************************************************************************
    public function cadastroListagemLer()
    {
		$this->resultadoCadastroListagem = FuncoesEstaticas::tabelaPesquisar("tb_cadastro", 
																			$this->arrParametros, 
																			"nome", 
																			"");
																			
																			
	}
	//**************************************************************************************
}

?>