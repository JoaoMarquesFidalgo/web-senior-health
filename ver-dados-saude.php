<!-- DOCTYPE HTML e tag <head> -->
<!-- - - - - - - - - - - - - - - - -->
<?php include 'includes/header.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>SmartWalk - PTAW Grupo 1</title>
<script src="js/dados-saude.js">
</script>
</head>
<body>

    <div id="wrapper">
        <!-- top-menu e menu lateral -
        <!-- - - - - - - - - - - - - - - - -->
        <?php include 'includes/nav.php'; ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <h1 class="page-header">Ver dados de saúde</h1>
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Histórico de saúde <img src="img/Very-Basic-Info-icon.png" alt="imagem" style="width:20px; height:20px" title="Ao selecionar uma opção da lista de histórico de saúde, pode visualizar ou editar as suas fichas.">
                            </div>
                            <div class="panel-body">
                                <div id="parent" >

                                </div>
                                <div >

                                    <div class="col-lg-12">
                                        <form role="form" id="formPerfil" method="POST">
                                            <label>Selecione uma data para mudar o seu histórico de saúde</label><br>
                                            <?php
                                            include './scriptsPHP/option-dados-saude_option.php';
                                            ?>
                                            <?php
                                            include './scriptsPHP/option-dados-saude_historico.php';
                                            ?>


                                            <div class="col-lg-12"><br></div>


                                            <div class="col-lg-12" id="resultado" style="display:none">
                                                <div id="identificador"><?php echo $_SESSION['utente-id'] ?></div>
                                            </div>
                                            <div class="col-lg-6" id="resultado2" style="display:none">

                                            </div>
                                            <div class="col-lg-6" id="resultado3" style="display:none">

                                            </div>
                                        </form>

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
                    <!-- - - - - - - - - - - - - - - - -->
                    <?php include 'includes/footer-links.php'; ?>
                    </body>

                    </html>
