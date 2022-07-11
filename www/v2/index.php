<?php

require_once 'auth.php';

if($usuario && $perm){
	header('Location: home.php');
}else{
    header('Location: pages/authentication/login.php');
}

?>