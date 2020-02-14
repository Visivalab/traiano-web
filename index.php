<?php 
require_once "llamadas/conexion.php";
include_once "templates/head.php";
?>
<body>

    <?php include_once "templates/menu.php" ?>

    <section class="expositorio">
        <div class="fondo_expositorio"></div>
        <div class="expositorio_desktop">
            <div class="elementos_expositorio">
                <img class="expositorio_logo" src="assets/logos/logo_liveMuseum-big.svg">
            </div>
            <div class="fondo_negro_fullscreen">
                <div class="cerrar_fondo_negro">
                    <a href="#" class="go_element">vai al contenuto</a>
                </div>
            </div>
            <div class="elementos_destacados"></div>
        </div>
        <!--<div class="expositorio_mobile">
        
        </div>-->
        <form id="form_buscador" method="POST" action="search.php">
            <input class="expositorio_buscador" type="text" name="buscador">
            <input class="buscador_submit" type="submit" value="">
        </form>
    </section>

    <section class="fondos_content fondo_calendario_blog">
        <!--<div class="fondo_calendario fondo_mitad_calendario">
            <div class="mitad mitad_calendario">
                <a href="calendario.php">Calendario</a>
                <div class="content_mitad">
                    <div class="fecha_mitad">
                        <div class="cont_fecha">
                            <p>05</p>
                            <p>GIUGNO</p>
                        </div>
                    </div>
                    <div class="texto_mitad">
                        <div>
                            <h3>Inaugurazione</h3>
                            <p class="mini_text">20hs - Mercado di Traiano</p>
                        </div>
                        <div>
                            <p class="texto">Per scoprirlo "Con Live Museum, Live Change", la settimana scorsa abbiamo invitato due autori di Fabulamundi. Playwritting Europe per una residenza artistica.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->

        <?php
        $consulta_portada = "SELECT * FROM noticias ORDER BY fecha_noticia DESC LIMIT 1";

        $elementos_portada = $conn -> prepare($consulta_portada);
        $elementos_portada -> execute();
        $resultado_portada = $elementos_portada->fetch(PDO::FETCH_ASSOC); 
        ?>

        <div class="fondos_content fondo_calendario fondo_mitad_calendario_blog">
            <div class="mitad mitad_blog">
                <a href="news.php"><h3>News</h3></a>
                <div class="content_centered">
                    <a href="single_noticia.php?noticia=<?=$resultado_portada['id_noticia']?>">
                        <img class="content_centered__cont_foto" src="elements/noticias/<?=$resultado_portada['foto_noticia']?>"> 
                    </a>
                    <div class="content_centered__cont_texto">
                        <div>
                            <a href="single_noticia.php?noticia=<?=$resultado_portada['id_noticia']?>">
                                <h3><?=$resultado_portada['titulo_noticia']?></h3>
                            </a>
                        </div>
                        <div>
                            <p class="texto"><?=substr($resultado_portada['texto_noticia'],0,250).'...'?></p>
                        </div>
                    </div>
                    <a href="single_noticia.php?noticia=<?=$resultado_portada['id_noticia']?>" class="boton">Vedi notizie</a>
                </div>
            </div>
        </div>
    </section>

    <section class="fondos_content fondo_showcase">
        <div class="center_content showcase">
            <div class="showcase_narrazioni">
                <a href="narrazioni.php" class="showcase_titulo">Narrazioni</a>
                <div id="content_narrazioni" class="showcase_content content_narrazioni">
                    <div class="pag prev_pag" data-seccion="narrazioni" data-tag="none"></div>
                    <div class="content_elements_fix">
                        <div class="content_elements content_elements_narrazioni">

                        <?php
                            //Esto se repite exactamente igual en narrazioni.php. Se puede hacer mejor. CON PLANIFICACION DES DEL PRINCIPIO.
                            $consulta = 
                            "SELECT id_elemento,nombre_elemento,autor_elemento,subtitulo_elemento,texto_elemento,tags_elemento,link_elemento,recurso_elemento,tipo_elemento,show_always 
                            FROM elementos 
                            WHERE tipo_elemento = 'video' && show_always = 1
                            /*ORDER BY fecha_elemento DESC*/
                            ORDER BY RAND()";


                            $elementos = $conn -> prepare($consulta);
                            $elementos -> execute();
                            $resultado = $elementos->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($resultado as $fila) {
                        ?>
                                <a href='single_video.php?id=<?=$fila['id_elemento']?>' class='elemento_showcase elemento_video elemento_size_video' data-id_elemento='<?=$fila['id_elemento']?>' style='background-image: url(elements/videos/<?=$fila['recurso_elemento']?>.png)'>
                                    <div class='background_gradient'></div>
                                    <div class='informacion_elemento'>
                                        <img src='assets/icons/camera.svg' width='35px'>
                                        <div class='texto_elemento'>
                                            <h1><?=$fila['nombre_elemento']?></h1>
                                            <p class='autor'><?=$fila['autor_elemento']?></p>
                                        </div>
                                    </div>
                                </a>
                        <?php
                            }
                        ?>

                        </div>
                    </div>  
                    <div class="pag next_pag" data-seccion="narrazioni" data-tag="none"></div>
                </div>
                <a class="ir_contenido" href="narrazioni.php">Vedi tutto</a>
            </div>
            <div class="showcase_atelier">
                <a href="atelier.php" class="showcase_titulo">Atelier d'artisti</a>
                <div id="content_atelier" class="showcase_content content_atelier">
                    <div class="pag prev_pag" data-seccion="atelier" data-tag="none"></div>
                    <div class="content_elements_fix">
                        <div class="content_elements content_elements_atelier">
                            
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
                    <div class="pag next_pag" data-seccion="atelier" data-tag="none"></div> 
                </div>
                <a class="ir_contenido" href="atelier.php">Vedi tutto</a>
            </div>
        </div>
    </section>

    <section class="fondos_content fondo_partners">
        <div class="center_content partners">
            <h4>intervento realizzato da</h4>
            <div class="lista_partners">
                <img src="assets/logos/logo_pav.jpg">
            </div>
            <h4>grazie alla collaborazione con</h4>
            <div class="lista_partners">
                <img src="assets/logos/logo_rc.jpg">
                <img src="assets/logos/logo_mc.jpg">
            </div>
            <h4>in network con</h4>
            <div class="lista_partners">
                <img src="assets/logos/logo_eccom.png">
                <img src="assets/logos/logo_mep.png">
                <img src="assets/logos/logo_visivalab.png">
            </div>
        </div>  
    </section>

</body>
<?php include_once "templates/footer.php" ?>