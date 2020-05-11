<?php
require_once "config-application.php";


//Layout
$pageSite = (object)NULL;


//Variáveis.
$palavraChave = isset($_GET["palavraChave"]) == true ? $_GET["palavraChave"] : "";
$id = isset($_GET["id"]) == true ? $_GET["id"] : "";


//Criação de objetos.
$ocdCadastro = new ObjCadastroDetalhes($id);
$ocdCadastro->cadastroDetalhesLer();


//Debug.
//echo "ocdCadastro=<pre>";
//var_dump($ocdCadastro);
//echo "</pre><br />";
?>

<?php ob_start(); /* cphTitle*/ ?>
	Detalhes do Cadastro
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>

<?php ob_start(); /* cphTitle*/ ?>
	<div class="div-detalhes">
		<div class="div-detalhes-fileira">
			<strong>
				Nome: 
			</strong>
			<?php echo $ocdCadastro->nome; ?>
		</div>
		<div class="div-detalhes-fileira">
			<strong>
				CPF / CNPJ: 
			</strong>
			<?php echo $ocdCadastro->cpfCnpj; ?>
		</div>
		<div class="div-detalhes-fileira">
			<strong>
				Data de Nascimento: 
			</strong>
			<?php echo $ocdCadastro->dataNascimento; ?>
		</div>
		<div class="div-detalhes-fileira">
			<strong>
				Endereço: 
			</strong>
			<?php echo $ocdCadastro->endereco; ?>
		</div>
		<div class="div-detalhes-fileira">
			<strong>
				Descrição do Título: 
			</strong>
			<br />
			<?php echo $ocdCadastro->descricaoTitulo; ?>
		</div>
		<div class="div-detalhes-fileira">
			<strong>
				Valor: 
			</strong>
			R$ <?php echo $ocdCadastro->valor; ?>
		</div>
		<div class="div-detalhes-fileira">
			<strong>
				Data de Vencimento: 
			</strong>
			<?php echo $ocdCadastro->dataVencimento; ?>
		</div>
	</div>
	
	<div style="text-align: center; margin: 10px 0px 10px 0px;">
		<a href="cadastro-listagem.php" role="button" class="btn btn-primary">
			Voltar
		</a>
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

unset($ocdCadastro);

$dbSystemConPDO = null;
?>