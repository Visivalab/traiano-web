<?php
require_once "llamadas/conexion.php";
include_once "templates/head.php";
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

$miniatura = $conn->prepare("SELECT id_link_galeria,id_galeria,nombre_imagen,ruta_imagen FROM link_imagenes_galeria WHERE id_galeria = :id");
$miniatura -> bindParam(':id',$id);
$miniatura -> execute();
$miniaturas = $miniatura->fetchAll(PDO::FETCH_ASSOC);

//Esto ahora solo esta pensado para meter videos encima de galerias
//Aquí busca el id actual (en este caso la galeria), y agarra el id y la posicion del elemento_2, que luego usaremos para pintarlo en la posición que sea
$elemento_extra = $conn->prepare("SELECT id_elemento_1,id_elemento_2,posicion_elemento_2,id_elemento,nombre_elemento,recurso_elemento 
FROM link_elemento_extra 
LEFT JOIN elementos 
ON link_elemento_extra.id_elemento_2 = elementos.id_elemento WHERE link_elemento_extra.id_elemento_1 = :id");

$elemento_extra -> bindParam(':id',$id);
$elemento_extra -> execute();
$elementos_extra = $elemento_extra->fetchAll(PDO::FETCH_ASSOC);
?>
<body class="fondo_negro">
	<?php include_once "templates/menu.php" ?>
	<div class="center_1000 content_showcase">

		<section id="seccion_single" class="seccion mostrar">
			
			<div class="single_elemento_vista">
				<?php
					foreach($elementos_extra as $key=>$elemento){
				?>
					<div class="elemento_extra elemento_extra--top">
						<video id="video_<?=$key?>" width="100%" height="auto" controls="" controlslist="nodownload">
							<source src="elements/videos/<?=$elemento[recurso_elemento]?>.mp4" type="video/mp4">
						</video>
					</div>
				<?php
					}
				?>

				<img class="imagen_creaciones" src="elements/galerias/<?=$miniaturas[0]["ruta_imagen"]?>" width="100%" height="auto">
				<div class="miniaturas_galeria">
					<?php
					foreach ($miniaturas as $fila) {
						echo "<div class='miniatura_galeria miniatura_$fila[id_galeria]' data-ruta='$fila[ruta_imagen]' style='background-image: url(elements/galerias/$fila[ruta_imagen])'></div>";
					}
					?>
				</div>
			</div>
			<div class="single_elemento_info single_creacion">
				<div class="info_important">
					<h1><?=$nombre_elemento?></h1>
					<p class="autor"><?=$autor_elemento?></p>
				</div>
				<p class="texto">
					<?=$texto_elemento?>
				</p>
			</div>
		</section>
	</div>
</body>
<?php include_once "templates/footer.php" ?>