<?php
    session_start();
    if( !isset ( $_SESSION['id_user'] ) ){
        header("Location: index.php");
        exit();
    }
?>

<h3>Aggiunta di un post</h2>
<form action="panel_admin.php?submit=post" enctype="multipart/form-data" method="post">
    <div class="form-group">
        <label for="title">Titolo post</label>
        <input type="text" class="form-control" name="title" id="title" maxlength="100" required>
    </div>
    <div class="form-group">
        <label for="text">Testo del post</label>
        <textarea class="form-control" name="text" id="text" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="tags">Tags</label>
        <input type="text" class="form-control" name="tags" id="tags" placeholder="Inserire i tags, separati da una virgola" maxlength="100">
    </div>
    <div class="form-group">
        <label for="tags">Categoria</label>
        <select type="text" class="form-control" name="category" id="category" maxlength="100">
            <option name="Artista">Artista</option>
            <option name="Artista">Designer</option>
        </select>
    </div>
    <div class="form-group">
        <label for="pictures">Immagini (*.jpg)</label>
        <input type="file" class="form-control-file" name="picture" id="picture" accept=".jpg,.jpeg">
    </div>
    <button type="submit" class="btn btn-primary">Invia</button>
</form>