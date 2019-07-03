<!-- DOCTYPE HTML e tag <head> -->
<?php include 'includes/header.php' ?>
<!-- - - - - - - - - - - - - - - - -->
<?php print_r($_SESSION); ?>
<?php if(!isset($_SESSION["familiar-id"])){
	header("Location: javascript://history.go(-1)");
} ?>

<title>SmartWalk - PTAW Grupo 1</title>
<style>
	.panel-familiar {
		width: 300px !important;
		margin: 5px 5px !important;
		display: inline-block !important;
	}
	
	#page-wrapper {
		margin: 0;
	}

</style>
</head>

<body>
	<div id="wrapper">

		<!-- top-menu e menu lateral -->
		<?php include 'includes/familiar-nav.php';?>
		<!-- - - - - - - - - - - - - - - - -->

		<!-- Page Content -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default" style="margin-top:15px;">
							<div class="panel-heading">
								Informações pessoais e da conta
							</div>
							<div class="panel-body" style="padding-left:20px;">
								<div class="row utentes">
									<!--append dos utentes dinamico-->
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

</body>
<script src="js/familiar.js"></script>

</html>
