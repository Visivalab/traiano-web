<?php
require_once "llamadas/conexion.php";
/*Esto muestra grupos de elementos, por ejemplo si quieren mostrar unos audios en concreto agrupados con un título, y luego desde allí ir a cada audio.*/

$id_grupo = $_GET['group'];

$grupo = $conn->prepare("SELECT id_grupo,titulo_grupo,descripcion_grupo,autor_grupo,coverImage_grupo FROM grupos WHERE id_grupo = :id_grupo");
$grupo -> bindParam(':id_grupo',$id_grupo);
$grupo -> execute();
$resultado_grupo = $grupo->fetchAll(PDO::FETCH_ASSOC);

$elemento = $conn->prepare("SELECT * FROM elementos,link_grupos_elementos WHERE elementos.id_elemento = link_grupos_elementos.id_elemento AND link_grupos_elementos.id_grupo = :id_grupo");
$elemento -> bindParam(':id_grupo',$id_grupo);
$elemento -> execute();
$resultado_elementos = $elemento->fetchAll(PDO::FETCH_ASSOC);
?>
<?php include_once "templates/head.php" ?>
<body class="fondo_negro">
	<?php include_once "templates/menu.php" ?>
	<div class="center_1000 content_showcase">
		<section id="seccion_single" class="seccion mostrar">
			<div class="single_elemento_vista">
                <?php
                if($resultado_grupo[0]['coverImage_grupo']){
                ?>
                <div class="elemento_extra elemento_extra--top">
                    <img width="100%" src="elements/<?=$resultado_grupo[0]['coverImage_grupo']?>">
                </div>
                <?php
                }
                ?>

			<?php
            foreach ($resultado_elementos as $fila_el) {
                $id_elemento = $fila_el['id_elemento'];
                $titulo_elemento = $fila_el['nombre_elemento'];
                $descripcion_elemento = $fila_el['texto_elemento'];
                $autor_elemento = $fila_el['autor_elemento'];
                $recurso_elemento = $fila_el['recurso_elemento'];
                $tipo_elemento = $fila_el['tipo_elemento'];

                if($tipo_elemento=='audio'){
            ?>
                    <a href='single_audio.php?id=<?=$id_elemento?>' class='elemento_showcase elemento_showcase_group elemento_audio elemento_size_video' data-id_elemento='<?=$id_elemento?>'>
                        <div class='informacion_elemento'>
                            <img src='assets/icons/micro.svg' width='35px'>
                            <div class='texto_elemento'>
                                <h1><?=$titulo_elemento?></h1>
                                <!--<p class='autor'></p>-->
                            </div>
                        </div>
                    </a>
            <?php }else if($tipo_elemento=='video'){
                ?>
                    <a href='single_video.php?id=<?=$id_elemento?>' class='elemento_showcase elemento_showcase_group elemento_video elemento_size_video' data-id_elemento='<?=$id_elemento?>' style='background-image: url(elements/videos/<?=$recurso_elemento?>.png)'>
                        <div class='background_gradient'></div>
                        <div class='informacion_elemento'>
                            <img src='assets/icons/camera.svg' width='35px'>
                            <div class='texto_elemento'>
                                <h1><?=$titulo_elemento?></h1>
                                <p class='autor'><?=$autor_elemento?></p>
                            </div>
                        </div>
                    </a>
                <?php
                }else if($tipo_elemento=='galeria'){
                ?>
                    <a href='single_galeria.php?id=<?=$id_elemento?>' class='elemento_showcase elemento_showcase_group elemento_video elemento_size_video' data-id_elemento='<?=$id_elemento?>' style='background-image: url(elements/galerias/<?=$recurso_elemento?>)'>
                        <div class='background_gradient'></div>
                        <div class='informacion_elemento'>
                            <img src='assets/icons/gallery.svg' width='35px'>
                            <div class='texto_elemento'>
                                <h1><?=$titulo_elemento?></h1>
                                <p class='autor'><?=$autor_elemento?></p>
                            </div>
                        </div>
                    </a>
                <?php
                }
            } 
            ?>

			</div>
			<div class="single_elemento_info single_creacion">
            <?php
            foreach ($resultado_grupo as $fila) {
                $id_grupo = $fila['id_grupo'];
                $titulo_grupo = $fila['titulo_grupo'];
                $descripcion_grupo = $fila['descripcion_grupo'];
                $autor_grupo = $fila['autor_grupo'];
                //$imagen_grupo = $fila['imagen_grupo'];
            ?>
				<div class="info_important">
					<h1><?=$titulo_grupo?></h1>
					<p class="autor"><?=$autor_grupo?></p>
				</div>
				<p class="texto">
					<?=$descripcion_grupo?>
				</p>
			<?php } ?>
            </div>
		</section>
	</div>
</body>
<?php include_once "templates/footer.php" ?>