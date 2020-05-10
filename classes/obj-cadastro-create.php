<?php
class ObjCadastroCreate
{
	//Propriedades.
	//----------------------
	public $nome = "";
	public $cpfCnpj = "";
	public $dataNascimento = "";
	public $endereco = "";
	public $descricaoTitulo = "";
	public $valor = "";
	public $dataVencimento = "";
	
	public $statusGravacao = false;
	//----------------------
	
	
	//Construtor.
	//**************************************************************************************
	public function __construct($nome, 
	$cpfCnpj, 
	$dataNascimento, 
	$endereco, 
	$descricaoTitulo, 
	$valor, 
	$dataVencimento)
	{
		$this->nome = $nome;
		$this->cpfCnpj = $cpfCnpj;
		$this->dataNascimento = $dataNascimento;
		$this->endereco = $endereco;
		$this->descricaoTitulo = $descricaoTitulo;
		$this->valor = $valor;
		$this->dataVencimento = $dataVencimento;
	}
	//**************************************************************************************
	
	
	//Função para gravar no banco de dados.
	//**************************************************************************************
    public function cadastroGravar()
    {
		if(FuncoesEstaticas::inserirCadastro($this->nome, 
		$this->cpfCnpj, 
		$this->dataNascimento, 
		$this->endereco, 
		$this->descricaoTitulo, 
		$this->valor, 
		$this->dataVencimento) == true)
		{
			$this->statusGravacao = true;
		}
	}
	//**************************************************************************************
}