<?php
    require_once './conexion.php';
    $fileUploaded = file_exists($_FILES['picture']['tmp_name']);
    if(!$fileUploaded) {
        $filename = "";
    }else{
        $filename = str_replace(' ', '', $_POST["title"]).".jpg";
    }

    if(!$fileUploaded) {
        $update = "UPDATE elementos SET autor_elemento = :account, nombre_elemento = :title, texto_elemento = :text WHERE id_elemento = :id";
        $result = $conn->prepare($update);
        $success = $result->execute(array(':account' => $_POST["account"], ':title' => $_POST["title"], ':text' => $_POST["text"], ':id' => $_POST["id"]));
    } else {
        $update = "UPDATE elementos SET autor_elemento = :account, nombre_elemento = :title, texto_elemento = :text, recurso_elemento = :filename WHERE id_elemento = :id";
        $result = $conn->prepare($update);
        $success = $result->execute(array(':account' => $_POST["account"], ':title' => $_POST["title"], ':text' => $_POST["text"], ':id' => $_POST["id"], ':filename' => $filename));
    }



    if($success) {
        echo "Le modifiche sono state effettuate con successo!";
        if(strlen($filename) > 0) {
            $uploadSuccess = move_uploaded_file($_FILES["picture"]["tmp_name"], "../../elements/images/".$filename);
        }
    } else {
        echo "Si è verificato un problema nel salvataggio delle modifiche.";
        echo 'Exception -> ';
        print_r($result->errorInfo());
    }

    
?>