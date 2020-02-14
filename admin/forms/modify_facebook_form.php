<?php
    if( !isset ( $_SESSION['id_user'] ) ){
        header("Location: index.php");
        exit();
    }
?>
    <script src="/libraries/jquery-3.4.1.min.js"></script><?php
    // si mostrano notizie
    $query = "SELECT * FROM elementos WHERE tipo_elemento = 'facebook'";

    try {
        $sth = $conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    } catch(Exception $e) {
        var_dump($e->getMessage());
    }

    $result = $sth->execute();
    if($result) {
        $posts = $sth->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Autore post</th>
                    <th>Testo</th>
                    <th>Link</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($posts as $post) {
                ?>
                <tr>
                    <form id="form<?=$post["id_elemento"]?>" method="POST" enctype="multipart/form-data" action="./calls/modify_facebook.php">
                        <th scope="row">
                            <?=$audio["id_elemento"]?>
                            <input type="hidden" name="id" value="<?=$post["id_elemento"]?>">
                        </th>
                        <td>
                            <input type="text" class="form-control" name="account" value="<?=$post["autor_elemento"]?>" placeholder="Inserire il nome dell'account" rows="3" required>
                        </td>
                        <td>
                            <textarea class="form-control" name="text" placeholder="Inserire il contenuto del post" rows="3" required><?=$post["texto_elemento"]?></textarea>
                        </td>
                        <td>
                            <input type="url" class="form-control" name="link" value="<?=$post["link_elemento"]?>" placeholder="Inserire il link al post" maxlength="100" required>
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