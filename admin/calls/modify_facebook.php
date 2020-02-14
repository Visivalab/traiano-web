<?php
    require_once './conexion.php';
    $query = "UPDATE elementos SET autor_elemento = :author, texto_elemento = :text, link_elemento = :link WHERE id_elemento = :id";

    $sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

    // esecuzione query e verifica risultato
    $result = $sth->execute(array(':author' => $_POST["account"], ':text' => $_POST["text"], ':link' => $_POST["link"], ':id' => $_POST["id"]));
    if(!$result) {
        echo('L\'anteprima del post Facebook non è stata aggiunta correttamente: '.print_r($sth->errorInfo(), true));
        return;
    }
    echo('L\'anteprima del post Facebook è stata aggiunta correttamente.');

    
?>