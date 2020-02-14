<?php
    if( !isset ( $_SESSION['id_user'] ) ){
        header("Location: index.php");
        exit();
    }
?>

<h3>Aggiunta di una galleria</h2>
<form action="panel_admin.php?submit=gallery" enctype="multipart/form-data" method="post">
    <small class="form-text text-muted">I campi contrassegnati da * sono obbligatori.</small>
    <div class="form-group">
        <label for="school">Scuola</label>
        <input type="text" class="form-control" name="school" id="school" placeholder="Inserire il nome della scuola" maxlength="15">
    </div>
    <div class="form-group">
        <label for="name">Nome*</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Inserire il nome del post" maxlength="100" required="true">
    </div>
    <div class="form-group">
        <label for="author">Autore*</label>
        <input type="text" class="form-control" name="author" id="author" placeholder="Inserire l'autore" maxlength="100" required="true">
    </div>
    <div class="form-group">
        <label for="subtitle">Sottotitolo</label>
        <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Inserire il sottotitolo" maxlength="60">
    </div>
    <div class="form-group">
        <label for="postContent">Testo del post</label>
        <textarea class="form-control" name="postContent" id="postContent" placeholder="Inserire il contenuto del post" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="tags">Tag</label>
        <input type="text" class="form-control" name="tags" id="tags" placeholder="Inserire i tags, separati da una virgola" maxlength="100">
    </div>
    <div class="form-group">
        <label for="pictures">Immagini (*.jpg)</label>
        <input type="file" class="form-control-file" name="pictures[]" id="pictures" accept=".jpg,.jpeg" required multiple>
    </div>
    
    <button type="submit" class="btn btn-primary">Invia</button>
</form>