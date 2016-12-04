<?php
require_once('funcoes.php');

if(empty($_SESSION['clie_id'])){
	header("location:logar.php");
}else{
	header("location:principal.php");
}

?>