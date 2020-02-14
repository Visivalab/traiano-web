<?php
    if( !isset ( $_SESSION['id_user'] ) ){
        header("Location: index.php");
        exit();
    }
?>
    <script src="/libraries/jquery-3.4.1.min.js"></script><?php
    // si mostrano notizie
    $query = "SELECT * FROM elementos WHERE tipo_elemento = 'instagram'";

    try {
        $sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    } catch(Exception $e) {
        var_dump($e->getMessage());
    }

    $result = $sth->execute();
    if($result) {
        $postArray = $sth->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Autore</th>
                    <th>Titolo</th>
                    <th>Testo</th>
                    <th colspan="2">Foto</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($postArray as $post) {
                ?>
                <tr>
                    <form id="form<?=$post["id_elemento"]?>" method="POST" enctype="multipart/form-data" action="./calls/modify_instagram.php">
                        <th scope="row">
                            <?=$post["id_elemento"]?>
                            <input type="hidden" name="id" value="<?=$post["id_elemento"]?>">
                        </th>
                        <td>
                            <input type="text" class="form-control" name="account" value="<?=$post["autor_elemento"]?>" placeholder="Inserire il nome dell'account" rows="3" required>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="title" maxlength="100" value="<?=$post["nombre_elemento"]?>" required>
                        </td>
                        <td>
                            <textarea class="form-control" name="text" rows="3"><?=$post["texto_elemento"]?></textarea>
                        </td>
                        <td>
                            <?=$post["recurso_elemento"]?>
                        </td>
                        <td>
                            <input type="file" class="form-control-file" name="picture" accept=".jpg,.jpeg">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary">Modifica</button>
                        </td>
                    </form>
                    <script>
                    // AJAX per submit
                    $("#form<?=$post["id_elemento"]?>").submit(function(e) {
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