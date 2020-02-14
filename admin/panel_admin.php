<?php
	require_once 'calls/conexion.php';
	session_start();
	if( !isset ( $_SESSION['id_user'] ) ){
		header("Location: index.php");
		exit();
	}
	$id_user_activo = $_SESSION['id_user'];
	$nombre_user_activo = $_SESSION['nombre_user'];
	//$imagen_user_activo = $_SESSION['imagen_user'];
	//$nivel_user = $_SESSION['nivel_user'];
	//phpinfo();
	function showErrorMessage() {
		echo('<div class="alert alert-danger" role="alert">La funzione desiderata non è disponibile.</div>');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="UTF-8">

	<script src="https://kit.fontawesome.com/95bffa433b.js"></script>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
	<div class="barra_top">
		<h3><a href="https://traianolivemuseum.com/">Admin Traiano</a></h3>
	</div>
	<div class="menu">
		<h4>Aggiunta componenti</h4>
		<li><i class="far fa-file-circle"></i><a href="panel_admin.php?selection=post">New Post</a></li>
		<li><i class="far fa-play-circle"></i><a href="panel_admin.php?selection=video">Video</a></li>
		<li><i class="far fa-images"></i> <a href="panel_admin.php?selection=pictures">Galleria</a></li>
		<li><i class="fas fa-volume-down"></i><a href="panel_admin.php?selection=audio"> Audio</a></li>
		<li><i class="fa fa-newspaper-o" aria-hidden="true"><a href="panel_admin.php?selection=news"></i> News</a></li>
		<!--<li><i class="far fa-calendar-alt"></i> Evento</li>-->
		<li><i class="fab fa-facebook"></i><a href="panel_admin.php?selection=facebook">Post Facebook</a></li>
		<li><i class="fab fa-instagram"></i><a href="panel_admin.php?selection=instagram">Post Instagram</a></li>
		<h4>Modifica componenti</h4>
		<li><i class="far fa-file-circle"></i><a href="panel_admin.php?selection=post">Post</a></li>
		<li><i class="far fa-play-circle"></i> <a href="panel_admin.php?modify=video">Video</a></li>
		<li><i class="fas fa-volume-down"></i><a href="panel_admin.php?modify=audio">Audio</a></li>
		<li><i class="fa fa-newspaper-o" aria-hidden="true"><a href="panel_admin.php?modify=news"></i> News</a></li>
		<li><i class="fab fa-facebook"></i><a href="panel_admin.php?modify=facebook">Post Facebook</a></li>
		<li><i class="fab fa-instagram"></i><a href="panel_admin.php?modify=instagram">Post Instagram</a></li>
	</div>
	<div class="form">
<?php
	// qui ci saranno le modifiche per i vari form e per le letture dell'input
	// TODO: inserire un placeholder per posizionare form nella pagina
	if(isset($_GET["selection"])) {
		switch($_GET["selection"]) {
			case "post":
				require_once("./forms/post_form.php");
				break;
			case "video":
				require_once("./forms/video_form.php");
				break;
			case "pictures":
				require_once("./forms/gallery_form.php");
				break;
			case "audio":
				require_once("./forms/audio_form.php");
				break;
			case "news":
				require_once("./forms/news_form.php");
				break;
			case "facebook":
				require_once("./forms/facebook_form.php");
				break;
			case "instagram":
				require_once("./forms/instagram_form.php");
				break;
			default:
				showErrorMessage();
				break;
		}
	} else if(isset($_GET["modify"])) {
		require_once("./forms/modify_".$_GET["modify"]."_form.php");
	} else if(isset($_GET["submit"])) {
		switch($_GET["submit"]) {
			case "post":
				$filename = str_replace(' ','',$_POST["name"]);
				$query = "INSERT INTO elementos VALUES(
							NULL,
							NULL,
							'".addslashes($_POST['title'])."',
							NULL,
							NULL,
							'".addslashes($_POST['text'])."',
							'".addslashes($_POST['tags'])."',
							'".addslashes($_POST['category']."',
							NULL,
							addslashes($filename),
							'post',
							'1',
							now()
						");
				try{
					$sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				}catch(Exception $e){
					var_dump($e->getMessage());
				}

				
				// esecuzione query e verifica risultato
				$result = $sth->execute();
				if($result) {
					if(strlen($filename) > 0) {
						$uploadSuccess = move_uploaded_file($_FILES["picture"]["tmp_name"], "../elements/images/".$filename);
						if(!$uploadSuccess) {
							echo('<div class="alert alert-warning" role="alert">L\'immagine non è stata caricata correttamente per la seguente ragione: '.$_FILES["picture"]["error"]."</div>");
						}
					}
				} else {
					echo('<div class="alert alert-warning" role="alert">El post non è stato aggiunto correttamente: '.print_r($sth->errorInfo(), true).'</div>');
					return;
				}

				echo('<div class="alert alert-success" role="alert">El post è stato aggiunto correttamente.</div>');

				break;
			case "audio":
				$filename = str_replace(' ', '', $_POST["name"]);
				$query = "INSERT INTO elementos VALUES(NULL, '".addslashes($_POST["school"])."', '".addslashes($_POST["name"])."', '".addslashes($_POST["author"])."', '', '".addslashes($_POST["postContent"]).
							"', '".addslashes($_POST["tags"])."', '','".addslashes($filename)."', 'audio', now());";
				try {
					$sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				} catch(Exception $e) {
					var_dump($e->getMessage());
				}

				// esecuzione query e verifica risultato
				$result = $sth->execute();
				if($result) {
					// si copia il file
					$uploadSuccess = move_uploaded_file($_FILES["audioFile"]["tmp_name"], "../elements/audios/".$filename.".mp3");
					if(!$uploadSuccess) {
						echo('<div class="alert alert-success" role="alert">Il file non è stato caricato correttamente per la seguente ragione: '.$_FILES["audioFile"]["error"]."</div>");
					} else {
						echo('<div class="alert alert-success" role="alert">L\'audio è stato aggiunto correttamente.</div>');
					}
				} else {
					echo('<div class="alert alert-warning" role="alert">L\'audio non è stato aggiunto correttamente: '.print_r($sth->errorInfo(), true).'</div>');
				}
				break;
			case "video":
				$filename = str_replace(' ', '', $_POST["name"]);
				$query = "INSERT INTO elementos VALUES(NULL, '".addslashes($_POST["school"])."', '".addslashes($_POST["name"])."', '".addslashes($_POST["author"])."', '".addslashes($_POST["subtitle"])."', '', '".addslashes($_POST["tags"])."', '','".$filename."', 'video', now());";
				try {
					$sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				} catch(Exception $e) {
					var_dump($e->getMessage());
				}

				// esecuzione query e verifica risultato
				$result = $sth->execute();
				if($result) {
					// si copia il video
					$uploadSuccess = move_uploaded_file($_FILES["videoFile"]["tmp_name"], "../elements/videos/".$filename.".mp4");
					if(!$uploadSuccess) {
						echo('<div class="alert alert-warning" role="alert">Il file non è stato caricato correttamente per la seguente ragione: '.$_FILES["videoFile"]["error"]."</div>");
					} else {
						echo('<div class="alert alert-success" role="alert">Il video è stato aggiunto correttamente.</div>');
					}

					// si copia la miniatura
					$uploadSuccess = move_uploaded_file($_FILES["videoMiniatureFile"]["tmp_name"], "../elements/videos/".$filename.".png");
					if(!$uploadSuccess) {
						echo('<div class="alert alert-warning" role="alert">La miniatura non è stata caricata correttamente per la seguente ragione: '.$_FILES["videoMiniatureFile"]["error"]."</div>");
					}
				} else {
					echo('<div class="alert alert-warning" role="alert">Il video non è stato aggiunto correttamente: '.print_r($sth->errorInfo(), true).'</div>');
				}
				break;
			case "gallery":
				// come anteprima si usa la prima immagine presente in _FILES
				// le immagini si mettono in una cartella che ha lo stesso nome del post senza spazi e caratteri speciali
				$folderName = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $_POST["name"]));
				if(!file_exists("../elements/galerias/".$folderName)) {
					mkdir("../elements/galerias/".$folderName, 0777, true);
				}

				// query per tabella elements
				$query = "INSERT INTO elementos VALUES(NULL, '".addslashes($_POST["school"])."', '".addslashes($_POST["name"])."', '".addslashes($_POST["author"])."', '".addslashes($_POST["subtitle"])."', '".
							addslashes($_POST["postContent"])."', '".addslashes($_POST["tags"])."', '', '".$folderName."/".$_FILES["pictures"]["name"][0]."', 'galeria', now());";
				try {
					$sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				} catch(Exception $e) {
					var_dump($e->getMessage());
				}

				// esecuzione query e verifica risultato
				$resultElements = $sth->execute();


				if($resultElements) {
					// si fa upload delle immagini
					$galleryId = $conn->lastInsertId();
					$error = false;
					for($i = 0; $i < count($_FILES["pictures"]["tmp_name"]); $i++) {
						$uploadSuccess = move_uploaded_file($_FILES["pictures"]["tmp_name"][$i], "../elements/galerias/".$folderName."/".$_FILES["pictures"]["name"][$i]);

						if(!$uploadSuccess) {
							$error = true;
							echo('<div class="alert alert-warning" role="alert">L\'immagine non è stata caricata correttamente per la seguente ragione: '.$_FILES["pictures"]["error"][$i]."</div>");
						} else {
							// query per tabella link_imagenes_galeria
							$query = "INSERT INTO link_imagenes_galeria VALUES (NULL, 'image".$i."', '".$folderName."/".$_FILES["pictures"]["name"][$i]."', '".$galleryId."')";

							try {
								$sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
							} catch(Exception $e) {
								var_dump($e->getMessage());
							}

							$result = $sth->execute();
						}
					}
					if(!$error) {
						echo('<div class="alert alert-success" role="alert">La galleria è stata aggiunta correttamente.</div>');
					}
				} else {
					echo('<div class="alert alert-warning" role="alert">Si è verificato un errore del database nell\'aggiunta delle immagini: '.print_r($sth->errorInfo(), true).'</div>');
				}
				break;
			case "audio_group":
				// innanzitutto si inserisce il gruppo e si prende il suo id
				$query = "INSERT INTO grupos VALUES (NULL, '".addslashes($_POST["groupTitle"])."', '".addslashes($_POST["groupDescription"])."', '".addslashes($_POST["groupAuthor"])."', '', now())";
				try {
					$sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				} catch(Exception $e) {
					var_dump($e->getMessage());
				}

				// esecuzione query
				$result = $sth->execute();
				$groupId = $conn->lastInsertId();
				print_r($query);

				// attenzione: va inserita entry in tabella link_grupos_elementos
				for($i = 0; $i < count(array_filter($_POST["name"])); $i++) {
					$filename = str_replace(' ', '', $_POST["name"][$i]);
					$query = "INSERT INTO elementos VALUES(NULL, '".addslashes($_POST["school"][$i])."', '".addslashes($_POST["name"][$i])."', '".addslashes($_POST["author"][$i])."', '', '".addslashes($_POST["postContent"][$i]).
								"', '".addslashes($_POST["tags"][$i])."', '','".addslashes($filename)."', 'audio', now());";
					try {
						$sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
					} catch(Exception $e) {
						var_dump($e->getMessage());
					}

					// esecuzione query e verifica risultato
					$result = $sth->execute();

					$elementId = $conn->lastInsertId();
					$query = "INSERT INTO link_grupos_elementos VALUES(NULL, '".$elementId."', '".$groupId."')";
					try {
						$sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
					} catch(Exception $e) {
						var_dump($e->getMessage());
					}

					// esecuzione query e verifica risultato
					$sth->execute();

					if($result) {
						// si copia il file
						//print_r($_FILES);
						$uploadSuccess = move_uploaded_file($_FILES["audioFile"]["tmp_name"][$i], "../elements/audios/".$filename.".mp3");
						if(!$uploadSuccess) {
							echo('<div class="alert alert-success" role="alert">Il file non è stato caricato correttamente per la seguente ragione: '.$_FILES["audioFile"]["error"][$i]."</div>");
						} else {
							echo('<div class="alert alert-success" role="alert">L\'audio è stato aggiunto correttamente.</div>');
						}
					} else {
						echo('<div class="alert alert-warning" role="alert">L\'audio non è stato aggiunto correttamente: '.print_r($sth->errorInfo(), true).'</div>');
					}
				}
				break;
			case "video_group":
				// innanzitutto si inserisce il gruppo e si prende il suo id
				$query = "INSERT INTO grupos VALUES (NULL, '".addslashes($_POST["groupTitle"])."', '".addslashes($_POST["groupDescription"])."', '".addslashes($_POST["groupAuthor"])."', '', now())";
				try {
					$sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				} catch(Exception $e) {
					var_dump($e->getMessage());
				}

				// esecuzione query
				$result = $sth->execute();
				$groupId = $conn->lastInsertId();

				// attenzione: va inserita entry in tabella link_grupos_elementos
				for($i = 0; $i < count(array_filter($_POST["name"])); $i++) {
					$filename = str_replace(' ', '', $_POST["name"][$i]);
					$query = "INSERT INTO elementos VALUES(NULL, '".addslashes($_POST["school"][$i])."', '".addslashes($_POST["name"][$i])."', '".addslashes($_POST["author"][$i])."', '".addslashes($_POST["subtitle"][$i])."', '', '".addslashes($_POST["tags"][$i])."', '','".$filename."', 'video', now());";
					try {
						$sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
					} catch(Exception $e) {
						var_dump($e->getMessage());
					}

					// esecuzione query e verifica risultato
					$result = $sth->execute();

					$elementId = $conn->lastInsertId();
					$query = "INSERT INTO link_grupos_elementos VALUES(NULL, '".$elementId."', '".$groupId."')";
					try {
						$sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
					} catch(Exception $e) {
						var_dump($e->getMessage());
					}

					// esecuzione query e verifica risultato
					$sth->execute();

					if($result) {
						// si copia il file
						//print_r($_FILES);
						$uploadSuccess = move_uploaded_file($_FILES["videoFile"]["tmp_name"][$i], "../elements/videos/".$filename.".mp4");
						if(!$uploadSuccess) {
							echo('<div class="alert alert-success" role="alert">Il file non è stato caricato correttamente per la seguente ragione: '.$_FILES["videoFile"]["error"][$i]."</div>");
						} else {
							echo('<div class="alert alert-success" role="alert">Il video è stato aggiunto correttamente.</div>');
						}
					} else {
						echo('<div class="alert alert-warning" role="alert">Il video non è stato aggiunto correttamente: '.print_r($sth->errorInfo(), true).'</div>');
					}
				}
				break;
			case "news":
				if(!file_exists($_FILES['picture']['tmp_name'])) {
					$filename = "";
				}else{
					$filename = str_replace(' ', '', $_POST["title"]).".jpg";
				}

				$newsQuery = "INSERT INTO noticias VALUES(NULL, '".addslashes($_POST["title"])."', NOW(), '".addslashes($_POST["text"])."', '".$filename."', 1)";
				$sth = $conn->prepare($newsQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

				// esecuzione query e verifica risultato
				$result = $sth->execute();
				if($result) {
					if(strlen($filename) > 0) {
						$uploadSuccess = move_uploaded_file($_FILES["picture"]["tmp_name"], "../elements/noticias/".$filename);
						if(!$uploadSuccess) {
							echo('<div class="alert alert-warning" role="alert">L\'immagine non è stata caricata correttamente per la seguente ragione: '.$_FILES["picture"]["error"]."</div>");
						}
					}
				} else {
					echo('<div class="alert alert-warning" role="alert">La notizia non è stata aggiunta correttamente: '.print_r($sth->errorInfo(), true).'</div>');
					return;
				}

				// inserimento tags
				$newsId = $conn->lastInsertId();
				$tags = explode(",", addslashes($_POST["tags"]));
				foreach($tags as $tag) {
					// innanzitutto si cerca se esiste
					$tagQuery = "SELECT COUNT(nombre_tag) FROM `tags_noticias` WHERE nombre_tag = '".$tag."'";
					$sth = $conn->prepare($tagQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
					$sth->execute();
					$tagId = NULL;
					if($sth->fetchColumn() == 0) {
						// si aggiunge il nuovo tag alla tabella
						$addTagQuery = "INSERT INTO tags_noticias VALUES(NULL, '".$tag."', '1')";
						$sth = $conn->prepare($addTagQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
						$sth->execute();
						$tagId = $conn->lastInsertId();
					} else {
						$tagQuery = "SELECT id_tag FROM `tags_noticias` WHERE nombre_tag = '".$tag."'";
						$sth = $conn->prepare($tagQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
						$sth->execute();
						$tagId = $sth->fetchColumn();
					}

					// si fa il collegamento tra notizie e tag
					$query = "INSERT INTO link_tagsnoticias_noticias VALUES(NULL, '".$tagId."', '".$newsId."')";
					$sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
					$sth->execute();
				}
				echo('<div class="alert alert-success" role="alert">La notizia è stata aggiunta correttamente.</div>');
				break;
			case "instagram":
				if (!file_exists($_FILES['picture']['tmp_name'])) {
					$filename = "";
				} else {
					$filename = str_replace(' ', '', $_POST["title"]).".jpg";
				}

				$query = "INSERT INTO elementos VALUES(NULL, '', '".addslashes($_POST["title"])."', '"
							.addslashes($_POST["account"])."', '', '', '".addslashes($_POST["tag"])."', '".addslashes($_POST["link"]).
							"', '".$filename."', 'instagram', '1', NOW())";

				$sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

				// esecuzione query e verifica risultato
				$result = $sth->execute();
				if($result) {
					if(strlen($filename) > 0) {
						$uploadSuccess = move_uploaded_file($_FILES["picture"]["tmp_name"], "../elements/images/".$filename);
						if(!$uploadSuccess) {
							echo('<div class="alert alert-warning" role="alert">L\'immagine non è stata caricata correttamente per la seguente ragione: '.$_FILES["picture"]["error"]."</div>");
							return;
						}
					}
				} else {
					echo('<div class="alert alert-warning" role="alert">L\'anteprima del post non è stata aggiunta correttamente: '.print_r($sth->errorInfo(), true).'</div>');
					return;
				}
				echo('<div class="alert alert-success" role="alert">L\'anteprima del post Instagram è stata aggiunta correttamente.</div>');
				break;
			case "facebook":
				$query = "INSERT INTO elementos VALUES(NULL, '', '', '"
							.addslashes($_POST["account"])."', '', '".addslashes($_POST["text"])."', '', '".addslashes($_POST["link"]).
							"', '', 'facebook', '1', NOW())";

				$sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

				// esecuzione query e verifica risultato
				$result = $sth->execute();
				if(!$result) {
					echo('<div class="alert alert-warning" role="alert">L\'anteprima del post Facebook non è stata aggiunta correttamente: '.print_r($sth->errorInfo(), true).'</div>');
					return;
				}
				echo('<div class="alert alert-success" role="alert">L\'anteprima del post Facebook è stata aggiunta correttamente.</div>');
				break;
			default:
				showErrorMessage();
		}
	}

?>
	</div>
</body>
<footer>
	<script type="text/javascript" src="principal.js"></script>
	<script type="text/javascript" src="generate.js"></script>
</footer>
</html>