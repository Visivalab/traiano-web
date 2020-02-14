<?php
    if( !isset ( $_SESSION['id_user'] ) ){
        header("Location: index.php");
        exit();
    }
?>

<h3>Aggiunta di un'anteprima di post Instagram</h2>
<form action="panel_admin.php?submit=instagram" enctype="multipart/form-data" method="post">
    <small class="form-text text-muted">I campi contrassegnati da * sono obbligatori.</small>
    <div class="form-group">
        <label for="title">Tag*</label>
        <input type="text" class="form-control" name="tag" id="tag" placeholder="Inserire il tag che si vuole visualizzare" maxlength="100" required>
    </div>
    <div class="form-group">
        <label for="account">Nome dell'account che ha pubblicato il post*</label>
        <input type="text" class="form-control" name="account" id="account" placeholder="Inserire il nome dell'account" rows="3" required>
    </div>
    <div class="form-group">
        <label for="title">Titolo del post*</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Inserire il titolo del post" maxlength="100" required>
    </div>
    <div class="form-group">
        <label for="link">Link al post*</label>
        <input type="url" class="form-control" name="link" id="link" placeholder="Inserire il link al post" maxlength="100" required>
    </div>
    <div class="form-group">
        <label for="picture">Immagine di anteprima (*.jpg)*</label>
        <input type="file" class="form-control-file" name="picture" id="picture" accept=".jpg,.jpeg" required>
    </div>
    <button type="submit" class="btn btn-primary">Invia</button>
</form>