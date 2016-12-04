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
		<title>Principal | Águas Guariroba</title>
		<link rel="stylesheet" type="text/css" href="css/custom.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">  
	</head>

	<body>
		
	<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12" style="height: 100%;">
		<div class="row fundo-azul">
			<section class="col-lg-1">
				<a href="chat.php"><img src="images/logo-menor.png"></a>
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

		<div class="row menu-mobile-sc" style="height: 100%;">
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
					<a href="chat.php"><i>Página Inicial</a></i>  >  <a href="chat.php"><i>Chat</i></a> 
				</span>
			</section>

			<div class="col-xs-12 col-md-10 col-sm-10 col-lg-10 scrollbar" id="style-3" style="height:90%;">
				<section class="col-lg-12 margin-top-25">
					<div class="row">
						<section class="col-xs-6 col-lg-3 col-sm-3 col-md-6"><a href="chat.php"><div class="bl-1 bl-principal"></div></a></section>
						<section class="col-xs-6 col-lg-3 col-sm-3 col-md-6"><a href="chat.php"><div class="bl-2 bl-principal"></div></a></section>
						<section class="col-xs-6 col-lg-3 col-sm-3 col-md-6"><a href="chat.php"><div class="bl-3 bl-principal"></div></a></section>
						<section class="col-xs-6 col-lg-3 col-sm-3 col-md-6"><a href="chat.php"><div class="bl-4 bl-principal"></div></a></section>
					</div>
				</section>


				<section class="col-lg-12 margin-top-25">
					<h2>Histórico de Contas</h2>
						<table class="table table-bordered table-hover margin-top-25">
							<tr>
								<th class="tit-table">Referencia</th>
								<th class="tit-table">Tipo</th>
								<th class="tit-table">Consumo (m³)</th>
								<th class="tit-table">Valor</th>
								<th class="tit-table">Situação</th>
								<th class="tit-table">Vencimento</th>
								<th class="tit-table">Pagamento</th>
								<th class="tit-table">Visualizar</th>
							</tr>
							<?php
							$sql = "SELECT debi_id,debi_data_referencia,deti_titulo,debi_consumo,debi_valor,debi_data_vencimento,(SELECT depa_data_pagamento FROM sist_debitos_pagamentos WHERE depa_debi_id=debi_id LIMIT 1) AS 'depa_data_pagamento' FROM sist_debitos,sist_debitos_tipo WHERE debi_clie_id='".$linDadosCliente['clie_id']."' AND debi_deti_id=deti_id ORDER BY debi_data_referencia DESC";
							$res = $conn->consulta($sql);
							if($conn->conta($res)==0){
								?><tr><td align="center" colspan="8">Nenhum item encontrado.</td></tr><?php
							}
							while($lin=$conn->busca($res)){

								$status = "Em Débito";
								$dataPagamento = '<button class="btn-peq">imprimir</button><button class="btn-peq">pagar conta</button>';

								if(!empty($lin['depa_data_pagamento'])){
									$status = "Quitada";
									$dataPagamento = substr($lin['depa_data_pagamento'],8,2).'/'.substr($lin['depa_data_pagamento'],5,2).'/'.substr($lin['depa_data_pagamento'],0,4);
								}
								?>
								<tr>
									<td align="center"><?php echo substr($lin['debi_data_referencia'],5,2); ?>/<?php echo substr($lin['debi_data_referencia'],0,4); ?></td>
									<td align="center"><?php echo $lin['deti_titulo']; ?></td> 
									<td align="center"><?php echo $lin['debi_consumo']; ?></td>
									<td align="center">R$ <?php echo number_format($lin['debi_valor'],2,',','.'); ?></td>
									<td align="center"><?php echo $status; ?></td>
									<td align="center"><?php echo substr($lin['debi_data_vencimento'],8,2).'/'.substr($lin['debi_data_vencimento'],5,2).'/'.substr($lin['debi_data_vencimento'],0,4); ?></td> 
									<td align="center"><?php echo $dataPagamento; ?></td>
									<td align="center"><a href="chat.php">visualizar</a></td>
								</tr>
								<?php
							}
							?>
						</table>
					</section>
				</div>
			</div>
		</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"/></script>  
	<script src="js/custom.js"></script>
	</body>
</html>