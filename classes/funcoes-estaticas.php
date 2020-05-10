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
	
	
    //Função para retornar valores formatados.
	//**************************************************************************************
	function formatarValorGenericoLer($strDados, $tipoDados = "")
	{
		//tipoDados: cpf | cnpj | cep
		$strRetorno = "";
		$strDadosLength = $strDados;
		
		if($strDados <> "")
		{
			//CPF
			if(strlen($strDadosLength) == 11)
			{
				$strRetorno	= substr($strDados , 0, 3) . "." . substr($strDados , 3, 3) . "." . substr($strDados , 6, 3) . "-" . substr($strDados , 9, 2);
			}
			
			//CNPJ
			if(strlen($strDadosLength) == 14)
			{
				$strRetorno	= substr($strDados , 0, 2) . "." . substr($strDados , 2, 3) . "." . substr($strDados , 5, 3) . "/" . substr($strDados , 8, 4) . "-" . substr($strDados , 12, 2);
			}
			
		}
		
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Função leitura de valores.
	//**************************************************************************************
	function mascaraValorLer($strValor, $configMoeda = "R$")
	{
		//configMoeda: pagseguro | paypal | boleto
		//Obs: mudar configMoeda para formatacaoEspecial
		
		//Vari�veis.
		//----------
		$strRetorno = "";
		$strValor = strval($strValor); //Conversão para string.
		$strValor = str_replace(".", "", $strValor);
		//----------

		
		if($strValor <> "")
		{
			if(strlen($strValor) < 3)
			{
				$strValor = "00" . $strValor;
			}
			
			$strDecimal = substr($strValor, (strlen($strValor) - 2), strlen($strValor));
			$strValor = substr($strValor, 0, strlen($strValor) - 2) . "." . $strDecimal;
			
			//R$ (Real)
			if($configMoeda == "R$")
			{
				$strRetorno = number_format($strValor, 2, ',', '.');
			}
			
	
		}
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
	//Fun��o para formatar data.
	//**************************************************************************************
	function dataLeitura($strData, $strFormatoData, $strFormatoRetorno)
	{
		//$strFormatoRetorno: 1 - (dd/mm/aaaa | mm/dd/aaaa) | 2 - (dd/mm/aaaa hh:mm:ss | mm/dd/aaaa hh:mm:ss) | 3 - aaaa-mm-dd hh:mm:ss | 10 - (aaaa-mm-dd) | 11 - aaaa-mm-ddThh:mm:ss | 22 - hh:mm:ss | 101 - data por extenso (dia da semana, dia de m�s de ano)
		//$strFormatoData: configSistemaFormatoData | configSiteFormatoData | sigla pa�s (br)
		
		//Vari�veis.
		//----------------------
		$strReturn = "";
		//----------------------
		
		
		if($strData <> NULL)
		{
			if($strFormatoRetorno == "1")
			{
				if($strFormatoData == 1)
				{
					$strReturn = date("d",strtotime($strData)) . "/" . date("m",strtotime($strData)) . "/" . date("Y",strtotime($strData));
				}
				if($strFormatoData == 2)
				{
					$strReturn = date("m",strtotime($strData)) . "/" . date("d",strtotime($strData)) . "/" . date("Y",strtotime($strData));
				}
			}
			
			if($strFormatoRetorno == "2")
			{
				if($strFormatoData == 1)
				{
					$strReturn = date("d",strtotime($strData)) . "/" . date("m",strtotime($strData)) . "/" . date("Y",strtotime($strData)) . " " . date("H",strtotime($strData)) . ":" . date("i",strtotime($strData)) . ":" . date("s",strtotime($strData));
				}
				if($strFormatoData == 2)
				{
					$strReturn = date("m",strtotime($strData)) . "/" . date("d",strtotime($strData)) . "/" . date("Y",strtotime($strData)) . " " . date("H",strtotime($strData)) . ":" . date("i",strtotime($strData)) . ":" . date("s",strtotime($strData));
				}
			}
			
			if($strFormatoRetorno == "3")
			{
				$strReturn = date("Y",strtotime($strData)) . "-" . date("m",strtotime($strData)) . "-" . date("d",strtotime($strData)) . " " . date("H",strtotime($strData)) . ":" . date("i",strtotime($strData)) . ":" . date("s",strtotime($strData));
			}
			
			if($strFormatoRetorno == "10")
			{
				$strReturn = date("Y",strtotime($strData)) . "-" . date("m",strtotime($strData)) . "-" . date("d",strtotime($strData));
			}
			
			if($strFormatoRetorno == "11")
			{
				$strReturn = date("Y",strtotime($strData)) . "-" . date("m",strtotime($strData)) . "-" . date("d",strtotime($strData)) . "T" . date("H",strtotime($strData)) . ":" . date("i",strtotime($strData)) . ":" . date("s",strtotime($strData));
			}
			
			if($strFormatoRetorno == "22")
			{
				$strReturn = date("H",strtotime($strData)) . ":" . date("i",strtotime($strData)) . ":" . date("s",strtotime($strData));
			}
			
			//101 - data por extenso.
			if($strFormatoRetorno == "101")
			{
				$strReturn = Funcoes::ConteudoMascaraLeitura(Funcoes::DataTraducao(date("l",strtotime($strData)), "s", "pt-br"), "IncludeConfig") . ", " . date("j",strtotime($strData)) . " de " .  Funcoes::ConteudoMascaraLeitura(Funcoes::DataTraducao(date("F",strtotime($strData)), "m", "pt-br"), "IncludeConfig") . " de " . date("Y",strtotime($strData));
			}
		}
		
		return $strReturn;
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
			

			$strRetorno = true;
		}else{
			//echo "erro";
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
	
	
	//Função para preencher tabela (FetchAll).
	//**************************************************************************************
	function tabelaPesquisar($strTabela, 
	$arrParametrosPesquisa, 
	$strClassificacao = "", 
	$strNRegistros = "")
	{
        //arrParametrosPesquisa: array("nomeCampoPesquisa1;valorCampoPesquisa1;tipoCampoPesquisa1", "nomeCampoPesquisa2;valorCampoPesquisa2;tipoCampoPesquisa2", "nomeCampoPesquisa3;valorCampoPesquisa3;tipoCampoPesquisa3")
        //ex: New String() {"id_tb_cadastro_cliente;31358;s", "tipo_movimento;0;s", "data_movimento;2018-01-22,2018-01-24;dif"}
        //tipoCampoPesquisa: s (string) | i (integer) | d (data) | dif (data inicial e data final) | ids (id IN)
        //dif (data inicial e data final) (data): dataInicial,dataFinal
        
		
		//Variáveis.
        //----------
		$strReturn = "";
		$strOperador = "";
        //----------


        //Query de pesquisa.
        //----------
        $strSqlTabelaGenericaSelect = "";
        $strSqlTabelaGenericaSelect .= "SELECT ";
        $strSqlTabelaGenericaSelect .= "* FROM " . $strTabela . " ";
        //$strSqlTabelaGenericaSelect .= "WHERE id <> 0 ";
		
		//Loop.
		for($countArray = 0; $countArray < count($arrParametrosPesquisa); ++$countArray)
		{
            $arrParametrosPesquisaInfo = explode(";", $arrParametrosPesquisa[$countArray]);
			
            $parametrosPesquisaNomeCampo = $arrParametrosPesquisaInfo[0];
            $parametrosPesquisaValorCampo = $arrParametrosPesquisaInfo[1];
            $parametrosPesquisaTipoCampo = $arrParametrosPesquisaInfo[2];
			
			
			//Definição de operador.
			if($countArray == 0)
			{
				$strOperador = "WHERE";
			}else{
				$strOperador = "AND";
			}
			
			
            //String.
			if($parametrosPesquisaTipoCampo == "s")
			{
                $strSqlTabelaGenericaSelect .= $strOperador . " " . $parametrosPesquisaNomeCampo . " = ? ";
			}
			
            //Integer.
			if($parametrosPesquisaTipoCampo == "i")
			{
                $strSqlTabelaGenericaSelect .= $strOperador . " " . $parametrosPesquisaNomeCampo . " = ? ";
			}
			
			//ids.
			if($parametrosPesquisaTipoCampo == "ids")
			{
				if($parametrosPesquisaValorCampo == "")
				{
					$parametrosPesquisaValorCampo = "0";
				}
                $strSqlTabelaGenericaSelect .= $strOperador . " " . $parametrosPesquisaNomeCampo . " IN (" . $parametrosPesquisaValorCampo . ") ";
			}
			
			
			//Verificação de erro - debug.
			//echo "parametrosPesquisaNomeCampo=" . $parametrosPesquisaNomeCampo . "<br>";
			//echo "parametrosPesquisaValorCampo=" . $parametrosPesquisaValorCampo . "<br>";
			//echo "parametrosPesquisaTipoCampo=" . $parametrosPesquisaTipoCampo . "<br>";
		} 
		
		
		if($strClassificacao <> "")
		{
			$strSqlTabelaGenericaSelect .= "ORDER BY " . $strClassificacao . " ";
		}
		//echo "strSqlTabelaGenericaSelect=" . $strSqlTabelaGenericaSelect . "<br>";
		//var_dump($arrParametrosPesquisa);
        //----------
		
		
		//Parâmetros.
        //----------
        //$statementTabelaGenericaSelect = $dbSistemaConPDO->prepare($strSqlTabelaGenericaSelect);
		$statementTabelaGenericaSelect = $GLOBALS['dbSystemConPDO']->prepare($strSqlTabelaGenericaSelect);

        if($statementTabelaGenericaSelect !== false)
        {
			//Loop.
			for($countArray = 0; $countArray < count($arrParametrosPesquisa); ++$countArray)
			{
				$arrParametrosPesquisaInfo = explode(";", $arrParametrosPesquisa[$countArray]);
				
				$parametrosPesquisaNomeCampo = $arrParametrosPesquisaInfo[0];
				$parametrosPesquisaValorCampo = $arrParametrosPesquisaInfo[1];
				$parametrosPesquisaTipoCampo = $arrParametrosPesquisaInfo[2];
				
				//String.
				if($parametrosPesquisaTipoCampo == "s")
				{
					//$statementTabelaGenericaSelect->bindParam(":" . $parametrosPesquisaNomeCampo, $parametrosPesquisaValorCampo, PDO::PARAM_STR);
					$statementTabelaGenericaSelect->bindValue(($countArray + 1), $parametrosPesquisaValorCampo, PDO::PARAM_STR);
				}
				//Integer.
				if($parametrosPesquisaTipoCampo == "i")
				{
					$statementTabelaGenericaSelect->bindValue(($countArray + 1), $parametrosPesquisaValorCampo, PDO::PARAM_INT);
				}
				
				
				//Verificação de erro - debug.
				//echo "parametrosPesquisaNomeCampo=" . $parametrosPesquisaNomeCampo . "<br>";
				//echo "parametrosPesquisaValorCampo=" . $parametrosPesquisaValorCampo . "<br>";
				//echo "parametrosPesquisaTipoCampo=" . $parametrosPesquisaTipoCampo . "<br>";
			} 
			
			//var_dump($statementTabelaGenericaSelect);
			$statementTabelaGenericaSelect->execute();

			/*
            $statementTabelaGenericaSelect->execute(array(
                "idRegistro" => $tipoComplemento
            ));
			*/
			
			
			//Verificação de erro - debug.
			//$statementTabelaGenericaSelect->debugDumpParams();
        }
        //----------


        $strRetorno = $statementTabelaGenericaSelect->fetchAll();
		
		
        //Limpeza de objetos.
        //----------
        unset($strSqlTabelaGenericaSelect);
        unset($statementTabelaGenericaSelect);
        //----------
		
		return $strRetorno;
	}
	//**************************************************************************************
	
	
    //Função para exclusão genérica de registros.
	//**************************************************************************************
	function excluirRegistros($idRegistro, $strTabela, $strNomeCampo)
	{
		$strRetorno = false;
		
		//Exclusão de registro no BD.
		//----------
		$strExcluirRegistrosGenerico = "";
		$strExcluirRegistrosGenerico .= "DELETE FROM " . $strTabela . " ";
		$strExcluirRegistrosGenerico .= "WHERE " . $strNomeCampo . " = :idRegistro";
		
		$statementExcluirRegistrosGenerico = $GLOBALS['dbSystemConPDO']->prepare($strExcluirRegistrosGenerico);
		
		if($statementExcluirRegistrosGenerico !== false)
		{
			$statementExcluirRegistrosGenerico->execute(array(
				"idRegistro" => $idRegistro
			));
			$strRetorno = true;
		}else{
		}
		//----------

		//Limpeza de objetos.
		//----------
		unset($strExcluirRegistrosGenerico);
		unset($statementExcluirRegistrosGenerico);
		//----------


		return $strRetorno;
	}
	//**************************************************************************************
}

?>