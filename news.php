<?php 
require_once "llamadas/conexion.php";
include_once "templates/head.php";

if(isset($_GET['buscador'])){
    $busqueda_palabra = $_GET['buscador'];
    $consulta_noticias = "SELECT * FROM noticias WHERE titulo_noticia LIKE '%$busqueda_palabra%' ORDER BY fecha_noticia DESC";
}else if(isset($_GET['tag'])){
    $busqueda_tag = $_GET['tag'];
    $consulta_noticias = "SELECT * 
                            FROM noticias,tags_noticias,link_tagsnoticias_noticias 
                            WHERE tags_noticias.id_tag = link_tagsnoticias_noticias.id_tag AND link_tagsnoticias_noticias.id_noticia = noticias.id_noticia AND tags_noticias.id_tag = $busqueda_tag ORDER BY fecha_noticia DESC";
}else{
    $consulta_portada = "SELECT * FROM noticias ORDER BY fecha_noticia DESC LIMIT 1";
    $consulta_noticias = "SELECT * FROM noticias ORDER BY fecha_noticia DESC LIMIT 1,12";

    $elementos_portada = $conn -> prepare($consulta_portada);
    $elementos_portada -> execute();
    $resultado_portada = $elementos_portada->fetchAll(PDO::FETCH_ASSOC); 
}
$elementos_noticias = $conn -> prepare($consulta_noticias);
$elementos_noticias -> execute();
$resultado_noticias = $elementos_noticias->fetchAll(PDO::FETCH_ASSOC);
?>

<body class="fondo_noticias">
	<?php include_once "templates/menu.php" ?>
	<div class="center_1000 content_news">
        
        <a href="news.php"><h1 class="titulo_interno">News/Blog</h1></a>
        
        <form class="buscador_news" method="GET">
            <input class="expositorio_buscador" type="text" name="buscador">
            <input class="buscador_submit" type="submit" value="">
        </form>

        <div class="lista_tags">
        
        <?php
            $consulta_tags = "SELECT id_tag, nombre_tag, show_tag FROM tags_noticias";
            $tags = $conn -> prepare($consulta_tags);
            $tags -> execute();
            $resultado_tags = $tags->fetchAll(PDO::FETCH_ASSOC);
            if(isset($resultado_tags)){
                foreach ($resultado_tags as $fila) {
                    echo "<a href='news.php?tag=".$fila['id_tag']."'>".$fila['nombre_tag']."</a>";
                }
            }
        ?>
        
        </div>

        <div class="seccionNoticias">
            <?php
            if(isset($resultado_portada)){
                foreach ($resultado_portada as $fila) {
                    $originalDate = $fila['fecha_noticia'];
                    $date = date("d M, Y", strtotime($originalDate));
            ?>
                    <div class="newsPortada">
                    <?php
                    if(!empty($fila['foto_noticia'])){
                        echo "<a href='single_noticia.php?noticia=".$fila['id_noticia']."'><div class='newsPortada_foto' style='background-image:url(elements/noticias/".$fila['foto_noticia']."'></div></a>";
                    }
                    ?>
                        <div class="newsPortada_info">
                            <a href="single_noticia.php?noticia=<?=$fila['id_noticia']?>"><h1><?=$fila['titulo_noticia']?></h1></a>
                            <p class="newsPortada_info_fecha"><?=$date?></p>
                            <p class="newsPortada_info_texto"><?=substr($fila['texto_noticia'], 0, 250);?>...</p>
                            <div class="newsPortada_info_tags">
                                <?php
                                    $consulta_tags_noticia = "SELECT tags_noticias.id_tag,nombre_tag 
                                                                FROM tags_noticias,link_tagsnoticias_noticias 
                                                                WHERE link_tagsnoticias_noticias.id_tag = tags_noticias.id_tag 
                                                                    AND id_noticia = ".$fila['id_noticia'];
                                    $tags_noticia = $conn -> prepare($consulta_tags_noticia);
                                    $tags_noticia -> execute();
                                    $resultado_tags_noticia = $tags_noticia->fetchAll(PDO::FETCH_ASSOC);
                                    if(isset($resultado_tags_noticia)){
                                        foreach ($resultado_tags_noticia as $fila) {
                                            echo "<a class='newsPortada_info_tags_tag' href='news.php?tag=".$fila['id_tag']."'>".$fila['nombre_tag']."</a>";
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

            <div class="listaNoticias">
            <?php
            if($resultado_noticias){
                foreach ($resultado_noticias as $fila) {
                    $originalDate = $fila['fecha_noticia'];
                    $date = date("d M, Y", strtotime($originalDate));
            ?>
                    <div class="singleNoticia">
                        <a href="single_noticia.php?noticia=<?=$fila['id_noticia']?>"><div class="newsLista_foto" style="background-image:url(elements/noticias/<?=$fila['foto_noticia']?>)"></div></a>
                        <div class="newsLista_info">
                        <a href="single_noticia.php?noticia=<?=$fila['id_noticia']?>"><h1><?=$fila['titulo_noticia']?></h1></a>
                            <p class="newsLista_info_fecha"><?=$date?></p>
                            <p class="newsLista_info_texto"><?=substr($fila['texto_noticia'], 0, 100);?>...</p>
                            <div class="newsLista_info_tags">
                                <?php
                                    $consulta_tags_noticia = "SELECT tags_noticias.id_tag,nombre_tag FROM tags_noticias,link_tagsnoticias_noticias WHERE link_tagsnoticias_noticias.id_tag = tags_noticias.id_tag AND id_noticia = ".$fila['id_noticia'];
                                    $tags_noticia = $conn -> prepare($consulta_tags_noticia);
                                    $tags_noticia -> execute();
                                    $resultado_tags_noticia = $tags_noticia->fetchAll(PDO::FETCH_ASSOC);
                                    if(isset($resultado_tags_noticia)){
                                        foreach ($resultado_tags_noticia as $fila_tag) {
                                            echo "<a class='newsPortada_info_tags_tag' href='news.php?tag=".$fila_tag['id_tag']."'>".$fila_tag['nombre_tag']."</a>";
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
            </div>

        </div>

	</div>
</body>
<?php include_once "templates/footer.php" ?>