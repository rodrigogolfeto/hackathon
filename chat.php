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
		<title>Chat Online | Águas Guariroba</title>
		<link rel="stylesheet" type="text/css" href="css/custom.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
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

		<div class="row menu-mobile-sc2" style="height: 100%;">
			<section class="col-xs-2 col-md-2 col-sm-2 col-lg-2 pull-left menu-lateral" style="padding: 0px;">
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
				<div style="width:100%;display:block;">
					<button onclick="goBack()" class="bt-back"><img src="images/arrow-back.png"></button>
					<span class="maps-link">
						<a href="#"><i>Página Inicial</a></i>  >  <a href="#"><i>Chat</i></a> 
					</span>
				</div>
				<div class="conteudo-chat scrollbar-chat mensagens-do-chat" id="style-3-chat"></div>
				<div class="conteudo-formulario">
					<div class="envolve-form">
						<input type="text" class="InputAddOn-field" placeholder="Fale com algum de nossos atendentes..." disabled="disabled">
		      			<button class="InputAddOn-item"><img src="images/icon-send.png"></button>
		      		</div>
				</div>
			</section>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.js"/></script>  
	<script src="js/custom.js"></script>
	<script type="text/javascript">
		//<div class="box-msg"><div class="msgUser"><i class="icon-arrow-user">&nbsp;</i><p>< ?php echo $i; ?>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p></div></div>
		//<div class="box-msg"><div class="msgAdmin"><i class="icon-arrow-adm">&nbsp;</i><p><a href="#" class="link-chat">Para RELIGAÇÃO</a></p></div></div>
		var tamanho = 400;
		$(window).load(function(){
			setTimeout(function(){
				var html = '';
				
				html+= '<div class="box-msg"><div class="msgAdmin"><i class="icon-arrow-adm">&nbsp;</i><p>';
				html+= 'Olá Rodrigo Golfeto, seja bem vindo ao atendimento virtual da Águas Guariroba!<br>Selecione uma opção desejada:<br><br>';
				html+='<a href="javascript:;" class="link-chat" onmouseup="selecionaOpcao(\'- Para RELIGAÇÃO\');">- Para RELIGAÇÃO</a><br>';
				html+='<a href="javascript:;" class="link-chat" onmouseup="selecionaOpcao(\'- Para DÉBITOS\');">- Para DÉBITOS</a><br>';
				html+='<a href="javascript:;" class="link-chat" onmouseup="selecionaOpcao(\'- Para FALTA DE ÁGUA\');">- Para FALTA DE ÁGUA</a><br>';
				html+='<a href="javascript:;" class="link-chat" onmouseup="selecionaOpcao(\'- Para VAZAMENTOS\');">- Para VAZAMENTOS</a><br>';
				html+='<a href="javascript:;" class="link-chat" onmouseup="selecionaOpcao(\'- Para SEGUNDA VIA DE FATURAS\');">- Para SEGUNDA VIA DE FATURAS</a><br>';
				html+='<a href="javascript:;" class="link-chat" onmouseup="selecionaOpcao(\'- Para OUTRAS INFORMAÇÕES\');">- Para OUTRAS INFORMAÇÕES</a><br>';
				html+='<a href="javascript:;" class="link-chat" onmouseup="selecionaOpcao(\'- Para VERIFICAÇÃO DE CAIXA DE PROTEÇÃO PARA HIDRÔMETRO\');">- Para VERIFICAÇÃO DE CAIXA DE PROTEÇÃO PARA HIDRÔMETRO</a>';
				html+= '</p></div></div>';
				$('.mensagens-do-chat').append(html);
			},1500);
		});

		function selecionaOpcao(mensagem){
			var html = '';
			$('.link-chat').attr("onmouseup","");
			if(mensagem=='- Gerar O.S'){
				html+='<div class="box-msg"><div class="msgUser"><i class="icon-arrow-user">&nbsp;</i><p>Gerando O.S ...</p></div></div>';
				setTimeout(function(){
					window.location.href = "acompanhamento.php";
				},3000);
			}else{
				html+='<div class="box-msg"><div class="msgUser"><i class="icon-arrow-user">&nbsp;</i><p>'+mensagem+'</p></div></div>';
			}
			$('.mensagens-do-chat').append(html);
			$('.scrollbar-chat').animate({ scrollTop: tamanho }, 500);
			
			if(mensagem!='- Gerar O.S'){
				setTimeout(function(){
					html = '<div class="box-msg"><div class="msgAdmin"><i class="icon-arrow-adm">&nbsp;</i><p>';
					html+= 'Para solicitar o serviço de Ligação Nova de Água e/ou Esgoto, você deverá preencher o formulário e anexar cópia legível dos documentos descritos abaixo:<br><br>- Documento que comprove que o interessado é proprietário do imóvel, ou nele habita de boa-fé (Ex: Contrato de compra e venda com firma reconhecida do vendedor, escritura, IPTU atualizado, contrato de locação com firma reconhecida do locador, ou comprovante de residência (conta de energia, telefone fixo, tv a cabo, internet banda larga, etc.);<br><br>- Documentos pessoais do interessado em se tratando de pessoa física (RG e CPF) e, caso seja pessoa jurídica, documentos societários e documentos pessoais do representante legal;<br><br>- Se tratar de obra, o alvará de construção;<br><br>- Se tratar de atividade sujeita a licenciamento ambiental, apresentar a licença prévia.Após o preenchimento e envio dos documentos, a solicitação será analisada e no prazo de até dois dias úteis você receberá um e-mail confirmando se o pedido foi aprovado.<br><br>';
					html+= '<a href="javascript:;" class="link-chat" onmouseup="selecionaOpcao(\'- Preencha o formulário de Água\');">- Preencha o formulário de Água</a><br>';
					html+= '<a href="javascript:;" class="link-chat" onmouseup="selecionaOpcao(\'- Preencha o formulário de Esgoto\');">- Preencha o formulário de Esgoto</a><br>';
					html+= '<a href="javascript:;" class="link-chat" onmouseup="selecionaOpcao(\'- Preencha o formulário de Água e Esgoto\');">- Preencha o formulário de Água e Esgoto</a><br>';
					html+= '<a href="javascript:;" class="link-chat" onmouseup="selecionaOpcao(\'- Gerar O.S\');">- Gerar O.S</a><br>';
					html+= '</p></div></div>';
					$('.mensagens-do-chat').append(html);
					$('.scrollbar-chat').animate({ scrollTop: tamanho }, 500);
					tamanho+=400;
				},1500);
			}
			
		}
	</script>
	</body>
</html>