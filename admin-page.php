<!-- DOCTYPE HTML e tag <head> -->
<?php include 'includes/header.php'; ?>
<!-- - - - - - - - - - - - - - - - -->
<?php if(!isset($_SESSION["admin-id"])){
	header("Location: javascript://history.go(-1)");
} ?>

<title>SmartWalk - Página de Administração</title>

<!-- MetisMenu CSS -->
<link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

<!-- DataTables CSS -->
<link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<style>
	.btn-group {
		margin: auto;
		display: inline-block;
	}
	
	.gradeA td {
		align-content: center;
		text-align: center;
	}
	
	.o {
		background-color: rgb(180, 255, 166);
	}
	
	.o-bloqueado {
		float: none;
		background-color: #ccc;
	}
	
	.x {
		background-color: rgba(255, 27, 27, 0.48);
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
		border: 1px solid #999;
		border: 1px solid rgba(0, 0, 0, .2);
		border-radius: 6px;
		outline: 0;
		-webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
		box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
		border: 2px solid green;
	}

</style>
</head>

<body>
	<?php #echo $_SESSION["admin-id"] . "!";?>
	<div id="wrapper">

		<!-- top-menu e menu lateral -->
		<?php include 'includes/admin-nav.php'; ?>
		<!-- - - - - - - - - - - - - - - - -->

		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Página de Administração</h1>
					</div>
					<!-- /.col-lg-12 -->
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									Listagem dos utilizadores (utentes e familiares) da aplicação.
								</div>
								<div class="panel-body">
									<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
										<thead>
											<tr>
												<th>ID</th>
												<th>Tipo</th>
												<th>Nome</th>
												<th>E-mail</th>
												<th>Data da Conta</th>
												<th>Bloqueado?</th>
												<th>Ação</th>
											</tr>
										</thead>
										<tbody>

											<!--
											<tr class="odd gradeA">
												<td>Trident</td>
												<td>Internet Explorer 7</td>
												<td>Win XP SP2+</td>
												<td class="center">7</td>
												<td class="center">A</td>
											</tr>
											<tr class="even gradeA">
												<td>Trident</td>
												<td>AOL browser (AOL desktop)</td>
												<td>Win XP</td>
												<td class="center">6</td>
												<td class="center">A</td>
											</tr>
											<tr class="gradeA">
												<td>Gecko</td>
												<td>Firefox 1.0</td>
												<td>Win 98+ / OSX.2+</td>
												<td class="center">1.7</td>
												<td class="center">A</td>
											</tr>
											-->
										</tbody>
									</table>
									<!-- /.table-responsive -->

								</div>
								<!-- /.panel-body -->
							</div>
							<!-- /.panel -->

						</div>
					</div>
				</div>

			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->
	<!-- /#wrapper -->

	<div id="confirm" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header sem-borda">
					<button type="button" data-dismiss="modal" class="btn btn-danger" id="delete" style="float: right; margin-left: 8px">Delete</button>
					<button type="button" data-dismiss="modal" class="btn btn-warning" style="float: right;">Cancel</button>
					<h4 class="modal-title">Confirme para remover o utilizador&#46;</h4>
				</div>
				<!--<div class="modal-body">
					<p></p>
				</div>
				<div class="modal-footer">

				</div>-->
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<!-- Modal -->
	<div id="confirmUserRemovido" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-check" style="color:white; background-color:green;"></i>O utilizador foi removido com sucesso!</h4>
				</div>
			</div>
		</div>
	</div>
	<!-- fim modalConfirm -->


	<!-- <div id="confirm" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Remoção de Utilizador</h4>
				</div>
				<div class="modal-body">
					<p>Confirme para remover o utilizador</p>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Delete</button>
					<button type="button" data-dismiss="modal" class="btn btn-warning">Cancel</button>
				</div>
			</div>
		</div>
	</div>
	 -->

	<!-- links para os scrips ao final da página -->

	<!-- Gerar as linhas das tabelas dinamicamente -->
	<script src="js/lista-users.js"></script>

	<?php include 'includes/footer-links.php'; ?>
	<script src="lib/jquery-tabledit/jquery.tabledit.js"></script>

	<!-- DataTables JavaScript -->
	<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
	<script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
	<script>
		$(document).ready(function() {
			$('#dataTables').DataTable({
				responsive: true
			});
		});

	</script>
</body>
<!-- https://stackoverflow.com/questions/3345457/how-to-put-php-inside-javascript -->

</html>
