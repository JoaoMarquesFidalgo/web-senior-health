<!-- DOCTYPE HTML e tag <head> -->
<?php include 'includes/header.php'; ?>
<!-- - - - - - - - - - - - - - - - -->
<?php print_r($_SESSION);?>

<?php if(isset($_SESSION["familiar-id"])){
	$tipo= 'familiar';
} else if(isset($_SESSION["utente-id"])){
	$tipo= 'utente';
}?>
<script>
	var tipo = "<?php echo $tipo ?>"

</script>
<title>SmartWalk - Perfil</title>
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

	.inputErro {
		border-color: #FF0000;
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
	}

	body {
		padding-right: 0 !important
	}

	.fa-check {
		color: white;
		background-color: green;
		padding: 6px;
		border-radius: 50%;
		font-size: 12px;
		margin-right: 8px;
	}

	.fa-exclamation-triangle {
		color: white;
		background-color: red;
		padding: 6px;
		border-radius: 50%;
		font-size: 21px;
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
		border: 1px solid #999;
		border: 1px solid rgba(0, 0, 0, .2);
		border-radius: 6px;
		outline: 0;
		-webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
		box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
		border: 2px solid green;
	}

	input[type="file"] {
		display: none;
	}

	.custom-file-upload {
		border: 1px solid #ccc;
		display: inline-block;
		padding: 6px 12px;
		cursor: pointer;
	}

</style>
</head>

