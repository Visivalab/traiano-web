<?php
    require_once './conexion.php';
    $fileUploaded = file_exists($_FILES['picture']['tmp_name']);
    if(!$fileUploaded) {
        $filename = "";
    }else{
        $filename = str_replace(' ', '', $_POST["title"]).".jpg";
    }

    if(!$fileUploaded) {
        $update = "UPDATE noticias SET titulo_noticia = :title, texto_noticia = :text WHERE id_noticia = :id";
        $result = $conn->prepare($update);
        $success = $result->execute(array(':title' => $_POST["title"], ':text' => $_POST["text"], ':id' => $_POST["id"]));
    } else {
        $update = "UPDATE noticias SET titulo_noticia = :title, texto_noticia = :text, foto_noticia = :filename WHERE id_noticia = :id";
        $result = $conn->prepare($update);
        $success = $result->execute(array(':title' => $_POST["title"], ':text' => $_POST["text"], ':id' => $_POST["id"], ':filename' => $filename));
    }



    if($success) {
        echo "Le modifiche sono state effettuate con successo!";
        if(strlen($filename) > 0) {
            $uploadSuccess = move_uploaded_file($_FILES["picture"]["tmp_name"], "../../elements/noticias/".$filename);
        }
    } else {
        echo "Si è verificato un problema nel salvataggio delle modifiche.";
        echo 'Exception -> ';
        print_r($result->errorInfo());
    }

    
?>