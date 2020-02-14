<?php include_once "templates/head.php" ?>
<body>
	<?php include_once "templates/menu.php" ?>
	<div class="portada">
		<div class="center_1000">
			<h1 class="titulo_interno">CALENDARIO</h1>
			<div class="info_calendario">
				<div class="next_event">
					<h3>NEXT EVENT</h3>
					<div class="next_event_content">
						<div class="cont_fecha">
							<p>05</p>
							<p>GIUGNO</p>
						</div>
						<div class="cont_texto">
							<h4>INAUGURAZIONE</h4>
							<p class="mini_text">20hs - Mercado di Traiano</p>
							<p class="texto">Per scoprirlo "Con Live Museum, Live Change", la settimana scorsa abbiamo invitato due autori di Fabulamundi. Playwritting Europe per una residenza artistica.</p>
						</div>
					</div>
				</div>
				<div class="contenedor_calendario">

					<div class="calendario_mes">
						<button class="boton_calendario" id="previous" onclick="previous()"></button>
						<h3 id="mes_activo"></h3>
						<button class="boton_calendario" id="next" onclick="next()"></button>
					</div>
					<div class="calendario">
						<div class="container">
						    <div class="card">
						        <table class="table table-bordered table-responsive-sm" id="calendar">
						            <thead>
						            <tr>
						            	<th>DOM</th>
						                <th>LUN</th>
						                <th>MAR</th>
						                <th>MER</th>
						                <th>GIO</th>
						                <th>VEN</th>
						                <th>SAB</th>
						            </tr>
						            </thead>

						            <tbody id="calendar-body">

						            </tbody>
						        </table>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="calendario.js"></script>
<?php include_once "templates/footer.php" ?>