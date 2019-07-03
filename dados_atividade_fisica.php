<!-- DOCTYPE HTML e tag <head> -->
<?php
include 'includes/header.php';
?>

<?php print_r($_SESSION);
?>
<!-- - - - - - - - - - - - - - - - -->

<title>SmartWalk - Dados atividade física</title>
<!-- Load c3.css -->
<link rel="stylesheet" href="css/dados-atividade-fisica.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="lib/xepOnline/xepOnline.jqPlugin.js"></script>

<script>
$(function(){
	var dtToday = new Date();

	var month = dtToday.getMonth() + 1;
	var day = dtToday.getDate();
	var year = dtToday.getFullYear();

	if(month < 10)
			month = '0' + month.toString();
	if(day < 10)
			day = '0' + day.toString();

	var maxDate = year + '-' + month + '-' + day;
	$('#data-andar').attr('max', maxDate);
	$('#data-sentado').attr('max', maxDate);
});
</script>
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
					<h1 class="page-header">Dados Atividade Física</h1>
					<div class="col-xs-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Tempo em movimento <img src="img/Very-Basic-Info-icon.png" alt="imagem" style="width:20px; height:20px" title="Alterar">
								<button type="button" class="btn btn-primary btn-xs pull-right" onclick="window.open('script/get-pdf-af-movimento.php')">Exportar como PDF</button>
							</div>
							<div class="panel-body">
								<div class="col-xs-2" id="insertFC" style="margin-bottom: 10px;padding-left: 0px;">
									<button id="editar-tempo-andamento" class="btn green" data-toggle="modal" data-target="#introduzir-atividade-fisica-movimento">Adicionar registo <i class="fa fa-plus"></i></button>
								</div>
								<table id="tabledit-andamento" class="table-bordered table-striped table">
									<thead>
										<tr>
											<th>ID</th>
											<th>Dia da semana</th>
											<th>Data</th>
											<th>Frequência</th>
											<th>Duração</th>
											<th>Condição Saúde</th>
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
								Tempo em repouso <img src="img/Very-Basic-Info-icon.png" alt="imagem" style="width:20px; height:20px" title="Alterar">
								<button type="button" id="exportar-repouso" class="btn btn-primary btn-xs pull-right" onclick="window.open('script/get-pdf-af-repouso.php')">Exportar como PDF</button>
							</div>
							<div class="panel-body">
								<div class="col-xs-2" id="insertTA" style="margin-bottom: 10px;padding-left: 0px;">
									<button id="editar-tempo-repouso" class="btn green" data-toggle="modal" data-target="#introduzir-atividade-fisica-repouso">Adicionar registo <i class="fa fa-plus"></i></button>
								</div>
								<table id="tabledit-repouso" class="table-bordered table-striped table">
									<thead>
										<tr>
											<th>ID</th>
											<th>Dia da semana</th>
											<th>Data</th>
											<th>Duração</th>
											<th>Condição Saúde</th>
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
								Gráfico tempo de movimento
								<button type="button" id="exportar-graph-movimento" class="btn btn-primary btn-xs pull-right">Exportar como PDF</button>
							</div>
							<div class="panel-body">
								<div id="morris-line-chart-movimento"></div>
							</div>
						</div>

					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Gráfico tempo em repouso
								<button type="button" id="exportar-graph-repouso" class="btn btn-primary btn-xs pull-right">Exportar como PDF</button>
							</div>
							<div class="panel-body">
								<div id="morris-line-chart-repouso"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->

	</div>

	<div class="modal fade" id="introduzir-atividade-fisica-movimento" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Inserir novo registo</h4>
				</div>
				<div class="modal-body">
					<form name="inserir-novo-af-movimento" id="inserir-novo-af-movimento" method="post">
						<label class="control-label" for="duracao">Data</label>
						<input class="form-control" type="date" id="data-andar" name="data"/>

						<label class="control-label" for="frequencia">Frequência</label>
						<select class="form-control" name="frequencia" id="frequencia">
							<option selected hidden disabled value="-1">Seleccione a frequência que anda por dia...</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
						</select>

						<label class="control-label" for="duracao">Duração</label>
						<input class="form-control" type="number" oninput="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="Tempo médio" id="duracao" name="duracao" min="0"/>

						<label class="control-label" for="condicao_fisica">Condição física</label>
						<select class="form-control" name="condicao_fisica" id="condicao_fisica">
							<option selected hidden disabled value="-1">Seleccione a sua condição física</option>
							<option value="Melhorou">Melhorou</option>
							<option value="Manteve">Manteve</option>
							<option value="Agravou">Agravou</option>
						</select>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary adicionar-registo-af-movimento">Adicionar Registo</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				</div>
			</div>

		</div>
	</div>

	<div class="modal fade" id="introduzir-atividade-fisica-repouso" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Inserir novo registo</h4>
				</div>
				<div class="modal-body">
					<form name="inserir-novo-af-repouso" id="inserir-novo-af-repouso" method="post">
						<label class="control-label" for="duracao">Data</label>
						<input class="form-control" type="date" id="data-sentado" name="data"/>

						<label class="control-label" for="duracao">Duração</label>
						<input class="form-control" type="number" oninput="this.value=this.value.replace(/[^0-9]/g,'');" placeholder="Tempo médio" id="duracao" name="duracao" min="0"/>

						<label class="control-label" for="condicao_fisica">Condição física</label>
						<select class="form-control" name="condicao_fisica" id="condicao_fisica">
							<option selected hidden disabled value="-1">Seleccione a sua condição física</option>
							<option value="Melhorou">Melhorou</option>
							<option value="Manteve">Manteve</option>
							<option value="Agravou">Agravou</option>
						</select>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary adicionar-registo-af-repouso">Adicionar Registo</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
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
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- links para os scrips ao final da página -->
<?php include 'includes/footer-links.php';?>
<!-- - - - - - - - - - - - - - - - -->
<script src="lib/jquery-tabledit/jquery.tabledit.js"></script>
<script src="js/dados-atividade-fisica.js"></script>
</body>

</html>
