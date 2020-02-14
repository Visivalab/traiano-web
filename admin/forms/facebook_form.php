<?php
    if( !isset ( $_SESSION['id_user'] ) ){
        header("Location: index.php");
        exit();
    }
?>

<h3>Aggiunta di un'anteprima di post Facebook</h2>
<form action="panel_admin.php?submit=facebook" enctype="multipart/form-data" method="post">
    <small class="form-text text-muted">I campi contrassegnati da * sono obbligatori.</small>
    <div class="form-group">
        <label for="account">Nome dell'account che ha pubblicato il post*</label>
        <input type="text" class="form-control" name="account" id="account" placeholder="Inserire il nome dell'account" rows="3" required>
    </div>
    <div class="form-group">
        <label for="text">Testo del post*</label>
        <textarea class="form-control" name="text" id="text" placeholder="Inserire il contenuto del post" rows="3" required></textarea>
    </div>
    <div class="form-group">
        <label for="link">Link al post*</label>
        <input type="url" class="form-control" name="link" id="link" placeholder="Inserire il link al post" maxlength="100" required>
    </div>
    <button type="submit" class="btn btn-primary">Invia</button>
</form>