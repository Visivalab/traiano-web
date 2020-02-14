<?php
require_once "conexion.php";

$array_all_elementos = array();
$pag = $_POST['pag'];
$tag = $_POST['tag'];
//$c = $_POST['c'];
//$elementos_saltados = $pag*$c;

if($tag=='none'){
	$consulta = "SELECT id_elemento,nombre_elemento,autor_elemento,subtitulo_elemento,texto_elemento,tags_elemento,link_elemento,recurso_elemento,tipo_elemento FROM elementos WHERE tipo_elemento = 'video' ORDER BY fecha_elemento DESC";
}else{
	$consulta = "SELECT id_elemento,nombre_elemento,autor_elemento,subtitulo_elemento,texto_elemento,tags_elemento,link_elemento,recurso_elemento,tipo_elemento FROM elementos WHERE (tipo_elemento = 'video') AND tags_elemento LIKE '%$tag%' ORDER BY fecha_elemento DESC";
}

$elementos = $conn -> prepare($consulta);
$elementos -> execute();
$resultado = $elementos->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado as $fila) {
	$array_all_elementos[] = array(
		'id_elemento' => $fila['id_elemento'],
		'nombre_elemento' => $fila['nombre_elemento'],
		'autor_elemento' => $fila['autor_elemento'],
		'subtitulo_elemento' => $fila['subtitulo_elemento'],
		'texto_elemento' => $fila['texto_elemento'],
		'tags_elemento' => $fila['tags_elemento'],
		'link_elemento' => $fila['link_elemento'],
		'recurso_elemento' => $fila['recurso_elemento'],
		'tipo_elemento' => $fila['tipo_elemento']
	);
}


echo json_encode($array_all_elementos);