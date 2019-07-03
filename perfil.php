<!-- DOCTYPE HTML e tag <head> -->
<?php include 'includes/header.php'; ?>
<!-- - - - - - - - - - - - - - - - -->
<!-- Dante Marinho -->
<title>SmartWalk - Perfil</title>
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

				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								Informações pessoais e da conta
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-4">
										<img src="img/man.png" alt="Foto pessoal" class="img-thumbnail">
										<p>Nome: Maria do Carmo</p>
										<p>Idade: 63</p>
									</div>
									<div class="col-lg-4">
										<p>Morada: Rua da Estrela, nº 105</p>
										<p>Código Postal: 4500-040</p>
										<p>Distrito: Aveiro</p>
										<p>País: Portugal</p>
										<p>Telefone: 91 944 5678</p>
										<p>Data de Nascimento: 15/07/1957</p>
										<p>Sexo: feminino</p>
										<p>Educação Formal: Ensino superior</p>
										<p>Literacia Informática: chamadas, PC, internet</p>
									</div>
									<div class="col-lg-4">
										<fieldset class="scheduler-border">
											<legend class="scheduler-border">Dados de autenticação</legend>
											<p>Nome de utilizador: maria</p>
											<p>E-mail: mariadocarmo@ua.pt</p>
										</fieldset>
										<button type="text" id="editar-perfil" class="btn btn-info">Editar Perfil</button> <button type="text" id="cancelar-perfil" class="btn btn-info">Cancelar Conta</button>
									</div>
									<!-- /.col-lg-12 -->
								</div>
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

	<!-- links para os scrips ao final da página -->
	<?php include 'includes/footer-links.php'; ?>
	<!-- - - - - - - - - - - - - - - - -->
</body>

</html>
