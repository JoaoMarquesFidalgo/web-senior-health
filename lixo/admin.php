<!-- DOCTYPE HTML e tag <head> -->
<?php include 'includes/header.php'; ?>
<!-- - - - - - - - - - - - - - - - -->
<?php print_r($_SESSION); ?>
<?php if(!isset($_SESSION["utente-id"])){
	header("Location: javascript://history.go(-1)");
} ?>


<title>SmartWalk - Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.css">
<!-- script JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.js"></script>
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
					<h1 class="page-header">Olá
						<?php echo $_SESSION["user-nome"] . "!";?>
					</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-lg-8">
					<div class="panel panel-default">
						<div class="panel-heading">
							Resumo dos dados biométricos inseridos no último mês
						</div>
						<div class="panel-body">
							<div id="chart"></div>
						</div>
					</div>

					<div class="panel panel-default">
						<div class="panel-heading">
						Resumo dos dados de atividade física inseridos no último mês						
						</div>
						<div class="panel-body">
							<div id="chart1"></div>
						</div>
					</div>


					<div class="panel panel-default">
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
						<!-- /.panel-heading -->
						<div class="panel-body">
							<div id="morris-area-chart">=)</div>
						</div>
						<!-- /.panel-body -->
					</div>
					<!-- /.panel -->

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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
	<script src="js/dados-biometricos.js"></script>
</body>

</html>
