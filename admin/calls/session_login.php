<?php
	require_once 'conexion.php';

	if(isset( $_POST['login_submit']) ){

		$user_name = $_POST['user_name'];
		$user_password = $_POST['user_password'];

		if ( empty($user_name) || empty($user_password) ){
			header("Location: ../index.php?error=campos_vacios&nombre=".$user_name);
			exit();
		}

		$consulta = "SELECT id_user,nombre_user,fecha_user,pass_user,mail_user FROM users WHERE ( nombre_user=:user || mail_user=:mail )";
		$login = $conn->prepare($consulta);
		$login->bindParam(':user',$user_name);
		$login->bindParam(':mail',$user_name);

		if( $login->execute() ){
			$cant_resultats = $login->rowCount();
			$user = $login->fetch();
			
			if ($cant_resultats == 1) {
				$pass_check = password_verify($user_password, $user['pass_user']);
				if ($pass_check == false){
					header("Location: ../index.php?error=nopass");
					exit();
				} else if ($pass_check == true){
					session_start();
					$_SESSION['id_user'] = $user['id_user'];
					$_SESSION['nombre_user'] = $user['nombre_user'];
					$_SESSION['mail_user'] = $user['mail_user'];
					$_SESSION['fecha_user'] = $user['fecha_user'];
					header("Location: ../panel_admin.php");
				} else {
					header("Location: ../index.php?error=nopass");
					exit();
				}

			} else if($cant_resultats == 0){
			   	header("Location: ../index.php?error=nouser");
				exit();
			} else{
				echo 'WTF';
			}
		}else{
			header("Location: ../index.php?error=sqlerror&nombre=".$user_name);
			exit();
		}

	}else{
		header("Location: ../index.php");
		exit();
	}


?>