<?php
class ObjCadastroUpdate
{
	//Propriedades.
	//----------------------
	public $id = "";
	public $nome = "";
	public $cpfCnpj = "";
	public $dataNascimento = "";
	public $endereco = "";
	public $descricaoTitulo = "";
	public $valor = "";
	public $dataVencimento = "";
	public $updated;
	
	public $statusUpdate = false;
	//----------------------
	
	
	//Construtor.
	//**************************************************************************************
	public function __construct($id, 
	$nome, 
	$cpfCnpj, 
	$dataNascimento, 
	$endereco, 
	$descricaoTitulo, 
	$valor, 
	$dataVencimento)
	{
		$this->id = $id;
		$this->nome = $nome;
		$this->cpfCnpj = $cpfCnpj;
		$this->dataNascimento = $dataNascimento;
		$this->endereco = $endereco;
		$this->descricaoTitulo = $descricaoTitulo;
		$this->valor = $valor;
		$this->dataVencimento = $dataVencimento;
	}
	//**************************************************************************************
	
	
	//Função para buscar detalhes.
	//**************************************************************************************
    public function cadastroUpdate()
    {
		$this->updated = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		
		
		//Update de registro no BD.
		//----------
		$strSqlCadastroUpdate = "";
		$strSqlCadastroUpdate .= "UPDATE tb_cadastro ";
		$strSqlCadastroUpdate .= "SET ";
		//$strSqlCadastroUpdate .= "id = :id, ";
		$strSqlCadastroUpdate .= "nome = :nome, ";
		$strSqlCadastroUpdate .= "cpf_cnpj = :cpf_cnpj, ";
		$strSqlCadastroUpdate .= "data_nascimento = :data_nascimento, ";
		$strSqlCadastroUpdate .= "endereco = :endereco, ";
		$strSqlCadastroUpdate .= "descricao_titulo = :descricao_titulo, ";
		$strSqlCadastroUpdate .= "valor = :valor, ";
		$strSqlCadastroUpdate .= "data_vencimento = :data_vencimento, ";
		$strSqlCadastroUpdate .= "updated = :updated ";
		
		$strSqlCadastroUpdate .= "WHERE id = :id ";
		//echo "strSqlCategoriasUpdate = " . $strSqlCadastroUpdate . "<br />";
		//----------
		
		
		//Parâmetros.
		//----------
		$statementCadastroUpdate = $GLOBALS['dbSystemConPDO']->prepare($strSqlCadastroUpdate);
		
		if($statementCadastroUpdate !== false)
		{
			$statementCadastroUpdate->execute(array(
				"id" => $this->id,
				"nome" => $this->nome,
				"cpf_cnpj" => $this->cpfCnpj,		
				"data_nascimento" => $this->dataNascimento,
				"endereco" => $this->endereco,
				"descricao_titulo" => $this->descricaoTitulo,
				"valor" => $this->valor,
				"data_vencimento" => $this->dataVencimento,
				"updated" => $this->updated
			));
			
			$this->statusUpdate = true;
		}else{
			$this->statusUpdate = false;
		}
		//----------


		//Limpeza de objetos.
		//----------
		unset($strSqlCadastroUpdate);
		unset($statementCadastroUpdate);
		//----------
	}
	//**************************************************************************************
}
?>