<body>

	<div id="wrapper">


		<!-- top-menu e menu lateral -->
		<?php include 'includes/nav.php'; ?>
		<!-- - - - - - - - - - - - - - - - -->

		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Perfil</h1>
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<!-- /.row -->

				<!-- ------------------- FORMULARIO ------------------- -->

				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Informações pessoais do utilizador
							</div>
							<div class="panel-body">
								<form role="form" id="formPerfil" method='POST'>
									<button type="button" class="btn btn-info" id="editar-dados">EDITAR</button>
									<button type="submit" class="btn btn-success" id="gravar" disabled style="opacity: 0.2;">GRAVAR</button>
									<button type="button" class="btn btn-warning" id="cancelar" disabled style="opacity: 0.2;">CANCELAR</button>

									<br><br>
									<!-- removi uma row e col-6 que havia aqui neste nivel -->

									<div id="imgDiv"></div>
									<div class="form-group">
										<label class="col-xs-12" style="padding:0px !important">Upload de nova imagem</label>
										<label for="file-upload" style="border-radius:5px" class="custom-file-upload">
											<i class="fa fa-cloud-upload"></i> Upload
										</label>
										<input id="file-upload" type="file">
										<button type="button" class="btn btn-danger btn-sm" id="removeImage"><i class="fa fa-times" aria-hidden="true"></i></button>
									</div>
									<div class="form-group">
										<label>Nome</label>
										<input class="form-control" name="nome" id="nomeP" disabled>
										<p class="help-block">Digite o seu primeiro nome.</p>
									</div>
									<div class="form-group">
										<label>Data de nascimento</label>
										<input type="text" class="form-control" name="data_nascimento" id="dataP" disabled>
										<p class="help-block">Indique a sua data de nascimento.</p>
									</div>
									<div class="form-group">
										<label>Sexo</label>
										<label class="radio-inline">
                                            <input type="radio" value="Feminino" name="sexo" id="feminino" disabled>Feminino
                                        </label>
										<label class="radio-inline">
                                            <input type="radio" value="Masculino" name="sexo" id="masculino" disabled>Masculino
                                        </label>
									</div>
									<h2 class="ut">Educação Formal</h2>
									<div class="form-group ut">
										<select name="edformal" id="edformal" class="form-control edformal" disabled required>
										  <option value="" disabled selected hidden>Selecione a sua educação formal</option>
										  <option value="Não sabe ler nem escrever">Não sabe ler nem escrever</option>
										  <option value="Sabe ler e escrever">Sabe ler e escrever</option>
										  <option value="4 ºano de escolaridade">4 ºano de escolaridade</option>
										  <option value="6 ºano de escolaridade">6 ºano de escolaridade</option>
										  <option value="9º ano de escolaridade">9ºano de escolaridade</option>
										  <option value="12ºano de escolaridade">12ºano de escolaridade</option>
										  <option value="Bacharelato/Licenciatura">Bacharelato/Licenciatura</option>
										  <option value="Outro">Outro</option>
										</select>
									</div>
									<div class="form-group">
										<div id="outroedformal" style="display: none;">
											<input type="text" id="outro" name="outroedformal" class="form-control" placeholder="Por favor, especifique" disabled>
										</div>
									</div>
									<h2 class="ut">Literacia informática</h2>
									<div class="form-group ut">
										<label>Tem telemóvel?</label>
										<label class="radio-inline">
                                            <input type="radio" value="1" name="telemovel" id="telemovelSim" disabled>Sim
                                        </label>
										<label class="radio-inline">
                                            <input type="radio" value="0" name="telemovel" id="telemovelNao" disabled>Não
                                        </label>
									</div>
									<div class="form-group ut">
										<label>Se respondeu sim, utiliza-o para:</label>
										<div class="checkbox check1">
											<label>
                                                <input type="checkbox" value="1" name="chamadas" id="chamadas" disabled>Fazer ou receber chamadas
                                            </label>
										</div>
										<div class="checkbox check1">
											<label>
                                                <input type="checkbox" value="2" name="sms" id="sms" disabled>Enviar e receber mensagens escritas
                                            </label>
										</div>
										<div class="checkbox check1">
											<label>
                                                <input type="checkbox" value="3" name="internet" id="internet" disabled>Navegar na internet
                                            </label>
										</div>
									</div>
									<div class="form-group ut">
										<label>Utiliza computador ou tablet?</label>
										<label class="radio-inline">
                                            <input type="radio" value="1" name="computador" id="pcs" disabled>Sim
                                        </label>
										<label class="radio-inline">
                                            <input type="radio" value="0" name="computador" id="pcn" disabled>Não
                                        </label>
									</div>
								</form>
								<div class="panel panel-default panelFamiliar">
									<div class="panel-heading">Adicionar Familiar</div>
									<div class="checkbox panel-body">
										<!--break-->
										<div class="container col-xs-12 hidden" id="container">
											<div class="row user-infos">
												<div class="panel panel-primary">
													<div class="panel-heading">
														<h3 class="panel-title">Informação do Familiar</h3>
													</div>
													<div class="panel-body" style="padding:5px">
														<div class="row">
															<div class="col-md-3 col-lg-3 hidden-xs hidden-sm">
																<img class="img-circle" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" alt="User Pic">
															</div>
															<div class="col-xs-2 col-sm-2 hidden-md hidden-lg">
																<img class="img-circle" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=50" alt="User Pic">
															</div>
															<div class="col-xs-8 col-xs-offset-1 col-sm-9 hidden-md hidden-lg">
																<strong>Familiar</strong><br>
																<table class="table table-user-information tbl"></table>
															</div>
															<div class=" col-md-9 col-lg-9 hidden-xs hidden-sm">
																<strong>Familiar</strong><br>
																<table class="table table-user-information tbl"></table>
															</div>
														</div>
													</div>
													<div class="panel-footer">
														<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirm-delete" type="button"><i class="glyphicon glyphicon-remove"></i></button>
													</div>
												</div>
											</div>
										</div>
										<div id="add-familiar" class="form-group">
											<form name="inserir-familiar" id="inserir-familiar" method="post">
												<div class="form-group">
													<label class="control-label">Email</label>
													<input required class="form-control" type="email" id="emailF" name="emailF" />
												</div>
												<div class="form-group hidden">
													<label class="control-label">Nome</label>
													<input required class="form-control" type="text" id="nomeF" name="nomeF" />
												</div>
												<div class="form-group hidden">
													<label class="control-label">Data Nascimento</label>
													<input required class="form-control" type="date" id="dateF" name="dateF" />
												</div>
												<div class="form-group hidden">
													<label class="control-label">Sexo</label>
													<select name="sexoF" id="sexoF" class="form-control">
															<option value="" disabled selected hidden>Selecione o seu sexo</option>
															<option value="Masculino">Masculino</option>
															<option value="Feminino">Feminino</option>
														</select>
												</div>
												<div class="form-group hidden">
													<label class="control-label">Password</label>
													<input required class="form-control" type="password" id="passwdF" name="passwdF" />
												</div>
											</form>
										</div>
										<div id="infoFamiliar" class="form-group">
											<!--append dinamico-->
										</div>
									</div>
									<!--break-->
								</div>
							</div>
							<!-- Botões -->
						</div>
						<!-- /.panel-body -->
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

	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Tem a certeza que pretende eliminar?</h4>
				</div>

				<div class="modal-body">
					<p>Você está prestes a eliminar um registo e este processo é irreversível.</p>
					<p>Deseja continuar?</p>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<a class="btn btn-danger btn-ok" id="removeFamiliar">Eliminar</a>
				</div>
			</div>
		</div>
	</div>
	<div id="modal1" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
				</div>
			</div>
		</div>
	</div>

	<!-- links para os scrips ao final da página -->
	<?php include 'includes/footer-links.php'; ?>
	<!-- - - - - - - - - - - - - - - - -->
	<script>
		$(document).on('click', '#editar-dados', function() {
			$('.form-group input').prop("disabled", false);
			$('.edformal').prop("disabled", false);
			$('#gravar').prop("disabled", false);
			$('#gravar').css("opacity", 1);
			$('#cancelar').prop("disabled", false);
			$('#cancelar').css("opacity", 1);
			$("#chamadas").prop("disabled", true);
			$("#sms").prop("disabled", true);
			$("#internet").prop("disabled", true);
			$('#file-upload').prop("disabled", false);
			$('.custom-file-upload').css('opacity', '1');
			$('.custom-file-upload').css('cursor', 'pointer');
		})

		$(document).on('click', '#cancelar', function() {
			$('.form-group input').prop("disabled", true);
			$('.edformal').prop("disabled", true);
			$('#gravar').prop("disabled", true);
			$('#gravar').css("opacity", 0.2);
			$('#cancelar').prop("disabled", true);
			$('#cancelar').css("opacity", 0.2);
		})

	</script>

</body>
<script src="js/perfil.js"></script>

</html>
