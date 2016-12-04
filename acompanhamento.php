<?php
require_once('config/funcoes.php');

//PEGA AS INFORMAÇÕES DO CLIENTE E FAZ UMA VERIFICAÇÃO DE LOGIN
$sqlDadosCliente = "SELECT clie_id,clie_nome FROM sist_clientes WHERE clie_id='".$_SESSION['clie_id']."' LIMIT 1";
$resDadosCliente = $conn->consulta($sqlDadosCliente);
$totDadosCliente = $conn->conta($resDadosCliente);

if($totDadosCliente==0){
	header("location:logar.php");
}else{
	$linDadosCliente = $conn->busca($resDadosCliente);
}
?>
<!DOCTYPE html>
<meta charset="utf-8">
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Acompanhamento | Águas Guariroba</title>
		<link rel="stylesheet" type="text/css" href="css/custom.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">  
		<link rel="stylesheet" type="text/css" href="css/sweetalert.css">  
	</head>

	<body>
		
	<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12" style="height: 100%;">
		<div class="row fundo-azul">
			<section class="col-lg-1">
				<a href="#"><img src="images/logo-menor.png"></a>
			</section>

			<section>
				<p class="bem-vindo-text">Seja bem vindo, <b><?php echo $linDadosCliente['clie_nome']; ?></b></p>
			</section>

			<section class="pull-right btns-header-menu">
				<a href="meus-chamados.php" class="btn btn-chamadas">Meus Chamados</a>
				<a href="meus-chamados.php" class="btn-icon"><img src="images/icon-alert.png"><span class="badge">3</span></a>
				<a href="sair.php" class="btn-icon"><img src="images/logout-icon.png"></a>
			</section>
		</div>

		<div class="row" style="height: 100%;">
			<section class="col-xs-12 col-md-2 col-sm-2 col-lg-2 pull-left menu-lateral" style="padding: 0px;">
				<ul class="list-group ul-lateral">
					<li class="list-group-item text-center li-lateral"><a href="chat.php">2ª Via de Conta</a></li>
					<li class="list-group-item text-center li-lateral"><a href="chat.php">Conheça Sua Conta</a></li>
					<li class="list-group-item text-center li-lateral"><a href="chat.php">Débito Automático</a></li>
					<li class="list-group-item text-center li-lateral"><a href="chat.php">Ligação Nova de Água e Esgoto</a></li>
					<li class="list-group-item text-center li-lateral"><a href="chat.php">Ligação Nova de Água e Esgoto</a></li>
					<li class="list-group-item text-center li-lateral"><a href="chat.php">Tarifas</a></li>
					<li class="list-group-item text-center li-lateral"><a href="chat.php">Religação de Água</a></li>
					<li class="list-group-item text-center li-lateral"><a href="chat.php">Transferência de Titularidade</a></li>
				</ul>	
			</section>

			<section class="col-xs-12 col-md-10 col-sm-10 col-lg-10 header-menu">
				<button onclick="goBack()" class="bt-back"><img src="images/arrow-back.png"></button>
				<span class="maps-link">
					<a href="#"><i>Página Inicial</a></i>  >  <a href="#"><i>Chat</i></a> 
				</span>
			</section>

			<div class="col-xs-12 col-md-10 col-sm-10 col-lg-10 scrollbar" id="style-3" style="height:90%;">
				<section class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
					<div class="row">
						<div class="wizard">
							<div class="wizard-inner">
								<div class="connecting-line"></div>

								<div class="progress">
								  <div class="progress-bar" role="progressbar" id="myBar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="0" style="width: 0%;">
								    <span class="sr-only">0% Complete</span>
								  </div>
								</div>

								<ul class="nav nav-tabs" role="tablist">
									<li role="presentation" class="active">
										<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="SAC">
											<span class="round-tab concluido" id="passo1">
												<h2>1º</h2>
											</span>
										</a>
									</li>
									<li role="presentation" class="disabled">
										<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Operacional">
											<span class="round-tab" id="passo2">
												<h2>2º</h2>
											</span>
										</a>
									</li>
									<li role="presentation" class="disabled">
										<a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Equipe de Campo">
											<span class="round-tab">
												<h2>3º</h2>
											</span>
										</a>
									</li>
									<li role="presentation" class="disabled">
										<a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Problema Solucionado">
											<span class="round-tab">
												<h2>4º</h2>
											</span>
										</a>
									</li>
								</ul>
							</div>

							<form role="form">
								<div class="tab-content">
									<div class="tab-pane active" role="tabpanel" id="step1">
										<h3>Histórico de Notificações</h3>
										<table class="table table-bordered table-hover margin-top-25 lista-notificacoes">
											<tr>
												<th class="tit-table text-center" width="15%">Data</th>
												<th class="tit-table" width="85%">Descrição</th>
											</tr>
											<tr>
												<td class="text-center">10/12/2016 02:39</td>
												<td>Duis semper, purus vitae consectetur porta, ipsum neque venenatis neque, at mollis velit nisi sed urna.</td>
											</tr>
											<tr>
												<td class="text-center">10/12/2016 05:54</td>
												<td>There are many variations of passages of Lorem Ipsum available.</td>
											</tr>
											<tr>
												<td class="text-center">10/12/2016 08:17</td>
												<td>Combined with a handful of model sentence structures, to generate.</td>
											</tr>
										</table>
									</div>
									<div class="tab-pane" role="tabpanel" id="complete">
										<h3>Protocolo Encerrado!</h3>
										<p>Protocolo encerrado com sucesso.</p>
									</div>
									<div class="clearfix"></div>
								</div>
							</form>
						</div>
				   </div>
				</section>
			</div>
		</div>
	</div>


	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"/></script>  
	<script src="js/custom.js"></script>
	<script src="js/efeitos.js"></script>
	<script type="text/javascript">
		setTimeout(function(){ alertBox(); },3000);
	</script>
	</body>
</html>