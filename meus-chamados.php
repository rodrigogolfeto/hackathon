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
					<a href="#"><i>Página Inicial</a></i>  >  <a href="#"><i>Meus Chamados</i></a> 
				</span>
			</section>

			<div class="col-xs-12 col-md-10 col-sm-10 col-lg-10 scrollbar" id="style-3" style="height:90%;">
				<section class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
					<div class="row">
						<div class="wizard">
							<form role="form">
								<div class="tab-content">
									<div class="tab-pane active" role="tabpanel" id="step1">
										<h3>Meus Chamados</h3>
										<table class="table table-bordered table-hover margin-top-25">
											<tr>
												<th class="tit-table text-center" width="15%">Data</th>
												<th class="tit-table" width="70%">Descrição</th>
												<th class="tit-table" width="15%">Ações</th>
											</tr>
											<tr>
												<td class="text-center">10/12/2016</td>
												<td>CORTE NO CAVALETE</td>
												<td><a href="acompanhamento.php">Acompanhar</a></td>
											</tr>
											<tr>
												<td class="text-center">05/11/2016</td>
												<td>RELIGAÇÃO NO CAVALETE (ATÉ 48H)</td>
												<td><a href="acompanhamento.php">Acompanhar</a></td>
											</tr>
											<tr>
												<td class="text-center">15/10/2016</td>
												<td>VAZAMENTO CAV.3/4</td>
												<td>Finalizado</td>
											</tr>
										</table>
									</div>
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
	</body>
</html>