<!-- DOCTYPE HTML e tag <head> -->
<?php include 'includes/header.php'; ?>
<!-- - - - - - - - - - - - - - - - -->
<?php print_r($_SESSION); ?>


<title>SmartWalk - Dados de Atenticação</title>
<style>
	.destaque {
		background-color: #eee;
		padding-bottom: 25px;
		border-radius: 3px;
		border-radius: 3px;
		padding: 15px;
	}
	
	#add-familiar {
		display: none;
	}
	
	.fa-check {
		color: white;
		background-color: green;
		padding: 6px;
		border-radius: 50%;
		font-size: 12px;
		margin-right: 8px;
	}
	
	.modal-header {
		padding: 20px;
		border-bottom: none;
	}
	
	.modal-content {
		position: relative;
		background-color: #fff;
		-webkit-background-clip: padding-box;
		background-clip: padding-box;
		border: 1px solid rgba(0, 0, 0, .2);
		border-radius: 6px;
		outline: 0;
		-webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
		box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
		border: 2px solid green;
	}
	
	.modal-content-danger {
		position: relative;
		background-color: #fff;
		-webkit-background-clip: padding-box;
		background-clip: padding-box;
		border: 1px solid rgb(255, 0, 0);
		border-radius: 6px;
		outline: 0;
		-webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
		box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
		border: 2px solid green;
	}
	
	i.is-loading {
		display: none;
		position: fixed;
		top: 50%;
		left: 50%;
		z-index: 99999;
		font-size: 28px;
	}
</style>
</head>

<body>

	<div id="wrapper">


		<!-- top-menu e menu lateral -->
		<?php include 'includes/admin-nav.php';?>
		<!-- - - - - - - - - - - - - - - - -->

		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Dados de autenticação</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->

				<!-- ------------------- FORMULARIO ------------------- -->
				<i class="fa fa-refresh fa-spin fa-3x fa-fw margin-bottom is-loading"></i>
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Visualização e alteração dos dados de autenticação
							</div>
							<div class="panel-body">
								<div class="form-group">
									<form role="form">

										<!-- Obter ID no modo hidden -->
										<input type="hidden" name="id" value="<?php echo '$id'; ?>">
										<div class="form-group">
											<label>E-mail</label>
											<input type="email" class="form-control" id="email" name="email" placeholder="@" disabled>
											<p class="help-block">Digite o seu e-mail.</p>
										</div>
										<div class="form-group">
											<label>Password</label>
											<input type="password" id="pass" class="form-control" name="password" placeholder="***********" disabled>
											<p class="help-block">Digite um novo e-mail ou deixe o campo em branco para não alterá-lo.</p>
										</div>
										<button type="button" class="btn btn-info" id="editar-dados">EDITAR</button>
										<button type="button" class="btn btn-success" id="gravar" disabled style="opacity: 0.2;" data-toggle="modal">GRAVAR</button>
										<button type="button" class="btn btn-warning" id="cancelar" disabled style="opacity: 0.2;">CANCELAR</button>

										<!-- http://getbootstrap.com/javascript/ -->
										<!-- Modal para validar a senha -->
										<div id="myModal" class="modal fade" role="dialog">
											<div class="modal-dialog">

												<!-- Modal content-->
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">Valide a sua senha</h4>
													</div>
													<div class="modal-body">
														<form id="formModal">
															<label for="senha" class="control-label">Introduza a sua senha para poder alterar seu email ou senha.</label>
															<input type="password" class="form-control" id="senha" focu>
														</form>
													</div>
													<div class="modal-footer" style="border:none">
														<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
														<button type="button" class="btn btn-success" id="validar-senha">Validar Senha</button>
													</div>
												</div>

											</div>
										</div>
										<!-- fim myModa -->
									</form>
								</div>
									
								<!-- Modal -->
								<div id="modalConfirm" class="modal fade" role="dialog">
									<div class="modal-dialog">

										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title"><i class="fa fa-check" style="color:white; background-color:green;
														"></i>A sua alteração foi realizada com sucesso!</h4>
											</div>
											<!-- <div class="modal-body">
													</div> 
													<div class="modal-footer" style="border:none">
														<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
													</div>-->
										</div>

									</div>
								</div>
								<!-- fim modalConfirm -->

								<!-- Modal -->
								<div id="modalErro" class="modal fade" role="dialog">
									<div class="modal-dialog">

										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title"><i class="fa fa-info-circle" style="color:red;
														"></i> Senha errada!</h4>
											</div>
											<!-- <div class="modal-body">
													</div> 
													<div class="modal-footer" style="border:none">
														<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
													</div>-->
										</div>

									</div>
								</div>
								<!-- fim modalConfirm -->
							</div>

						</div>
						<!-- /.panel -->
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row FIM FORMULARIO -->
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->

		<!-- links para os scrips ao final da página -->
		<?php include 'includes/footer-links.php'; ?>
		<!-- - - - - - - - - - - - - - - - -->

</body>
<script src="js/admin-autenticacao.js"></script>

</html>
