<?php
    if( !isset ( $_SESSION['id_user'] ) ){
        header("Location: index.php");
        exit();
    }
?>

<nav>
  <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-single-tab" data-toggle="tab" href="#nav-single" role="tab" aria-controls="nav-single" aria-selected="true">Audio singolo</a>
    <a class="nav-item nav-link" id="nav-multiple-tab" data-toggle="tab" href="#nav-multiple" role="tab" aria-controls="nav-multiple" aria-selected="false">Più audio</a>
  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-single" role="tabpanel" aria-labelledby="nav-single-tab">
    <h3>Aggiunta di un post con audio</h2>
    <form action="panel_admin.php?submit=audio" enctype="multipart/form-data" method="post">
        <small class="form-text text-muted">I campi contrassegnati da * sono obbligatori.</small>
        <div class="form-group">
            <label for="school">Scuola</label>
            <input type="text" class="form-control" id="school" placeholder="Inserire il nome della scuola" maxlength="15">
        </div>
        <div class="form-group">
            <label for="name">Nome*</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Inserire il nome del post" maxlength="100" required>
        </div>
        <div class="form-group">
            <label for="author">Autore*</label>
            <input type="text" class="form-control" name="author" id="author" placeholder="Inserire l'autore" maxlength="100" required>
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
            <label for="audioFile">File audio</label>
            <input type="file" class="form-control-file" name="audioFile" id="audioFile" accept=".mp3" required>
        </div>
        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
</div>
  <div class="tab-pane fade" id="nav-multiple" role="tabpanel" aria-labelledby="nav-multiple-tab">
    <!-- Creazione gruppo -->
    <h3>Aggiunta di un gruppo di contenuti audio</h2>
    <form action="panel_admin.php?submit=audio_group" enctype="multipart/form-data" method="post">
        <div class="form-group">
            <label for="groupTitle">Titolo del gruppo di audio*</label>
            <input type="text" class="form-control" name="groupTitle" id="groupTitle" placeholder="Inserire il titolo" maxlength="100" required>
        </div>
        <div class="form-group">
            <label for="groupDescription">Testo del post*</label>
            <textarea class="form-control" name="groupDescription" id="groupDescription" placeholder="Inserire la descrizione del gruppo di audio" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="groupAuthor">Autore*</label>
            <input type="text" class="form-control" name="groupAuthor" id="groupAuthor" placeholder="Inserire l'autore" maxlength="100" required>
        </div>


        <div class="dynamic-stuff">
            <!-- Dynamic element will be cloned here -->
            <!-- You can call clone function once if you want it to show it a first element-->
        </div>
        
        <!-- Button -->
        <div class="form-group">
            <div class="col-md-12">
                <p class="add-one">+ Aggiungi audio</p>
            </div>
        </div>
        

        <!-- INIZIO WIP -->

        <!-- HIDDEN DYNAMIC ELEMENT TO CLONE -->
        <!-- you can replace it with any other elements -->
        <div class="form-group dynamic-element" style="display:none">
            <h4>File audio</h4>
            <div class="form-group">
                <label for="school">Scuola</label>
                <input type="text" class="form-control" name="school[]" id="school" placeholder="Inserire il nome della scuola" maxlength="15">
            </div>
            <div class="form-group">
                <label for="name">Nome*</label>
                <input type="text" class="form-control" name="name[]" id="name" placeholder="Inserire il nome del post" maxlength="100">
            </div>
            <div class="form-group">
                <label for="author">Autore*</label>
                <input type="text" class="form-control" name="author[]" id="author" placeholder="Inserire l'autore" maxlength="100">
            </div>
            <div class="form-group">
                <label for="postContent">Testo del post</label>
                <textarea class="form-control" name="postContent[]" id="postContent" placeholder="Inserire il contenuto del post" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="tags">Tag</label>
                <input type="text" class="form-control" name="tags[]" id="tags" placeholder="Inserire i tags, separati da una virgola" maxlength="100">
            </div>
            <div class="form-group">
                <label for="audioFile">File audio</label>
                <input type="file" class="form-control-file" name="audioFile[]" id="audioFile" accept=".mp3">
            </div>
                <!-- End of fields-->
            <div class="col-md-1">
                <p class="delete">x</p>
            </div>
        </div>
        <!-- END OF HIDDEN ELEMENT -->


        <!-- FINE WIP -->
        
        <button type="submit" class="btn btn-primary">Invia</button>
    </form>
  </div>
</div>