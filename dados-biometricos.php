<!-- DOCTYPE HTML e tag <head> -->
<?php include 'includes/header.php' ?>
<?php print_r($_SESSION); ?>
<!-- - - - - - - - - - - - - - - - -->

<title>SmartWalk - Dados Biométricos</title>
<!-- Load c3.css -->
<link rel="stylesheet" href="css/dados-biometricos.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css">
<link rel="stylesheet" href="lib/datetimepicker/css/bootstrap-datetimepicker.min.css" />
<!-- script JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="lib/xepOnline/xepOnline.jqPlugin.js"></script>


</head>

<body>

	<div id="wrapper">

		<!-- top-menu e menu lateral -->
		<?php include 'includes/nav.php';?>
		<!-- - - - - - - - - - - - - - - - -->

		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<h1 class="page-header">Dados Biométricos</h1>
					<div class="col-xs-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Frequência Cardiaca <img src="img/Very-Basic-Info-icon.png" alt="imagem" style="width:20px; height:20px" title="A frequência cardíaca é o número de batimentos cardíacos por unidade de tempo. Pode ser medida manualmente (através da deteção da pulsação arterial em qualquer lugar do corpo), através de monitores cardíacos ou eletrocardiograma. ">
								<button type="button" class="btn btn-primary btn-xs pull-right" onclick="window.open('script/get-pdf-db-fc.php')">Exportar como PDF</button>
							</div>
							<div class="panel-body">
								<div class="col-xs-2" id="insertFC" style="margin-bottom: 10px;padding-left: 0px;">
									<button id="editable-sample_new" class="btn green" data-toggle="modal" data-target="#introduzir-fc">Adicionar registo <i class="fa fa-plus"></i></button>
								</div>
								<div class="col-xs-4" id="pagination" style="padding:0;float:right;">
									<ul class="pagination" style="margin:0px;float:right;">
										<li><a href="#" onclick="show(1,10);">1</a></li>
										<li><a href="#" onclick="show(11,20);">2</a></li>
										<li><a href="#" onclick="show(21,30);">3</a></li>
										<li><a href="#" onclick="show(31,40);">4</a></li>
										<li><a href="#" onclick="show(41,50);">5</a></li>
									</ul>
								</div>
								<table id="tabledit" class="table-bordered table-striped table">
									<thead>
										<tr>
											<th>ID</th>
											<th>Data/Hora</th>
											<th>Frequencia Cardíaca</th>
											<th>Responsável</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Tensão Arterial <img src="img/Very-Basic-Info-icon.png" alt="imagem" style="width:20px; height:20px" title="A tensão arterial refere-se à pressão exercida pelo sangue contra a parede das artérias. É possível fazer a sua medição com um aparelho digital, esfigmomanômetro ou pelo pulso.">
								<button type="button" class="btn btn-primary btn-xs pull-right" onclick="window.open('script/get-pdf-db-ta.php')">Exportar como PDF</button>
							</div>
							<div class="panel-body">
								<div class="col-xs-2" id="insertTA" style="margin-bottom: 10px;padding-left: 0px;">
									<button id="editable-sample_new" class="btn green" data-toggle="modal" data-target="#introduzir-ta">Adicionar registo <i class="fa fa-plus"></i></button>
								</div>
								<div class="col-xs-4" id="pagination" style="padding:0;float:right;">
									<ul class="pagination" style="margin:0px;float:right;">
										<li><a href="#" onclick="show(1,10);">1</a></li>
										<li><a href="#" onclick="show(11,20);">2</a></li>
										<li><a href="#" onclick="show(21,30);">3</a></li>
										<li><a href="#" onclick="show(31,40);">4</a></li>
										<li><a href="#" onclick="show(41,50);">5</a></li>
									</ul>
								</div>
								<table id="tabledit1" class="table-bordered table-striped table">
									<thead>
										<tr>
											<th>ID</th>
											<th>Data/Hora</th>
											<th>Tensão Arterial</th>
											<th>Responsável</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Gráfico Frequência Cardíaca
								<button type="button" id="exportar-graph-fc" class="btn btn-primary btn-xs pull-right">Exportar como PDF</button>
							</div>
							<div class="panel-body">
								<div id="morris-line-chart-fc"></div>
							</div>
						</div>

					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Gráfico Tensão Arterial
								<button type="button" id="exportar-graph-ta" class="btn btn-primary btn-xs pull-right">Exportar como PDF</button>
							</div>
							<div class="panel-body">
								<div id="morris-line-chart-ta"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->

	<div class="modal fade" id="introduzir-fc" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<form name="inserir-novo-fc" id="inserir-novo-fc" method="post">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Inserir novo registo</h4>
					</div>
					<div class="modal-body">
						<!-- <label class="control-label">Data</label>
						<input type="date" id="datafc" name="datafc" class="form-control" required/> -->

						<label class="control-label">Data/Hora</label>
						<div class="input-group bootstrap-timepicker timepicker">
							<input id="timepicker1" type="text" class="form-control input-small" name="horafc" required/>
							<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
						</div>

						<label class="control-label">Frequência Cardíaca</label>
						<input class="form-control" type="number" placeholder="Frequência Cardíaca (BPM)" id="fc" name="fc" min=0 required/>

						<label class="control-label">Responsável</label>
						<input required class="form-control" type="text" id="responsavelfc" name="responsavelfc" />
					</div>
					<div class="modal-footer">
						<div class="msgERRO" style="float:left"></div>
						<button type="submit" class="btn btn-primary adicionar-registo-fc">Adicionar Registo</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="introduzir-ta" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Inserir novo registo</h4>
				</div>
				<div class="modal-body">
					<form name="inserir-novo-ta" id="inserir-novo-ta" method="post">
						<!-- <label class="control-label">Data</label>
						<input type="date" id="datata" name="datata" class="form-control"> -->

						<label class="control-label">Data/Hora</label>
						<div class="input-group bootstrap-timepicker timepicker">
							<input id="timepicker2" type="text" class="form-control input-small" name="horata">
							<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
						</div>

						<label class="control-label">Tensão Arterial</label>
						<input class="form-control" type="number" placeholder="Tensão Arterial" id="ta" name="ta" />

						<label class="control-label">Responsável</label>
						<input class="form-control" type="text" placeholder="Responsável pela Medição" id="responsavelta" name="responsavelta" />
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary adicionar-registo-ta">Adicionar Registo</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

	<div class="modal fade" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="popupModalTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="popupModalTitle">Erro</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
				</div>
				<div class="modal-body message">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>

	<div id="popupAlerta" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Valores anormais</h4>
      </div>
      <div class="modal-body bio">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>
	<!-- links para os scrips ao final da página -->
	<?php include 'includes/footer-links.php';?>
	<!-- - - - - - - - - - - - - - - - -->
</body>
<!-- script TablEdit -->
<script src="lib/jquery-tabledit/jquery.tabledit.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
<script src="lib/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="lib/datetimepicker/js/locales/bootstrap-datetimepicker.pt.js"></script>
<script src="js/dados-biometricos.js"></script>

</html>
