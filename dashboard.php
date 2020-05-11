<?php
require_once "config-application.php";


//Layout
$pageSite = (object)NULL;


//Variáveis.
$palavraChave = isset($_GET["palavraChave"]) == true ? $_GET["palavraChave"] : "";

//Criação de objetos.
$oclCadastro = new ObjCadastroListagem(array());
$resultadoCadastroListagem = NULL;


//Pesquisar registros.
$oclCadastro->cadastroListagemLer();

$resultadoCadastroListagem = $oclCadastro->resultadoCadastroListagem;


//Debug.
//echo "ocdCadastro=<pre>";
//var_dump($ocdCadastro);
//echo "</pre><br />";
?>

<?php ob_start(); /* cphTitle*/ ?>
	Dashboard
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>

<?php ob_start(); /* cphTitle*/ ?>
	<div class="div-detalhes" style="margin-bottom: 10px;">
		Olá,
		<br />
		bem-vindo ao dashboard.
	</div>
	
	<div>
		<div class="panel panel-default" style="width: 49%; display: inline-block; float: left;">
			<div class="panel-heading">Total de Cadastros</div>
			<div class="panel-body">
			<?php echo count($resultadoCadastroListagem); ?>
			</div>
		</div>
		
		<div class="panel panel-default" style="width: 49%; display: inline-block; float: right;">
			<div class="panel-heading">Cadastros Hoje</div>
			<div class="panel-body">
			<?php echo count($resultadoCadastroListagem); ?>
			</div>
		</div>
	</div>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>

<?php ob_start(); /* cphConteudo*/ ?>

<?php 
$pageSite->cphConteudo = ob_get_clean(); 
//ob_end_flush();
?>


<?php
//Inclusão do template do layout.
include_once "layout.php";

unset($oclCadastro);

$dbSystemConPDO = null;
?>