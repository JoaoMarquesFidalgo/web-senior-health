<?php
session_start();

if(isset($_SESSION["user-id"])&&isset($_SESSION["utente-id"])&&!isset($_SESSION["familiar-id"]))
{
  header("Location: inicio.php");
} else if(isset($_SESSION["user-id"])&&isset($_SESSION["familiar-id"])) {
  header("Location: familiar.php");
} else if(isset($_SESSION["admin-id"])) {
  header("Location: admin-page.php");
}

print_r($_SESSION);

?>
<!-- DOCTYPE HTML e tag <head> -->
<?php //include 'includes/header.php'; ?>
<!-- - - - - - - - - - - - - - - - -->
<meta charset="utf-8">
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
								<form name="log-in-form" id="log-in-form" class="login-form" method="post">
									<input type="text" placeholder="E-mail" class="form-control" name="email" id="email" />
									<input type="password" placeholder="Password" class="form-control" name="password" id="password" />
									<button type="button" id="login-button" class="btn btn-primary">login</button>
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
  <div class="modal fade" id="popupModal" tabindex="-1" role="dialog" aria-labelledby="popupModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="popupModalTitle">Erro na autenticação</h4>
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
	<!-- links para os scrips ao final da página -->
	<?php include 'includes/footer-links.php'; ?>
	<!-- - - - - - - - - - - - - - - - -->

</body>

</html>
