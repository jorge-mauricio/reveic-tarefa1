<?php
require_once "config-application.php";
/*
ini_set('display_errors', 1);
require_once "config-application-db.php";
require_once "classes/funcoes-estaticas.php";
require_once "classes/obj-cadastro-listagem.php";
*/

//Layout
//$pageSite = new \stdClass();
//$pageSite = new stdClass();
$pageSite = (object)NULL;

//$pageSite->cphTituloLinkAtual = "";
//$pageSite->cphConteudoPrincipal = "";


//Variáveis.
$palavraChave = isset($_GET["palavraChave"]) == true ? $_GET["palavraChave"] : "";

$mensagemSucesso = isset($_GET["mensagemSucesso"]) == true ? $_GET["mensagemSucesso"] : "";
$mensagemErro = isset($_GET["mensagemErro"]) == true ? $_GET["mensagemErro"] : "";


//Criação dos objetos.
$arrParametros = array();
if($palavraChave <> "")
{
	array_push($arrParametros, "nome;" . $palavraChave . ";like");
}

//$oclCadastro = new ObjCadastroListagem(array());
$oclCadastro = new ObjCadastroListagem($arrParametros);
$resultadoCadastroListagem = NULL;


//Pesquisar registros.
$oclCadastro->cadastroListagemLer();

$resultadoCadastroListagem = $oclCadastro->resultadoCadastroListagem;
/*
$resultadoCadastroListagem = FuncoesEstaticas::tabelaPesquisar("tb_cadastro", 
																array(), 
																"nome", 
																"");
*/																
//echo "resultadoCadastroListagem=<pre>";
//var_dump($resultadoCadastroListagem);
//echo "</pre><br />";

//echo "arrParametros=<pre>";
//var_dump($arrParametros);
//echo "</pre><br />";
?>

<?php ob_start(); /* cphTituloLinkAtual*/ ?>
	Listagem de Cadastro
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>

