<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="index.html"><img src="img/logo2.png"></a>
	</div>

	<!-- /.navbar-header -->

	<ul class="nav navbar-top-links navbar-right">
		<?php if(isset($_SESSION["familiar-id"])&&isset($_SESSION["utente-id"])){
	echo '<button class="btn btn-primary butaoVoltar"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Voltar</button>';
	} ?>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
				<i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-user">
				<li><a href="perfil2.php"><i class="fa fa-user fa-fw"></i> Perfil</a>
				</li>
				<li><a href="dados-autenticacao.php"><i class="fa fa-gear fa-fw"></i> Autenticação</a>
				</li>
				<li class="divider"></li>
				<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
				</li>
			</ul>
			<!-- /.dropdown-user -->
		</li>
		<li class="dropdown notifications-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<i class="fa fa-bell-o"></i>
				<span class="label label-warning"><?php include 'scriptsPHP/countWarning.php'?></span>
			</a>
			<ul class="dropdown-menu">
				<li class="header">Você tem <?php include 'scriptsPHP/countWarning.php'?> Alertas</li>
				<li>
					<!-- inner menu: contains the actual data -->
					<ul class="menu">
						<li>
							<a href="#">
								<i class="fa fa-users text-aqua"></i> 5 new members joined today
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-users text-red"></i> 5 new members joined
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-shopping-cart text-green"></i> 25 sales made
							</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-user text-red"></i> You changed your username
							</a>
						</li>
					</ul>
				</li>
				<li class="footer"><a href="#">View all</a></li>
			</ul>
		</li>
		<!-- /.dropdown -->
	</ul>
	<!-- /.navbar-top-links -->

	<div class="navbar-default sidebar" role="navigation">
		<div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
				<li class="sidebar-search">
					<div class="input-group custom-search-form">
						<input type="text" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
					</div>
					<!-- /input-group -->
				</li>
				<li>
					<a href="inicio.php"><i class="fa fa-home fa-fw"></i> Início</a>
				</li>
				<li class="nivel">
					<a href="#"><i class="fa fa-h-square fa-fw"></i> Dados de Saúde<span class="fa arrow"></span></a>

					<ul class="nav nav-second-level">
						<li>
							<a href="ver-dados-saude.php"><i class="fa fa-angle-right fa-fw"></i>Visualizar Dados de Saúde</a>
						</li>
						<li>
							<a href="novo-dados-saude.php"><i class="fa fa-angle-right fa-fw"></i>Inserir Dados de Saúde</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="dados-biometricos.php"><i class="fa fa-heartbeat fa-fw"></i> Dados Biométricos</a>
				</li>
				<li>
					<a href="dados_atividade_fisica.php"><i class="fa fa-child fa-fw"></i> Dados de Atividade Física</a>
				</li>

				<!-- menu com second level pages -->
				<!--  <li class="active">
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="dados-saude.php">Dados de Saúde</a>
                                </li>
                                <li>
                                    <a href="editar-dados-saude.php">Editar Dados de Saúde</a>
                                </li>
                                <li>
                                    <a href="dados-biometricos.php">Dados Biométricos</a>
                                </li>
                                <li>
                                    <a href="dados_atividade_fisica.php">Dados de Atividade Física</a>
                                </li>
                            </ul> <!-- /.nav-second-level
                        </li> -->
			</ul>
		</div>
		<!-- /.sidebar-collapse -->
	</div>
	<!-- /.navbar-static-side -->
	<script>
		$(document).on("click", ".butaoVoltar", function() {
			$.ajax({
				url: "scriptsPHP/ajaxUnset.php",
				dataType: "json",
				type: "post",
				complete: function() {
					location.href = "familiar.php";
				}
			});
		});

	</script>
</nav>
