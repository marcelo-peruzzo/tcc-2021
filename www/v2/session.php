<?php
require_once 'conexao.php';

session_start();

$email = $_POST['email'];
$password  = md5($_POST['password']);

if($email == NULL || $_POST['password'] == NULL){
	$retorno['status'] = 'error';
	die(json_encode($retorno)); 
}else{
	
	//LOGIN
	$query  = "SELECT * FROM Usuario WHERE email = '$email' and status = 'A' ";
	$result = mysqli_query($conn, $query);
	$total = mysqli_num_rows($result);

	if($total){

		$dados = mysqli_fetch_array($result);

		if(!strcmp($password, $dados['senha'])){

			$_SESSION['idUsuario'] = $dados['id'];
			$_SESSION['usuario']   = $dados['nome'];
			$_SESSION['perm']      = $dados['permissao'];
			$_SESSION['foto']      = $dados['foto'];
			$_SESSION['email']      = $dados['email']; 
			
			$retorno['status'] = 'success';
			die(json_encode($retorno));
		}else{
			$retorno['status'] = 'error';
			die(json_encode($retorno)); 
		}
	}else{
			$retorno['status'] = 'error';
			die(json_encode($retorno)); 
		}
} 
?>
