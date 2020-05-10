<?php
ini_set('display_errors', 1);
require_once "config-application-db.php";

//Layout
//$pageSite = new \stdClass();
//$pageSite = new stdClass();
$pageSite = (object)NULL;

//$pageSite->cphTituloLinkAtual = "";
//$pageSite->cphConteudoPrincipal = "";
?>

<?php ob_start(); /* cphTitle*/ ?>
	Teste de titulo
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>

<?php ob_start(); /* cphTitle*/ ?>
	no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no
	no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no
	no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no
	no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no no
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>

<?php
//Inclusão do template do layout.
include_once "layout.php";

$dbSystemConPDO = null;
?>