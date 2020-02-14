<?php 
require_once "llamadas/conexion.php";
include_once "templates/head.php";

$noticia = $_GET['noticia'];
$consulta_noticia = "SELECT * FROM noticias WHERE id_noticia=$noticia";

$noticia = $conn -> prepare($consulta_noticia);
$noticia -> execute();
$resultado_noticia = $noticia->fetchAll(PDO::FETCH_ASSOC); 

?>

<body class="fondo_negro">
	<?php include_once "templates/menu.php" ?>
	<div class="content_singleNew">
        <?php
        if(isset($resultado_noticia)){
            foreach ($resultado_noticia as $fila) {
                $originalDate = $fila['fecha_noticia'];
                $date = date("d M, Y", strtotime($originalDate));
                if(!empty($fila['foto_noticia'])){
                    echo "<img src='elements/noticias/".$fila['foto_noticia']."'>";
                }
        ?>
                <h1 class="titulo_interno"><?=$fila['titulo_noticia']?></h1>
                <div class="tags_fecha">
                    <?php
                        $consulta_tags_noticia = "SELECT nombre_tag FROM tags_noticias,link_tagsnoticias_noticias WHERE link_tagsnoticias_noticias.id_tag = tags_noticias.id_tag AND id_noticia = ".$fila['id_noticia'];
                        $tags_noticia = $conn -> prepare($consulta_tags_noticia);
                        $tags_noticia -> execute();
                        $resultado_tags_noticia = $tags_noticia->fetchAll(PDO::FETCH_ASSOC);
                        if(isset($resultado_tags_noticia)){
                            foreach ($resultado_tags_noticia as $fila_tag) {
                                echo "<a class='newsPortada_info_tags_tag' href='news.php?tag=".$fila_tag['nombre_tag']."'>".$fila_tag['nombre_tag']."</a>";
                            }
                        }
                    ?>
                    <p class="newsLista_info_fecha"><?=$date?></p>
                </div>
                <p><?=$fila['texto_noticia']?></p>
        <?php
            }
        }
        ?>
	</div>
</body>
<?php include_once "templates/footer.php" ?>