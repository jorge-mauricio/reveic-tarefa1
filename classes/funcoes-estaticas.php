<?php
class FuncoesEstaticas
{
	//Retirar caractéres numéricos.
	//**************************************************************************************
	function somenteNum($strNumero)
	{
		//$strRetorno = "";
		$strRetorno = preg_replace("/\D+/", "", $strNumero);
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Formatar número para gravação.
	//**************************************************************************************
	function valorGravar($valor)
	{
		$valor = str_replace(".", "", $valor);
		$valor = str_replace(",", ".", $valor);
		
		return $valor;
	}
	//**************************************************************************************
	
	
    //Função de inclusão de cadastro.
    //**************************************************************************************
    function inserirCadastro($_nome, 
	$_cpfCnpj, 
	$_dataNascimento, 
	$_endereco, 
	$_descricaoTitulo, 
	$_valor, 
	$_dataVencimento)
	{
		
		//Variáveis.
		//----------
		$strRetorno = false;
		$updated = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
		//$updated = date();
		
		
		$strSqlCadastroInsert = "";
		//----------
		
		
		//Montagem do query.
		//----------
		$strSqlCadastroInsert .= "INSERT INTO tb_cadastro ";
		$strSqlCadastroInsert .= "SET ";
		//$strSqlCadastroInsert .= "id = :id, ";
		$strSqlCadastroInsert .= "nome = :nome, ";
		$strSqlCadastroInsert .= "cpf_cnpj = :cpf_cnpj, ";
		$strSqlCadastroInsert .= "data_nascimento = :data_nascimento, ";
		$strSqlCadastroInsert .= "endereco = :endereco, ";
		$strSqlCadastroInsert .= "descricao_titulo = :descricao_titulo, ";
		$strSqlCadastroInsert .= "valor = :valor, ";
		$strSqlCadastroInsert .= "data_vencimento = :data_vencimento, ";
		$strSqlCadastroInsert .= "updated = :updated";
		//$strSqlCadastroInsert .= "updated = NOW()";
		//----------
		

		//Parâmetros.
		//----------
		$statementCadastroInsert = $GLOBALS['dbSystemConPDO']->prepare($strSqlCadastroInsert);
		
		if($statementCadastroInsert !== false)
		{
			$statementCadastroInsert->execute(array(
				//"id" => $tbCategoriasId,
				"nome" => $_nome,
				"cpf_cnpj" => $_cpfCnpj,
				"data_nascimento" => $_dataNascimento,
				"endereco" => $_endereco,
				"descricao_titulo" => $_descricaoTitulo,
				"valor" => $_valor,
				"data_vencimento" => $_dataVencimento,
				"updated" => $updated
			));
			

			//$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			$strRetorno = true;
		}else{
			//echo "erro";
			//$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		//----------
		
		
		//Limpeza de objetos.
		//----------
		unset($strSqlCadastroInsert);
		unset($statementCadastroInsert);
		//----------


		return $strRetorno;
	}
    //**************************************************************************************
}

?>