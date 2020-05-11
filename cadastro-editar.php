<?php
ini_set('display_errors', 1);
require_once "config-application-db.php";
require_once "classes/funcoes-estaticas.php";
require_once "classes/obj-cadastro-detalhes.php";


//Layout
//$pageSite = new \stdClass();
//$pageSite = new stdClass();
$pageSite = (object)NULL;

//$pageSite->cphTituloLinkAtual = "";
//$pageSite->cphConteudoPrincipal = "";

//Variáveis.
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
	Editar Cadastro
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>

<?php ob_start(); /* cphTitle*/ ?>
						<form name="formCadastro" id="formCadastro" action="cadastro-acoes.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="_method" value="UPDATE" />
							<input type="hidden" name="id" value="<?php echo $ocdCadastro->id; ?>" />
							
							<div class="div-campos">
								<input type="text" class="form-control" id="nome" name="nome" maxlength="255" required placeholder="Nome" value="<?php echo $ocdCadastro->nome; ?>" />
							</div>
							<div class="div-campos">
								<input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" required placeholder="CPF / CNPJ" maxlength="17" style="width: 50%; float: left;" value="<?php echo $ocdCadastro->cpfCnpj; ?>" />
									<script type="text/javascript">
										$("#cpf_cnpj").on("keyup", function(){
											var campoConteudoStrip = document.getElementById("cpf_cnpj").value.replace(/[^\d]/g, "");
											var contadorCaracteres = campoConteudoStrip.length;
											
											
											elementoOcultar("btoSubmit");
											elementoMostrar("divCPFAlerta");
											if(contadorCaracteres > 11 && contadorCaracteres < 14)
											{
												elementoOcultar("btoSubmit");
												elementoMostrar("divCPFAlerta");
											}else{
												if(contadorCaracteres == 11 || contadorCaracteres == 14)
												{
													elementoMostrar("btoSubmit");
													elementoOcultar("divCPFAlerta");
												}
												
												document.getElementById("cpf_cnpj").value = formatCnpjCpf(campoConteudoStrip);
											}
											//document.getElementById("nome").value = contadorCaracteres; //debug
										});
									</script>
								<input type="date" onfocus="(this.type='date')" class="form-control" id="data_nascimento" name="data_nascimento" required placeholder="Data de Nasc." max="2020-05-10" style="width: 50%; float: right;" value="<?php echo $ocdCadastro->dataNascimentoEditar; ?>" />
							</div>
							<div class="div-campos">
								<input type="text" class="form-control" id="endereco" name="endereco" maxlength="1000" required placeholder="Endereço" value="<?php echo $ocdCadastro->endereco; ?>" />
							</div>
							<div class="div-campos">
								<textarea class="form-control" id="descricao_titulo" name="descricao_titulo" rows="4" required placeholder="Descrição" style="resize: none;"><?php echo $ocdCadastro->descricaoTitulo; ?></textarea>
							</div>
							<div class="div-campos">
								<div class="input-group" style="width: 50%; float: left;">
									<div class="input-group-addon">R$</div>
									<input type="text" class="form-control" id="valor" name="valor" required placeholder="Valor" style="text-align: right;" value="<?php echo $ocdCadastro->valor; ?>" />
									<script type="text/javascript">
										$("#valor").maskMoney({allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
									</script>
								</div>
								<input type="date" class="form-control" id="data_vencimento" name="data_vencimento" required placeholder="Data de Vencimento" min="2020-05-10" style="width: 50%; float: right;" value="<?php echo $ocdCadastro->dataVencimentoEditar; ?>" />
							</div>
							<div class="div-campos" style="text-align: center;">
								<button id="btoSubmit" type="submit" class="btn btn-success" style="width: 100px; margin: auto; float: left;">
									Update
								</button>
								
								<button onclick="javascript:history.go(-1);" class="btn btn-alert" style="width: 100px; margin: auto; float: right;">
									Voltar
								</button>
							</div>
							<div id="divCPFAlerta" class="alert alert-warning" style="display: none;">
							  CPF / CNPJ incompleto.
							</div>
						</form>
						<script>
							$("#data_nascimento, #data_vencimento").focus(function(){
								//this.type='date'
							}).blur(function(){
								//this.type='text'
							});
							
							$("#valor").focus(function(){
								//this.value='0'
							}).blur(function(){
								//this.value=''
							});
						</script>
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

$dbSystemConPDO = null;
?>