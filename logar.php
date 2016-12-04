<?php
require_once('config/funcoes.php');
$validacao = "";

if(!empty($_POST) && $_POST['acao']=='acao'){
	
	//RECEBE INFORMAÇÕES DO FORMULÁRIO
	$substituir = array('.','-',' ');
	$campo_matricula = str_replace($substituir,'',$_POST['campo_matricula']);
	$campo_cpf = str_replace($substituir,'',$_POST['campo_cpf']);

	//VERIFICA DADOS NA BASE DE DADOS
	$sql = "SELECT clie_id FROM sist_clientes WHERE clie_matricula='".$campo_matricula."' AND clie_cpf='".$campo_cpf."' LIMIT 1";
	$res = $conn->consulta($sql);
	$tot = $conn->conta($res);

	if($tot==1){
		$lin = $conn->busca($res);
		$_SESSION['clie_id'] = $lin['clie_id'];
		header("location:principal.php");
	}else{
		$validacao = "DADOS INCORRETOS, TENTE NOVAMENTE.";
	}
}
?>
<!DOCTYPE html>
<meta charset="utf-8">
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login | Águas Guariroba</title>
		<link rel="stylesheet" type="text/css" href="css/custom.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">	
	</head>

	<body class="fundoLogin">
		<div class="nav navbar">
			<a class="navbar-brand pull-left" href="#"><img src="images/logo.png"></a>
		</div>
            
        <div class="container margin-top-box">  
        	<div class="col-md-4"></div>  
		    <div class="text-center col-md-4">
		        <h5><b>Pensando em você, inovamos nosso atendimento. <br>Resolva agora rapidamente seus problemas!</b></h5>
		        <?php
				if(!empty($validacao)){
					?><b style="color:#ED4845;display:block;" id="mensagem"><?php echo $validacao; ?></b><?php
				}
				?>
		        <form id="form_logar" class="margin-top-50" name="form_logar" method="post" action="">
		        	<input type="text" class="input-style cpf" placeholder="Digite seu CPF" name="campo_cpf">
		        	<input type="text" class="input-style margin-top-25 matricula" placeholder="Digite o número da ligação" name="campo_matricula">
		        	<input type="hidden" name="acao" value="acao">
		        	<div class="margin-top-25">
			        	<p class="pull-left">
			        	    <input type="checkbox" id="test1" />
			        	    <label for="test1">Deseja lembrar seu login?</label>
			        	</p>
		        	</div>
		        	<button class="btn btn-enviar" onmouseup="document.getElementById('form_logar').submit();"><b>Entrar</b></button>
		        </form>
		        <div class="margin-top-25">
		      		<a href="#" class="link-style">Está tendo problemas ao logar? <span class="color-blue-link">clique aqui</span>!</a>
		        </div>
		    </div>
		    <div class="col-md-4"></div>
	    </div>
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.js"/></script>
		<script src="js/efeitos.js"></script>
		<?php if(!empty($validacao)){ ?>
			<script type="text/javascript">
				setTimeout(function(){
					$('#mensagem').slideUp(500);
				},5000);
			</script>
		<?php } ?>
	</body>
</html>