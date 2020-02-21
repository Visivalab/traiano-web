<?php
require_once "conexion.php";



$array_all_elementos = array();

$array_consultas = array(
	'consulta_videos' => "SELECT id_elemento,nombre_elemento,autor_elemento,subtitulo_elemento,link_elemento,recurso_elemento,tipo_elemento FROM elementos WHERE tipo_elemento = 'video' ORDER BY RAND() DESC LIMIT 3",
	'consulta_audio' => "SELECT id_elemento,nombre_elemento,autor_elemento,subtitulo_elemento,link_elemento,recurso_elemento,tipo_elemento FROM elementos WHERE tipo_elemento = 'audio' ORDER BY RAND() DESC LIMIT 2"
	//'consulta_evento' => "SELECT id_elemento,nombre_elemento,autor_elemento,subtitulo_elemento,link_elemento,recurso_elemento FROM elementos WHERE tipo_elemento == 'evento' ORDER BY fecha_elemento DESC LIMIT 1"
	//'consulta_instagram' => "SELECT id_elemento,nombre_elemento,autor_elemento,subtitulo_elemento,link_elemento,recurso_elemento FROM elementos WHERE tipo_elemento == 'instagram' ORDER BY fecha_elemento DESC LIMIT 2",
	//'consulta_twitter' => "SELECT id_elemento,nombre_elemento,autor_elemento,subtitulo_elemento,link_elemento,recurso_elemento FROM elementos WHERE tipo_elemento == 'twitter' ORDER BY fecha_elemento DESC LIMIT 2",
);
$consulta_noticias = "SELECT * FROM noticias WHERE destacada=1 ORDER BY fecha_noticia DESC LIMIT 1";

$noticias = $conn -> prepare($consulta_noticias);
$noticias -> execute();
$resultado_noticias = $noticias->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado_noticias as $fila) {
	$array_all_elementos[]= array(
		'id_elemento' => $fila['id_noticia'],
		'nombre_elemento' => $fila['titulo_noticia'],
		'recurso_elemento' => $fila['foto_noticia'],
		'tipo_elemento' => 'noticia'
	);
}

foreach ($array_consultas as $key => $consulta) {
	$elementos = $conn -> prepare($consulta);
	$elementos -> execute();
	$resultado = $elementos->fetchAll(PDO::FETCH_ASSOC);
	foreach ($resultado as $fila) {
		$array_all_elementos[] = array(
			'id_elemento' => $fila['id_elemento'],
			'nombre_elemento' => $fila['nombre_elemento'],
			'autor_elemento' => $fila['autor_elemento'],
			'subtitulo_elemento' => $fila['subtitulo_elemento'],
			'link_elemento' => $fila['link_elemento'],
			'recurso_elemento' => $fila['recurso_elemento'],
			'tipo_elemento' => $fila['tipo_elemento']
		);
	}
}

echo json_encode($array_all_elementos);