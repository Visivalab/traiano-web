<?php 
require_once "llamadas/conexion.php";
include_once "templates/head.php";

$busqueda = $_POST["buscador"];
?>
<body class="fondo_negro">
	<?php include_once "templates/menu.php" ?>
	<div class="center_1000 content_showcase">
		<h1 class="titulo_interno">Ricerca: <?=$busqueda?></h1>
        <form id="form_buscador" class="buscador_intern" method="POST" action="search.php">
            <input class="expositorio_buscador" type="text" name="buscador" placeholder="Nuova ricerca">
            <input class="buscador_submit" type="submit" value="">
        </form>
        <div id="content_narrazioni" class="showcase_content content_narrazioni content_showcase_interno">
        
        
        <?php
            $consulta_nombre = "SELECT * FROM elementos WHERE nombre_elemento LIKE '%$busqueda%'";
            $consulta_interna = "SELECT * FROM elementos WHERE (subtitulo_elemento LIKE '%$busqueda%' OR texto_elemento LIKE '%$busqueda%')";
            $consulta_autor = "SELECT * FROM elementos WHERE autor_elemento LIKE '%$busqueda%'";
            $consulta_tag = "SELECT * FROM elementos WHERE tags_elemento LIKE '%$busqueda%'";

            $elementos_nombre = $conn -> prepare($consulta_nombre);
            $elementos_nombre -> execute();
            $resultado_nombre = $elementos_nombre->fetchAll(PDO::FETCH_ASSOC);

            $elementos_interno = $conn -> prepare($consulta_interna);
            $elementos_interno -> execute();
            $resultado_interno = $elementos_interno->fetchAll(PDO::FETCH_ASSOC);

            $elementos_autor = $conn -> prepare($consulta_autor);
            $elementos_autor -> execute();
            $resultado_autor = $elementos_autor->fetchAll(PDO::FETCH_ASSOC);

            $elementos_tag = $conn -> prepare($consulta_tag);
            $elementos_tag -> execute();
            $resultado_tag = $elementos_tag->fetchAll(PDO::FETCH_ASSOC);

            function variables_elemento($tipo_elemento,$elemento){
                if($elemento == 'icono'){
                    if($tipo_elemento=='audio'){
                        return "audio";
                    }else if($tipo_elemento=='video'){
                        return "camera";
                    }else if($tipo_elemento=='galeria'){
                        return "gallery";
                    }
                }
                if($elemento == 'contenedor'){
                    if($tipo_elemento=='audio'){
                        return "elemento_audio";
                    }else if($tipo_elemento=='video'){
                        return "elemento_video";
                    }else if($tipo_elemento=='galeria'){
                        return "elemento_creazioni";
                    }
                }
            }
            if($resultado_nombre){
                echo "<p class='titulo_seccion_busqueda'>+ Ci sono coincidenze nel <strong>NOME</strong> - ".$elementos_nombre->rowCount()."</p>";
                echo "<div class='desplegable_buscador desplegado'>";
                foreach ($resultado_nombre as $fila) {
        ?>
                <a href='single_video.php?id=<?=$fila['id_elemento']?>' class='elemento_showcase <?=variables_elemento($fila['tipo_elemento'],'contenedor')?> elemento_size_video' data-id_elemento='<?=$fila['id_elemento']?>' style='background-image: url(elements/videos/<?=$fila['recurso_elemento']?>.png)'>
                    <div class='background_gradient'></div>
                    <div class='informacion_elemento'>
                        <img src='assets/icons/<?=variables_elemento($fila['tipo_elemento'],'icono')?>.svg' width='35px'>
                        <div class='texto_elemento'>
                            <h1><?=$fila['nombre_elemento']?></h1>
                            <p class='autor'><?=$fila['autor_elemento']?></p>
                        </div>
                    </div>
                </a>
        <?php
                }
                echo "</div>";
            }
            if($resultado_autor){
                echo "<p class='titulo_seccion_busqueda'>+ Ci sono coincidenze nell'<strong>AUTORE</strong> - ".$elementos_autor->rowCount()."</p>";
                echo "<div class='desplegable_buscador desplegado'>";
                foreach ($resultado_autor as $fila) {
                    ?>
                            <a href='single_video.php?id=<?=$fila['id_elemento']?>' class='elemento_showcase <?=variables_elemento($fila['tipo_elemento'],'contenedor')?> elemento_size_video' data-id_elemento='<?=$fila['id_elemento']?>' style='background-image: url(elements/videos/<?=$fila['recurso_elemento']?>.png)'>
                                <div class='background_gradient'></div>
                                <div class='informacion_elemento'>
                                    <img src='assets/icons/<?=variables_elemento($fila['tipo_elemento'],'icono')?>.svg' width='35px'>
                                    <div class='texto_elemento'>
                                        <h1><?=$fila['nombre_elemento']?></h1>
                                        <p class='autor'><?=$fila['autor_elemento']?></p>
                                    </div>
                                </div>
                            </a>
                    <?php
                }
                echo "</div>";
            }
            if($resultado_tag){
                echo "<p class='titulo_seccion_busqueda'>+ Ci sono coincidenze nel TAG - ".$elementos_tag->rowCount()."</p>";
                echo "<div class='desplegable_buscador desplegado'>";
                foreach ($resultado_tag as $fila) {
                    ?>
                            <a href='single_video.php?id=<?=$fila['id_elemento']?>' class='elemento_showcase <?=variables_elemento($fila['tipo_elemento'],'contenedor')?> elemento_size_video' data-id_elemento='<?=$fila['id_elemento']?>' style='background-image: url(elements/videos/<?=$fila['recurso_elemento']?>.png)'>
                                <div class='background_gradient'></div>
                                <div class='informacion_elemento'>
                                    <img src='assets/icons/<?=variables_elemento($fila['tipo_elemento'],'icono')?>.svg' width='35px'>
                                    <div class='texto_elemento'>
                                        <h1><?=$fila['nombre_elemento']?></h1>
                                        <p class='autor'><?=$fila['autor_elemento']?></p>
                                    </div>
                                </div>
                            </a>
                    <?php
                }
                echo "</div>";
            }
            if($resultado_interno){
                echo "<p class='titulo_seccion_busqueda'>+ Ci sono coincidenze nel <strong>CONTENUTO INTERNO</strong> - ".$elementos_interno->rowCount()."</p>";
                echo "<div class='desplegable_buscador desplegado'>";
                foreach ($resultado_interno as $fila) {
                    ?>
                            <a href='single_video.php?id=<?=$fila['id_elemento']?>' class='elemento_showcase <?=variables_elemento($fila['tipo_elemento'],'contenedor')?> elemento_size_video' data-id_elemento='<?=$fila['id_elemento']?>' style='background-image: url(elements/videos/<?=$fila['recurso_elemento']?>.png)'>
                                <div class='background_gradient'></div>
                                <div class='informacion_elemento'>
                                    <img src='assets/icons/<?=variables_elemento($fila['tipo_elemento'],'icono')?>.svg' width='35px'>
                                    <div class='texto_elemento'>
                                        <h1><?=$fila['nombre_elemento']?></h1>
                                        <p class='autor'><?=$fila['autor_elemento']?></p>
                                    </div>
                                </div>
                            </a>
                    <?php
                }
                echo "</div>";
            }
            
        ?>


		</div>
	</div>
</body>
<?php include_once "templates/footer.php" ?>