<?php ob_start(); /* cphConteudoPrincipal*/ ?>
	<?php if($mensagemSucesso == "1"){ ?>
		<div class="alert alert-success" style="text-align: center;">
			Cadastro criado com sucesso.
		</div>
	<?php } ?>
	<?php if($mensagemSucesso == "2"){ ?>
		<div class="alert alert-success" style="text-align: center;">
			Cadastro(s) excluídos com sucesso.
		</div>
	<?php } ?>
	<?php if($mensagemSucesso == "3"){ ?>
		<div class="alert alert-success" style="text-align: center;">
			Cadastro atualizado com sucesso.
		</div>
	<?php } ?>
	<?php if($mensagemErro == "1"){ ?>
		<div class="alert alert-success" style="text-align: center;">
			Erro com banco de dados.
		</div>
	<?php } ?>
	
	<?php if(empty($resultadoCadastroListagem)){ ?>
		<div class="alert alert-danger">
			Nenhum cadastro encontrado.
		</div>
	<?php }else{ ?>
		<form name="formCadastroAcoes" id="formCadastroAcoes" action="cadastro-acoes.php" method="post">
			<input type="hidden" name="_method" value="DELETE" />
			<table id="cadastroListagem" class="table table-bordered table-condensed table-responsive">
				<caption style="display: none;">Cadastros</caption>
				<thead class="tabela-cabecalho">
					<tr>
						<td>Cadastros</td>
						<td class="text-center" style="width: 30px;">Editar</td>
						<td class="text-center" style="width: 20px;">X</td>
					</tr>
				</thead>

				<tbody>
					<?php
					//Loop pelos resultados.
					foreach($resultadoCadastroListagem as $linhaCadastro){ ?>
					
					<tr class="tabela-fileira">
						<td>
							<div>
								<strong>
									Nome: 
								</strong>
								<a href="cadastro-detalhes.php?id=<?php echo $linhaCadastro['id'];?>" class="links">
									<?php echo $linhaCadastro['nome'];?>
								</a>
							</div>
							<div>
								<strong>
									CPF / CNPJ: 
								</strong>
								<?php echo FuncoesEstaticas::formatarValorGenericoLer($linhaCadastro['cpf_cnpj'], "");?>
							</div>
							<div>
								<strong>
									Data Nasc.: 
								</strong>
								<?php echo FuncoesEstaticas::dataLeitura($linhaCadastro['data_nascimento'], 1, 1);?>
							</div>
							<div>
								<strong>
									Valor: 
								</strong>
								R$ <?php echo FuncoesEstaticas::mascaraValorLer($linhaCadastro['valor']);?>
							</div>
						</td>
						<td style="text-align: center; vertical-align: middle;">
							<a href="cadastro-editar.php?id=<?php echo $linhaCadastro['id'];?>" class="links-acoes" style="width: 30px; height: 30px;">
								E
							</a>
						</td>
						<td style="text-align: center; vertical-align: middle;">
							<input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCadastro['id'];?>" />
						</td>
					</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3">
							<span style="line-height: 35px;">
								Qtd.: <?php echo count($resultadoCadastroListagem); ?>
							</span>
						
							<button type="submit" class="btn btn-danger" style="float:right;">
								Excluir Selecionados
							</button>
						</td>
					</tr>
				</tfoot>
			</table>
		</form>
		<script>
			$(document).ready(function() {
				//$('#cadastroListagem').DataTable();
			});
		</script>
	<?php } ?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>

<?php ob_start(); /* cphConteudo*/ ?>
	<section>
		<h1 class="layout-titulos container">
			Criar Novo Cadastro
		</h1>
		<div class="layout-conteudo">
			<form name="formCadastro" id="formCadastro" action="cadastro-acoes.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="CREATE" />
				
				<div class="div-campos">
					<input type="text" class="form-control" id="nome" name="nome" maxlength="255" required placeholder="Nome" />
				</div>
				<div class="div-campos">
					<input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" required placeholder="CPF / CNPJ" maxlength="17" style="width: 50%; float: left;" />
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
					<input type="text" onfocus="(this.type='date')" class="form-control" id="data_nascimento" name="data_nascimento" required placeholder="Data de Nasc." title="Data de Nasc." max="2020-05-10" style="width: 50%; float: right;" />
				</div>
				<div class="div-campos">
					<input type="text" class="form-control" id="endereco" name="endereco" maxlength="1000" required placeholder="Endereço" />
				</div>
				<div class="div-campos">
					<textarea class="form-control" id="descricao_titulo" name="descricao_titulo" rows="4" required placeholder="Descrição do Título" style="resize: none;"></textarea>
				</div>
				<div class="div-campos">
					<div class="input-group" style="width: 50%; float: left;">
						<div class="input-group-addon">R$</div>
						<input type="text" class="form-control" id="valor" name="valor" required placeholder="Valor" style="text-align: right;" />
						<script type="text/javascript">
							$("#valor").maskMoney({allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
						</script>
					</div>
					<input type="text" class="form-control" id="data_vencimento" name="data_vencimento" required placeholder="Data de Vencimento" min="2020-05-10" style="width: 50%; float: right;" />
				</div>
				<div class="div-campos" style="text-align: center;">
					<button id="btoSubmit" type="submit" class="btn btn-success" style="width: 100px; margin: auto;">
						Incluir
					</button>
					<div id="divCPFAlerta" class="alert alert-warning" style="display: none;">
					  CPF / CNPJ incompleto.
					</div>
				</div>
			</form>
			<script>
				$("#data_nascimento, #data_vencimento").focus(function(){
					this.type='date'
				}).blur(function(){
					this.type='text'
				});
				
				$("#valor").focus(function(){
					//this.value='0'
				}).blur(function(){
					//this.value=''
				});
			</script>
		</div>
	</section>
<?php 
$pageSite->cphConteudo = ob_get_clean(); 
//ob_end_flush();
?>

<?php
//Inclusão do template do layout.
include_once "layout.php";

unset($oclCadastro);
unset($resultadoCadastroListagem);

$dbSystemConPDO = null;
?>