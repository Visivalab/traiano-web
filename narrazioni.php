<?php 
require_once "llamadas/conexion.php";
include_once "templates/head.php";
?>
<body class="fondo_negro">
	<?php include_once "templates/menu.php" ?>
	<div class="center_1000 content_showcase">
		<h1 class="titulo_interno">NARRAZIONI</h1>
		<p>I laboratori di digital storytelling di Live Museum, Live Change, sono stati realizzati nell'ambito dei percorsi di alternanza scuola lavoro e hanno coinvolto tre scuole romane: il Liceo Classico Statale Dante Alighieri, il Liceo classico statale Terenzio Mamiani e l’IISS Roberto Rossellini. I digital storytelling hanno attivato nuove e più creative modalità di relazione con il Museo, nuove interpretazioni e storie del luogo. Un prodotto alternativo alla narrazione tradizionale che riesce a rinforzare le relazioni tra museo e visitatori e diventa al tempo stesso un’opportunità di formazione e scambio culturale. ll percorso si è sviluppato attraverso incontri in aula e visite ai Mercati di Traiano e ai quartieri limitrofi al sito. Le storie hanno preso forma durante gli incontri a scuola attraverso momenti di brainstorming e suggerimenti sulle tecniche di narrazione e scrittura creativa. Il percorso è stato strutturato per fornire le basi teoriche e pratiche per un uso consapevole della narrazione museale come risorsa di dialogo tra il museo e pubblico. Durante le visite al Museo, gli operatori hanno introdotto gli studenti alla storia e al patrimonio dei Mercati per poi essere lasciati liberi di esplorare, di creare un contatto e creare nuove narrazioni.</p>
		<div id="content_narrazioni" class="showcase_content content_narrazioni content_showcase_interno">
        
        
        <?php
            //Esto se repite exactamente igual en el index.php -> seccion Narrazioni. Provablemente se puede hacer mejor. CON PLANIFICACION DES DEL PRINCIPIO.
            $consulta = 
            "SELECT id_elemento,nombre_elemento,autor_elemento,subtitulo_elemento,texto_elemento,tags_elemento,link_elemento,recurso_elemento,tipo_elemento,show_always 
            FROM elementos 
            WHERE tipo_elemento = 'video' && show_always = 1
            ORDER BY fecha_elemento DESC";


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
</body>
<?php include_once "templates/footer.php" ?>