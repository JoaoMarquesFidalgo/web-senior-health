<!-- DOCTYPE HTML e tag <head> -->
<?php include 'includes/header.php'; ?>
<!-- - - - - - - - - - - - - - - - -->
<?php print_r($_SESSION); ?>
<title>SmartWalk - Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<!-- script JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
</head>

<body>

	<div id="wrapper">

		<!-- top-menu e menu lateral -->
		<?php include 'includes/nav.php'; ?>
		<!-- - - - - - - - - - - - - - - - -->

		<!-- http://fontawesome.io/icons/ -->
		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						<?php if(isset($_SESSION["familiar-id"])&&isset($_SESSION["utente-id"])){
									include 'scriptsPHP/listar_utente.php';
									echo "Seja Bem-Vindo à Area do familiar de ".$result[0]["nome"]."!";
								} else {
									echo "Bem-vindo " . $_SESSION["user-nome"] . "!";
								}?>
					</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-8">
					<div class="panel panel-default">
						<div class="panel-heading">
							Resumo dos dados biométricos (frequência cardíaca) inseridos no último mês
						</div>
						<div class="panel-body">
							<div id="morris-line-chart-db-fc"></div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							Resumo dos dados biométricos (tensão arterial) inseridos no último mês
						</div>
						<div class="panel-body">
							<div id="morris-line-chart-db-ta"></div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							Resumo dos dados de atividade física inseridos no último mês (andar)
						</div>
						<div class="panel-body">
							<div id="morris-line-chart-af-andar-mes"></div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
							Resumo dos dados de atividade física inseridos no último mês (sentado)
						</div>
						<div class="panel-body">
							<div id="morris-line-chart-af-sentado-mes"></div>
						</div>
					</div>

					<!-- <div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-bar-chart-o fa-fw"></i> Resumo de um gráfico
							<div class="pull-right">
								<div class="btn-group">
									<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
									<ul class="dropdown-menu pull-right" role="menu">
										<li><a href="#">Action</a>
										</li>
										<li><a href="#">Another action</a>
										</li>
										<li><a href="#">Something else here</a>
										</li>
										<li class="divider"></li>
										<li><a href="#">Separated link</a>
										</li>
									</ul>
								</div>
							</div>
						</div>

						<div class="panel-body">
							<div id="morris-area-chart">=)</div>
						</div>

					</div> -->


				</div>
				<!-- /.col-lg-8 -->
				<div class="col-lg-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<i class="fa fa-pencil-square-o"></i> Resumo de atividades da conta
						</div>
						<!-- /.panel-heading -->
						<div class="panel-body" style="padding-left: 0px;">
							<ul class="timeline">
								<li class="timeline-inverted">
									<div class="timeline-badge"><i class="fa fa-check"></i>
									</div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">Registou-se no SmartWalk</h4>
											<!-- <p><small class="text-muted"><i class="fa fa-clock-o"></i> 11 hours ago via Twitter</small>
                                            </p> -->
										</div>
										<div class="timeline-body">
											<p>Registou-se para gerir os seus dados de saúde em um só lugar.</p>
										</div>
									</div>
								</li>
								<li class="timeline-inverted">
									<!--  class="timeline-inverted" torna o balão apontado para o lado esquerdo -->
									<div class="timeline-badge warning"><i class="fa fa-user"></i>
									</div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">Preenchimento do perfil</h4>
										</div>
										<div class="timeline-body">
											<p>Após o seu registo, certifique-se de que preencheu corretamente todos os campos do seu perfil pessoal.</p>
										</div>
									</div>
								</li>
								<li class="timeline-inverted">
									<div class="timeline-badge danger"><i class="fa fa-heartbeat"></i>
									</div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">Dados de saúde</h4>
										</div>
										<div class="timeline-body">
											<p>Adicione o seu histórico e dados de saúde diariamente.</p>
										</div>
									</div>
								</li>
								<li class="timeline-inverted">
									<div class="timeline-badge warning"><i class="fa fa-bar-chart"></i>
									</div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">Visualização por gráficos</h4>
										</div>
										<div class="timeline-body">
											<p>Visualize a evolução e varização dos seus dados biométricos e dados de saúdes através de gráficos intuitivos e tenha um melhor entendimento sobre a sua saúde.</p>
										</div>
									</div>
								</li>
								<li class="timeline-inverted">
									<div class="timeline-badge info"><i class="fa fa-save"></i>
									</div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">Exportação das informações</h4>
										</div>
										<div class="timeline-body">
											<p>Exporte os seus dados inseridos ao longo do tempo em forma de texto e gráficos.</p>
										</div>
									</div>
								</li>
								<li class="timeline-inverted">
									<div class="timeline-badge success"><i class="fa fa-graduation-cap"></i>
									</div>
									<div class="timeline-panel">
										<div class="timeline-heading">
											<h4 class="timeline-title">Adicione um familiar</h4>
										</div>
										<div class="timeline-body">
											<p>Poderá adicionar um familiar ao seu perfil para que possa lhe auxiliar na inserção de dados e consulta na aplicação.</p>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->
				</div>
				<!-- /.col-lg-4 -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->

	<!-- links para os scrips ao final da página -->
	<?php include 'includes/footer-links.php'; ?>
	<!-- - - - - - - - - - - - - - - - -->

	<!-- <div id="morris-line-chart-af-mes"></div> -->
	<script type="text/javascript">
	Morris.Area({
		// ID of the element in which to draw the chart.
		element: 'morris-line-chart-db-fc',

		// Chart data records -- each entry in this array corresponds to a point
		// on the chart.
		data: <?php
		require_once('class/user.class.php');
		$user = new User();
		echo $user->graphMostrarFCMes($_SESSION["utente-id"]);
		 ?>,

		// The name of the data record attribute that contains x-values.
		xkey: 'datahora',

		// A list of names of data record attributes that contain y-values.
		ykeys: ['frequencia_cardiaca'],

		// Labels for the ykeys -- will be displayed when you hover over the
		// chart.
		labels: ['Frequência Cardíaca'],

		lineColors: ['#0b62a4'],
		//ajusta o gráfico ao melhor
		xLabels: 'day',

		// Disables line smoothing
		smooth: true,
		resize: true
	});

	Morris.Area({
		// ID of the element in which to draw the chart.
		element: 'morris-line-chart-db-ta',

		// Chart data records -- each entry in this array corresponds to a point
		// on the chart.
		data: <?php
		require_once('class/user.class.php');
		$user = new User();
		echo $user->graphMostrarTAMes($_SESSION["utente-id"]);
		 ?>,

		// The name of the data record attribute that contains x-values.
		xkey: 'datahora',

		// A list of names of data record attributes that contain y-values.
		ykeys: ['tensao_arterial'],

		// Labels for the ykeys -- will be displayed when you hover over the
		// chart.
		labels: ['Tensão Arterial'],

		lineColors: ['#0b62a4'],
		//ajusta o gráfico ao melhor
		xLabels: 'day',

		// Disables line smoothing
		smooth: true,
		resize: true
	});

		Morris.Area({
			// ID of the element in which to draw the chart.
			element: 'morris-line-chart-af-andar-mes',

			// Chart data records -- each entry in this array corresponds to a point
			// on the chart.
			data: <?php
			require_once('class/user.class.php');
			$user = new User();
			echo $user->graphAtividadeFisicaMovimentoMes($_SESSION["utente-id"]);
			 ?>,

			// The name of the data record attribute that contains x-values.
			xkey: 'data',

			// A list of names of data record attributes that contain y-values.
			ykeys: ['frequencia', 'duracao'],

			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Frequência', 'Duração'],

			lineColors: ['#0b62a4', '#D58665'],
			//ajusta o gráfico ao melhor
			xLabels: 'day',

			// Disables line smoothing
			smooth: true,
			resize: true
		});

		Morris.Area({
			// ID of the element in which to draw the chart.
			element: 'morris-line-chart-af-sentado-mes',

			// Chart data records -- each entry in this array corresponds to a point
			// on the chart.
			data: <?php require_once('class/user.class.php');
			$user = new User();
			echo $user->graphAtividadeFisicaRepousoMes($_SESSION["utente-id"]);
			 ?>,

			// The name of the data record attribute that contains x-values.
			xkey: 'data',

			// A list of names of data record attributes that contain y-values.
			ykeys: ['duracao'],

			// Labels for the ykeys -- will be displayed when you hover over the
			// chart.
			labels: ['Duração'],

			lineColors: ['#0b62a4'],
			//ajusta o gráfico ao melhor
			xLabels: 'day',

			// Disables line smoothing
			smooth: true,
			resize: true
		});

	</script>
</body>

</html>
