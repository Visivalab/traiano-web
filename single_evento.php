<?php 
$id = $_GET['id'];
//Pillar la info del video y cargarla en el contenido
?>
<?php include_once "templates/head.php" ?>
<body class="fondo_negro">
	<?php include_once "templates/menu.php" ?>
	<div class="center_1000 content_showcase">
		<h1 class="titulo_interno">TITULO</h1>


		<section id="seccion_single" class="seccion mostrar">
			<div class="single_elemento_vista">
				<video id="video" width="100%" height="auto" controls="" controlslist="nodownload">
					<source src="elements/videos/LAMAGIADEIMERCATI.mp4" type="video/mp4">
				</video>
			</div>
			<div class="single_elemento_info single_video">
				<div class="info_important">
					<h1>LA MAGIA DEI MERCATI</h1>
					<p class="autor">Martina Valenti</p>
					<span class="tag" data-tag="liceo dante">liceo dante</span>
				</div>
				<p class="texto"></p>
			</div>
		</section>


	</div>
</body>
<?php include_once "templates/footer.php" ?>