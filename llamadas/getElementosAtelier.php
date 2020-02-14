<?php
require_once "conexion.php";

$array_all_elementos = array();
$pag = $_POST['pag'];
$tag = $_POST['tag'];
$elementos_saltados = $pag*6;

//if($tag=='none'){
	$consulta = 
	"SELECT nombre_elemento,autor_elemento,subtitulo_elemento,texto_elemento,tags_elemento,link_elemento,recurso_elemento,tipo_elemento,NULL,NULL,NULL,fecha_elemento 
	FROM elementos 
	WHERE tipo_elemento = 'galeria' OR tipo_elemento = 'audio'
	UNION ALL
	SELECT NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,titulo_grupo,descripcion_grupo,imagen_grupo,fecha_elemento 
	FROM grupos
	ORDER BY fecha_elemento";
/*}else{
	$consulta = 
	"SELECT id_elemento,nombre_elemento,autor_elemento,subtitulo_elemento,texto_elemento,tags_elemento,link_elemento,recurso_elemento,tipo_elemento,titulo_grupo,descripcion_grupo,autor_grupo,imagen_grupo 
	FROM elementos,grupos 
	WHERE (elementos.tipo_elemento = 'galeria' OR elementos.tipo_elemento = 'audio') AND tags_elemento LIKE '%$tag%' 
	ORDER BY fecha_elemento";
}*/
$elementos = $conn -> prepare($consulta);
$elementos -> execute();
$resultado = $elementos->fetchAll(PDO::FETCH_ASSOC);
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
	$titulo_grupo = $fila['titulo_grupo'];
	$descripcion_grupo = $fila['descripcion_grupo'];
	$imagen_grupo = $fila['imagen_grupo'];
	if( $tipo_elemento ){
		$array_all_elementos[] = array(
			'id_elemento' => $id_elemento,
			'nombre_elemento' => $nombre_elemento,
			'autor_elemento' => $autor_elemento,
			'subtitulo_elemento' => $subtitulo_elemento,
			'texto_elemento' => $texto_elemento,
			'tags_elemento' => $tags_elemento,
			'link_elemento' => $link_elemento,
			'recurso_elemento' => $recurso_elemento,
			'tipo_elemento' => $tipo_elemento
		);
	}else{
		$array_all_elementos[] = array(
			'titulo_grupo' => $titulo_grupo,
			'descripcion_grupo' => $descripcion_grupo,
			'imagen_grupo' => $imagen_grupo
		);
	}
}
echo json_encode($array_all_elementos);