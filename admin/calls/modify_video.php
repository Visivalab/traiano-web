<?php
    require_once './conexion.php';
    $fileLoaded = file_exists($_FILES['video']['tmp_name']);
    var_dump($_FILES);
    if(!$fileLoaded) {
        $filename = "";
    }else{
        $filename = str_replace(' ', '', $_POST["name"]);
    }

    if(!$fileLoaded) {
        $update = "UPDATE elementos SET
                        colegio_elemento = :school,  nombre_elemento = :name, autor_elemento = :author,
                        subtitulo_elemento = :subtitle, tags_elemento = :tags WHERE id_elemento = :id";
    } else {
        $update = "UPDATE elementos SET
                    colegio_elemento = :school,  nombre_elemento = :name, autor_elemento = :author,
                    subtitulo_elemento = :subtitle, tags_elemento = :tags, recurso_elemento = :filename WHERE id_elemento = :id";
    }

    try {
        $result= $conn->prepare($update);
        if($fileLoaded) {
            $success = $result->execute(array(':school' => $_POST["school"],
                    ':name' => $_POST["name"], ':author' => empty($_POST["author"]) ? '' : $_POST["autor_elemento"],
                    ':subtitle' => $_POST["subtitle"], ':tags' => $_POST["tags"], ':filename' => $filename, ':id' => $_POST["id"]));
        } else {
            $success = $result->execute(array(':school' => $_POST["school"],
                    ':name' => $_POST["name"], ':author' => empty($_POST["autor_elemento"]) ? '' : $_POST["autor_elemento"],
                    ':subtitle' => $_POST["subtitle"], ':tags' => $_POST["tags"], ':id' => $_POST["id"]));
        }    
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    
    if($success) {
        echo "Le modifiche sono state effettuate con successo!";
        if(strlen($filename) > 0) {
            $uploadSuccess = move_uploaded_file($_FILES["video"]["tmp_name"], "../../elements/videos/".$filename.".mp4");
        }
    } else {
        echo "Si è verificato un problema nel salvataggio delle modifiche.";
        echo 'Exception -> ';
        print_r($result->errorInfo());
    }

    
?>