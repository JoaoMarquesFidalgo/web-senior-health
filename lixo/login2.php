<!-- DOCTYPE HTML e tag <head> -->
<?php //include 'includes/header.php'; ?>
<!-- - - - - - - - - - - - - - - - -->

<script src="vendor/jquery/jquery.min.js"></script>
<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" />
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="vendor/bootstrap/css/layout.css">
<link rel="stylesheet" href="vendor/bootstrap/css/jquery-ui.min.css">
<script src="vendor/bootstrap/js/jquery-ui.min.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SmartWalk - PTAW Grupo 1</title>

<style>
	.page-header {
		padding-bottom: 0;
		margin: 0;
		border-bottom: 1px solid #eee;
	}
	
	.login-page,
	.registo-page {
		max-width: 360px;
		padding:  8% 0 0;
		margin: auto;
	}
	
	@media screen and (max-width: 480px) {
		.login-page,
		.registo-page {
			max-width: 360px;
			padding: 8% 2%;
			margin: auto;
		}
	}

</style>


</head>

<body>

	<div id="wrapper">

		<!-- top-menu e menu lateral -->
		<?php //include 'includes/nav.php'; ?>
		<!-- - - - - - - - - - - - - - - - -->

		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="login-page">
							<div class="form">
								<form class="login-form">
									<input type="text" placeholder="E-mail" />
									<input type="password" placeholder="Password" />
									<a href="admin.php">entrar aqui</a>
									<button>login</button>
									<p class="message">Não está registado? <a href="registo.php">Crie uma conta</a></p>
								</form>
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
	<?php //include 'includes/footer-links.php'; ?>
	<!-- - - - - - - - - - - - - - - - -->

</body>

</html>
