<?php
require_once "llamadas/conexion.php";
include_once "templates/head.php" 
?>
<body class="fondo_negro">
	<?php include_once "templates/menu.php" ?>
	<div class="center_1000 content_showcase">
		<h1 class="titulo_interno">ATELIER D'ARTISTA</h1>
		<p>Questa sezione ospita i lavori degli artisti coinvolti nel progetto Live Museum, Live Change. Le opere prevedono il coinvolgimento artisti che utilizzano diverse forme espressive, dalla musica, alla drammaturgia, ma anche fotografia, performance e opere site specific. Interventi che promuovono il coinvolgimento delle comunità nei vari atelier con l’obiettivo di rendere il museo un luogo di relazione, di possibilità di fare esperienze, di sperimentazione artistica in costante dialogo e trasformazione.</p>
		<div id="content_atelier" class="showcase_content content_atelier content_showcase_interno">

        <?php
                $consulta = 
                "SELECT id_elemento,nombre_elemento,autor_elemento,subtitulo_elemento,texto_elemento,tags_elemento,category_elemento,link_elemento,recurso_elemento,tipo_elemento,NULL as id_grupo,NULL as titulo_grupo,NULL as tipo_grupo,NULL as autor_grupo,NULL as descripcion_grupo,NULL as imagen_grupo,fecha_elemento 
                FROM elementos 
                WHERE (tipo_elemento = 'galeria' OR tipo_elemento = 'post') AND show_always = 1
                UNION ALL
                SELECT NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,id_grupo,titulo_grupo,tipo_grupo,autor_grupo,descripcion_grupo,imagen_grupo,fecha_elemento 
                FROM grupos
                ORDER BY fecha_elemento";

                $elementos = $conn -> prepare($consulta);
                $elementos -> execute();
                $resultado = $elementos->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultado as $fila) {
                    if($fila['tipo_elemento']==null){
                    ?>
                        <a href='group_page.php?group=<?=$fila['id_grupo']?>' class='elemento_showcase elemento_creazioni elemento_size_video' data-id_elemento='<?=$fila['id_grupo']?>' style='background-image: url(elements/<?=$fila['imagen_grupo']?>)'>
                            <div class='background_gradient'></div>
                            <div class='informacion_elemento'>
                                <div class='texto_elemento'>
                                    <h1><?=$fila['titulo_grupo']?></h1>
                                    <p class='autor'><?=$fila['autor_grupo']?></p>
                                </div>
                            </div>
                        </a>
                    <?php  
                    }else{
                        if($fila['tipo_elemento']=='galeria'){
                    ?>
                            <a href='single_galeria.php?id=<?=$fila['id_elemento']?>' class='elemento_showcase elemento_creazioni elemento_size_video' data-id_elemento='<?=$fila['id_elemento']?>' style='background-image: url(elements/galerias/<?=$fila['recurso_elemento']?>)'>
                                <div class='background_gradient'></div>
                                <div class='informacion_elemento'>
                                    <h1><?=$fila['nombre_elemento']?></h1>
                                </div>
                            </a>
                    <?php   
                        }elseif($fila['tipo_elemento']=='post'){
                        ?>
                            <a href='single_post.php?id=<?=$fila['id_elemento']?>' class='elemento_showcase elemento_creazioni elemento_size_video' data-id_elemento='<?=$fila['id_elemento']?>' style='background-image: url(elements/<?=$fila['recurso_elemento']?>)'>
                                <div class='background_gradient'></div>
                                <div class='informacion_elemento'>
                                    <h1><?=$fila['nombre_elemento']?></h1>
                                </div>
                            </a>
                        <?php
                        }
                    }
                }
            ?>
		</div>
	</div>
</body>
<?php include_once "templates/footer.php" ?>