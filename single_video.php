<?php
require_once "llamadas/conexion.php";

$id = $_GET['id'];

$info = $conn->prepare("SELECT id_elemento,nombre_elemento,autor_elemento,subtitulo_elemento,texto_elemento,tags_elemento,link_elemento,recurso_elemento,tipo_elemento,fecha_elemento FROM elementos WHERE id_elemento = :id");
$info -> bindParam(':id',$id);
$info -> execute();
$resultado = $info->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado as $fila) {
		$id_elemento = $fila['id_elemento'];
		$nombre_elemento = $fila['nombre_elemento'];
		$autor_elemento = $fila['autor_elemento'];
		$subtitulo_elemento = $fila['subtitulo_elemento'];
		$texto_elemento = $fila['texto_elemento'];
		$tags_elemento = $fila['tags_elemento'];
		$link_elemento = $fila['link_elemento'];
		$recurso_elemento = $fila['recurso_elemento'];
		$tipo_elemento = $fila['tipo_elemento'];
}

?>
<?php include_once "templates/head.php" ?>
<body class="fondo_negro">
	<?php include_once "templates/menu.php" ?>
	<div class="center_1000 content_showcase">
		<!--<h1 class="titulo_interno">TITULO</h1>-->
		<section id="seccion_single" class="seccion mostrar">
			<div class="single_elemento_vista">
				<video id="video" width="100%" height="auto" controls="" controlslist="nodownload">
					<source src="elements/videos/<?=$recurso_elemento?>.mp4" type="video/mp4">
				</video>
			</div>
			<div class="single_elemento_info single_video">
				<div class="info_important">
					<h1><?=$nombre_elemento?></h1>
					<p class="autor"><?=$autor_elemento?></p>
					<?php if($tags_elemento != ''){ ?>
                        <span class='tag' data-tag='liceo dante'><?=$tags_elemento?></span>
                    <?php } ?>
				</div>
				<p class="texto"><?=$texto_elemento?></p>
			</div>
		</section>


	</div>
</body>
<?php include_once "templates/footer.php" ?>