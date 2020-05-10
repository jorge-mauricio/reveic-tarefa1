<?php
ini_set('display_errors', 1);
date_default_timezone_set('America/Sao_Paulo');
require_once "config-application-db.php";
require_once "classes/funcoes-estaticas.php";
require_once "classes/obj-cadastro-create.php";


//Variáveis.
$_method = $_POST["_method"];

$configUrl = "https://www.jorgemauricio.com/clientes/receiv";
$paginaRetorno = "cadastro-listagem.php";
$mensagemSucesso = 0;
$mensagemErro = 0;



//Create.
if($_method == "CREATE")
{
	$nome = $_POST["nome"];
	$cpfCnpj = FuncoesEstaticas::somenteNum($_POST["cpf_cnpj"]);
	$dataNascimento = $_POST["data_nascimento"];
	$endereco = $_POST["endereco"];
	$descricaoTitulo = $_POST["descricao_titulo"];
	$valor = FuncoesEstaticas::valorGravar($_POST["valor"]);
	$dataVencimento = $_POST["data_vencimento"];
	//$updated = $_POST["updated"];
	
	if($valor == "")
	{
		$valor = 0;	
	}
	
	
	//Criação de objetos.
	$occCadastro = new ObjCadastroCreate($nome, 
	$cpfCnpj, 
	$dataNascimento, 
	$endereco, 
	$descricaoTitulo, 
	$valor, 
	$dataVencimento);
	
	//Gravação.
	$occCadastro->cadastroGravar();
	
	//Verificação.
	if($occCadastro->statusGravacao == true)
	{
		$mensagemSucesso = 1;
	}else{
		$mensagemErro = 1;
	}
	
	
	//Debug.
	//echo "CREATE=true<br />"; //debug.
	//echo "occCadastro=<pre>";
	//var_dump($occCadastro);
	//echo "</pre><br />";
}


//Delete.
if($_method == "DELETE")
{
	$arrIdsRegistrosExcluir = $_POST["idsRegistrosExcluir"];
	$countRegistrosExcluidos = 0;
	
	if(!empty($arrIdsRegistrosExcluir))
	{
		foreach($arrIdsRegistrosExcluir as $idRegistro)
		{
			
			if(FuncoesEstaticas::excluirRegistros($idRegistro, "tb_cadastro", "id"))
			{
				$countRegistrosExcluidos = $countRegistrosExcluidos + 1;
				$mensagemSucesso = 2;
			}else{

			}
			
			//Debug.			
			//echo "idRegistro=" . $idRegistro . "<br />";
		}
	}
}


//Debug.
/*
echo "nome=" . $nome . "<br />";
echo "cpfCnpj=" . $cpfCnpj . "<br />";
echo "dataNascimento=" . $dataNascimento . "<br />";
echo "endereco=" . $endereco . "<br />";
echo "descricaoTitulo=" . $descricaoTitulo . "<br />";
echo "valor=" . $valor . "<br />";
echo "dataVencimento=" . $dataVencimento . "<br />";
//echo "updated=" . $updated . "<br />";
echo "_method=" . $_method . "<br />";
*/


$dbSistemaConPDO = null;


$URLRetorno = $configUrl . "/" . $paginaRetorno . "?" .
"mensagemSucesso=" . $mensagemSucesso .
"&mensagemErro=" . $mensagemErro;

//exit();
header("Location: " . $URLRetorno);
die();
?>
