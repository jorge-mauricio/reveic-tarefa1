<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<!--Google Analytics.-->
		
		<meta charset="UTF-8">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge"><!--Bootstrap required.-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>
			RECEIV - Tarefa de Teste
		</title>
		
		<!--Style Sheets. -->
		<link rel="stylesheet" type="text/css" href="js/bootstrap.min.css" /><!--Note: Any custom css file must be included after the bootstrap css.-->
		<link rel="stylesheet" type="text/css" href="estilos.css" media="screen" title="Default" />
		<link rel="canonical" href="https://www.jorgemauricio.com" />
		
		<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
		<link rel="manifest" href="site.webmanifest">
		<link rel="mask-icon" href="safari-pinned-tab.svg" color="#ff4b14">
		<meta name="msapplication-TileColor" content="#32364a">
		<meta name="theme-color" content="#32364a">
		
		<!--Content meta tags. -->
		<meta name="title" content="RECEIV - <?php echo $pageSite->cphTituloLinkAtual; ?>" />
        <meta name="description" content="Tarefa de Teste" />
        <meta name="keywords" content="receiv, jorge mauricio, php" />
		<meta name="robots" content="index, follow" />
		
		<meta name="language" content="portuguese" />
		<!--meta http-equiv="pragma" content="no-cache" /-->
		
		<!--Authoring meta tags. -->
		<meta name="author" content="Jorge Mauricio" />
		<meta name="designer" content="Jorge Mauricio" />
		<meta name="copyright" content="2020, Planejamento Visual" />
		<meta name="rating" content="general" /><!--general | mature | restricted | 14 years. -->
		
		<!--Open Graph tags. -->
		<meta property="og:title" content="RECEIV - <?php echo $pageSite->cphTituloLinkAtual; ?>" />
		<meta property="og:type" content="website" /><!--ref: http://ogp.me/#types | https://developers.facebook.com/docs/reference/opengraph/-->
		<meta property="og:url" content="https://www.jorgemauricio.com/clientes/receiv" />
		<meta property="og:description" content="Tarefa de Teste" />
		<meta property="og:image" content="https://www.jorgemauricio.com/clientes/img/layout-logo-receiv02.png" /><!--The recommended resolution for the OG image is 1200x627 pixels, the size — up to 5MB.--><!--120x120px, up to 1MB--><!--JPG ou PNG, menos que 300k e dimensão mínima de 300x200 pixels.-->
		<meta property="og:image:alt" content="RECEIV - Logo" />
		<meta property="og:locale" content="pt_BR" />
		
		
		<!--Personalized library. -->
		<script src="js/funcoes-personalizadas.js"></script>
		
		<!--JQuery. -->
		<!-- ************************************************************************************** -->
		<!--script src="js/jquery-1.8.3.min.js"></script-->
		<script src="js/jquery-2.1.3.min.js"></script>
		<!-- ************************************************************************************** -->
	
	
		<!--Outras bibliotecas. -->
		<!-- ************************************************************************************** -->
		<script src="js/maskMoney/src/jquery.maskMoney.js" type="text/javascript"></script>
		<!--script src="js/maskedinput/dist/jquery.maskedinput.min.js" type="text/javascript"></script-->
		
		 
		<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
		<!-- ************************************************************************************** -->
	
	
		<!--CSS - page level. -->
		<style>
			html,
			body{
				margin: 0;
				padding: 0;
				/*height: 100%;*/
				/*overflow-x: hidden;*/
				/*overflow: hidden;*/
				
				/*background-image: url(img/layout-bg1.png); 
				background-repeat: no-repeat; 
				background-attachment: fixed;
				background-position: center 70px;*/
				background-color: #f5f6fa;
			}
		</style>
	</head>
	
	<body>
		<noscript>Por favor habilite JavaScript</noscript>
        <div style="position: relative; display: flex; width: 100%; flex-direction: column; min-height: 100vh;">
			<header class="container layout-header">
				<a href="cadastro-listagem.php" class="layout-logo" title="Home">
					<img class="hidden-xs hidden-sm visible-md visible-lg center-block" src="img/layout-logo-receiv02.png" alt="Logo RECEIV" />
					<img class="visible-xs visible-sm hidden-md hidden-lg center-block" src="img/layout-logo-receiv_w250.png" alt="Logo RECEIV" />
				</a>
			</header>
			<main class="container layout-main">
				<section>
					<h1 class="layout-titulos container">
						<?php echo $pageSite->cphTituloLinkAtual; ?>
					</h1>
					<nav class="layout-nav">
						<a href="dashboard.php" role="button" class="btn btn-primary" style="width: 32%;">
							Dashboard
						</a>
						<a href="cadastro-listagem.php" role="button" class="btn btn-primary" style="width: 32%;">
							Cadastros
						</a>
						
						<div style="width: 32%;">
							<form action="cadastro-listagem.php" method="GET"> 
								<div>
								  <div class="input-group">
									<input type="text" class="form-control" placeholder="Busca" id="palavraChave" name="palavraChave" value="<?php echo $palavraChave; ?>"/>
									<div class="input-group-btn">
									  <button class="btn btn-primary" type="submit">
										<span class="glyphicon glyphicon-search"></span>
									  </button>
									</div>
								  </div>
							</div>
							</form>	
						</div>
						
					</nav>
					<div class="layout-conteudo">
						<?php echo $pageSite->cphConteudoPrincipal; ?>
					</div>
				</section>
				
				<?php echo $pageSite->cphConteudo; ?>
			</main>
			
			<footer class="layout-footer layout-contato container-fluid">
				<address class="container" style="background-color: #1e2030; width: 100%; min-height: 150px; margin: 0px 0px 0px 0px;">
					<br />
					Telefone (11) 3090-6102
					<br />
					E-mail: 
					<a href="mailto:contato@receiv.it" class="link-rodape" title="e-mail">
						contato@receiv.it
					</a>
				</address>
	
				<small class="layout-creditos">
					Copyright © 2020 Jorge Mauricio. Todos direitos reservados.
					<br />
					Criação: Jorge Mauricio - Full Stack Web Depeloper
				</small>
			</footer>
		</div>
	</body>
	<script src="js/bootstrap.min.js"></script>
</html>