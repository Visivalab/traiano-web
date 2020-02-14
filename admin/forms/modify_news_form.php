<?php
    if( !isset ( $_SESSION['id_user'] ) ){
        header("Location: index.php");
        exit();
    }
?>
    <script src="/libraries/jquery-3.4.1.min.js"></script><?php
    // si mostrano notizie
    $query = "SELECT * FROM noticias";

    try {
        $sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    } catch(Exception $e) {
        var_dump($e->getMessage());
    }

    $result = $sth->execute();
    if($result) {
        $newsArray = $sth->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titolo</th>
                    <th>Testo</th>
                    <th colspan="2">Foto</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($newsArray as $news) {
                ?>
                <tr>
                    <form id="form<?=$news["id_noticia"]?>" method="POST" enctype="multipart/form-data" action="./calls/modify_news.php">
                        <th scope="row">
                            <?=$news["id_noticia"]?>
                            <input type="hidden" name="id" value="<?=$news["id_noticia"]?>">
                        </th>
                        <td>
                            <input type="text" class="form-control" name="title" maxlength="100" value="<?=$news["titulo_noticia"]?>" required>
                        </td>
                        <td>
                            <textarea class="form-control" name="text" rows="3"><?=$news["texto_noticia"]?></textarea>
                        </td>
                        <td>
                            <?=$news["foto_noticia"]?>
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
                    $("#form<?=$news["id_noticia"]?>").submit(function(e) {
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