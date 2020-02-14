<?php
    if( !isset ( $_SESSION['id_user'] ) ){
        header("Location: index.php");
        exit();
    }
?>
    <script src="/libraries/jquery-3.4.1.min.js"></script><?php
    // si mostrano notizie
    $query = "SELECT * FROM elementos WHERE tipo_elemento = 'audio'";

    try {
        $sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    } catch(Exception $e) {
        var_dump($e->getMessage());
    }

    $result = $sth->execute();
    if($result) {
        $audios = $sth->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Scuola</th>
                    <th>Titolo</th>
                    <th>Autore</th>
                    <th>Testo</th>
                    <th>Tag</th>
                    <th colspan="2">Audio</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($audios as $audio) {
                ?>
                <tr>
                    <form id="form<?=$audio["id_elemento"]?>" method="POST" enctype="multipart/form-data" action="./calls/modify_audio.php">
                        <th scope="row">
                            <?=$audio["id_elemento"]?>
                            <input type="hidden" name="id" value="<?=$audio["id_elemento"]?>">
                        </th>
                        <td>
                            <input type="text" class="form-control" value="<?=$audio["colegio_elemento"]?>" name="school" placeholder="Inserire il nome della scuola" maxlength="15">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="name" value="<?=$audio["nombre_elemento"]?>" placeholder="Inserire il nome del post" maxlength="100" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="author" value="<?=$audio["autor_elemento"]?>" placeholder="Inserire l'autore" maxlength="100">
                        </td>
                        <td>
                            <textarea class="form-control" name="text" placeholder="Inserire il contenuto del post" rows="3"><?=$audio["texto_elemento"]?></textarea>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="tags" value="<?=$audio["tags_elemento"]?>" placeholder="Inserire i tags, separati da una virgola" maxlength="100">
                        </td>
                        <td>
                            <?=$audio["recurso_elemento"]?>
                        </td>
                        <td>
                            <input type="file" class="form-control-file" name="audio" accept=".mp3">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Modifica</button>
                        </td>
                    </form>
                    <script>
                    // AJAX per submit
                    $("#form<?=$audio["id_elemento"]?>").submit(function(e) {
                        e.preventDefault();
                        var form = new FormData(this);
                        var url = $(this).attr('action');
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: form,
                            contentType: false,
                            processData: false,
                            success: function(data)
                            {
                                alert(data);
                            }
                            });
                        });
                    </script>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>

        <?php

    }
?>