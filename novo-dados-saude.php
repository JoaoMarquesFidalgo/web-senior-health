<!-- DOCTYPE HTML e tag <head> -->
<?php include 'includes/header.php'; ?>
<?php print_r($_SESSION); ?>
<!-- - - - - - - - - - - - - - - - -->
<title>SmartWalk - PTAW Grupo 1</title>

<link rel="stylesheet" href="css/dados-biometricos.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.js"></script>


<script src="js/jquery.js"></script>

<script>
    $(document).ready(function () {
        var erro = false;

        $("#hip_art").on("change", function () {
            if ($(this).val()) {
                $("#warning1").css("display", "none");
                $(this).parent().attr('class', 'form-group has-success');
                return false;
            }
        });


        //------------------------------------------------------
        //radio butons
        function compara(radio, input, bug, warning) {
            if ($("" + radio + ":checked").val() === "Sim") {
                $("" + input + "").parent().attr('class', 'form-group has-success');
                $("" + input + "").css("display", "block");
                $("" + bug + "").html("<br>");
            } else {
                $("" + input + "").css("display", "none");
                $("" + warning + "").css("display", "none");
                $("" + bug + "").empty();
            }
        }
        $(".radio_art").on('click', function () {
            compara(".radio_art", "#art", "#bug1", "#warning2");
        });

        $(".radio_pat_car").on('click', function () {
            compara(".radio_pat_car", "#pat_car", "#bug2", "#warning3");
        });

        $(".radio_can").on('click', function () {
            compara(".radio_can", "#can", "#bug3", "#warning4");
        });

        $(".radio_tro").on('click', function () {
            compara(".radio_tro:checked", "#tro_avc", "#bug4", "#warning5");
        });

        $(".radio_dia").on('click', function () {
            compara(".radio_dia:checked", "#dia", "#bug5", "#warning6");
        });

        $(".radio_esp").on('click', function () {
            compara(".radio_esp:checked", "#esp", "#bug6", "#warning7");
        });

        $(".radio_pat_res").on('click', function () {
            compara(".radio_pat_res:checked", "#pat_res", "#bug7", "#warning8");
        });

        $(".radio_dep").on('click', function () {
            compara(".radio_dep:checked", "#dep", "#bug8", "#warning9");
        });

        $(".radio_outra").on('click', function () {
            compara(".radio_outra:checked", "#outra", "#bug9", "#warning10");
        });

        //------------------------------------------------
        //on change muda inputs e warning
        function mudar(input, warning) {
            if ($("" + input + "").val()) {
                $("" + warning + "").css("display", "none");
                $("" + input + "").parent().attr('class', 'form-group has-success');
            }
        }

        $("#art").on('change', function () {
            mudar("#art", "#warning2");
        });

        $("#pat_car").on('change', function () {
            mudar("#pat_car", "#warning3");
        });

        $("#can").on('change', function () {
            mudar("#can", "#warning4");
        });

        $("#tro_avc").on('change', function () {
            mudar("#tro_avc", "#warning5");
        });

        $("#dia").on('change', function () {
            mudar("#dia", "#warning6");
        });

        $("#esp").on('change', function () {
            mudar("#esp", "#warning7");
        });

        $("#pat_res").on('change', function () {
            mudar("#pat_res", "#warning8");
        });

        $("#dep").on('change', function () {
            mudar("#dep", "#warning9");
        });

        $("#outra").on('change', function () {
            mudar("#outra", "#warning10");
        });





        //----------------------------------------------
        //Checkar campos
        function checkar(radio, input, warning) {
            if ($("" + radio + ":checked").val() === "Sim" && !$("" + input + "").val()) {
                $("" + input + "").parent().attr('class', 'form-group has-error');
                $("" + warning + "").css("display", "block");
                erro = true;
            }
            return erro;
        }

        $("#gravar").on("click", function (e) {
            erro = false;
            if (!$("#hip_art").val()) {
                $("#hip_art").parent().attr('class', 'form-group has-error');
                $("#warning1").css("display", "block");
                erro = true;
            }
            checkar(".radio_art", "#art", "#warning2");
            checkar(".radio_pat_car", "#pat_car", "#warning3");
            checkar(".radio_can", "#can", "#warning4");
            checkar(".radio_tro", "#tro_avc", "#warning5");
            checkar(".radio_dia", "#dia", "#warning6");
            checkar(".radio_esp", "#esp", "#warning7");
            checkar(".radio_pat_res", "#pat_res", "#warning8");
            checkar(".radio_dep", "#dep", "#warning9");
            checkar(".radio_outra", "#outra", "#warning10");
            if (erro === true) {
                return false;
            }
            e.preventDefault();
        console.log($("#formPerfil").serialize());



        $.ajax({
            url: 'scriptsPHP/inserirDadosSaude.php',
            data: $("#inserirDadosSaude").serialize(),
            type: 'POST',
            success: function () {
                
                $('#modal1 .modal-header').empty();
                $('#modal1').modal();
                $('#modal1 .modal-header').append("<h4 class='modal-title'><i class='fa fa-check' style='color:white; background-color:green; aria-hidden='true'></i></i>Dados Inseridos com sucesso</h4>");
                setTimeout(function () {
                    $('#modal1').modal('hide');
                    
                }, 2500);

            },
            error: function (xhr, status, error) {
                alert(error + " " + xhr + " " + status);
            }
        });
        setTimeout(function(){
            document.location.reload();
        }, 2500);
            
        });


        //------------------------------------------------
        //cancelar
        $("#cancelar").on("click", function () {
            location.reload();
        });


        //------------------------------------------------
        //aparece dores
        $("#aparece_ao_conf").css("display", "none");
        $(document).on('click', "#btn_sim", function () {
            if ($("#btn_sim").text() == "Sim" || $("#btn_sim").text() == "") {
                $("#aparece_ao_conf").css("display", "block");
                $("#btn_sim").text("Não");
                $('#btn_sim').attr('class', 'btn btn-warning');

            } else {
                $("#aparece_ao_conf").css("display", "none");
                $("#btn_sim").text("Sim");
                $('#btn_sim').attr('class', 'btn btn-success');
                $("#aparece_ao_conf input").val("0");

            }
        });
    });
</script>

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

    .form-control{
        width: 75%;
    }

    #aparece_ao_conf .form-control{
        width:75%;
    }

    .subtitulo{
        margin-top:5px
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
                        <h1 class="page-header">Dados de saúde</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <!-- ------------------- FORMULARIO ------------------- -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Inserir nova ficha de <?php
                                echo $_SESSION['user-nome'];
                                ?>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <form id="inserirDadosSaude" method="POST">
                                        <div class="col-lg-6">
                                            <div>
                                                <div class="form-group">
                                                    <label>Hipertensão Arterial: </label><br>
                                                    <div class="form-group has-success">
                                                        <input type="text" name="hip_art" class="form-control" style="width:75%; float:left;" id="hip_art" placeholder="Exemplo: 13/8"><img src="img/warning.png" id="warning1" style="display:none; height:34px; width: 34px; float:left" title="Escreva a sua tensão">
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="form-group">
                                                    <label class="subtitulo">Artrose</label><br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="artrose" class="radio_art" id="optionsRadiosInline1" value="Sim">Sim
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="artrose" class="radio_art" id="optionsRadiosInline2" value="Não" checked>Não
                                                    </label><br>
                                                    <div class="form-group has-success">
                                                        <input type="text" name="art" class="form-control" style="width:75%; float:left; display:none; " id="art" placeholder="Exemplo: Joelho, Coluna"><img src="img/warning.png" id="warning2" style="display:none; height:34px; width: 34px; float:left" title="Se tiver artrose, por favor escreva o tipo">
                                                    </div><div id="bug1"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="subtitulo">Patologia Cardiovascular</label><br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="pat_card" class="radio_pat_car" id="optionsRadiosInline1" value="Sim">Sim
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="pat_card" class="radio_pat_car" id="optionsRadiosInline2" value="Não" checked>Não
                                                    </label><br>
                                                    <div class="form-group has-success">
                                                        <input type="text" id="pat_car" name="pat_car" style="width:75%; float:left; display:none; " class="form-control"  placeholder="Exemplo: Pulmao"><img src="img/warning.png" id="warning3" style="display:none; height:34px; width: 34px; float:left" title="Se tiver artrose, por favor escreva o tipo">

                                                    </div><div id="bug2"></div>
                                                </div>



                                                <div class="form-group">
                                                    <label class="subtitulo">Cancro</label><br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="cancro" class="radio_can" id="optionsRadiosInline1" value="Sim">Sim
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="cancro" class="radio_can" id="optionsRadiosInline2" value="Não" checked>Não
                                                    </label><br>
                                                    <div class="form-group has-success">
                                                        <input type="text" id="can" name="can" style="width:75%; float:left; display:none; " class="form-control"  placeholder="Exemplo: Pulmao"><img src="img/warning.png" id="warning4" style="display:none; height:34px; width: 34px; float:left" title="Se tiver artrose, por favor escreva o tipo">

                                                    </div><div id="bug3"></div>
                                                </div>



                                                <div class="form-group">
                                                    <label class="subtitulo">Trombose / AVC</label><br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="tro" class="radio_tro" id="optionsRadiosInline1" value="Sim">Sim
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="tro" class="radio_tro" id="optionsRadiosInline2" value="Não" checked>Não
                                                    </label><br>
                                                    <div class="form-group has-success">
                                                        <input type="text" id="tro_avc" style="width:75%; float:left; display:none; " name="tro_avc" class="form-control"  placeholder="Exemplo: Cerebral"><img src="img/warning.png" id="warning5" style="display:none; height:34px; width: 34px; float:left" title="Se tiver artrose, por favor escreva o tipo">


                                                    </div><div id="bug4"></div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div>
                                                <div class="form-group">
                                                    <label class="subtitulo">Diabetes</label><br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="diabetes" class="radio_dia" id="optionsRadiosInline1" value="Sim">Sim
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="diabetes" class="radio_dia" id="optionsRadiosInline2" value="Não" checked>Não
                                                    </label><br>
                                                    <div class="form-group has-success">
                                                        <input type="text" id="dia" style="width:75%; float:left; display:none; " name="dia" class="form-control"  placeholder="Exemplo: Cerebral"><img src="img/warning.png" id="warning6" style="display:none; height:34px; width: 34px; float:left" title="Se tiver artrose, por favor escreva o tipo">
                                                    </div><div id="bug5"></div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="subtitulo">Espondilartrose</label><br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="espo" class="radio_esp" id="optionsRadiosInline1" value="Sim">Sim
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="espo" class="radio_esp" id="optionsRadiosInline2" value="Não" checked>Não
                                                    </label><br>
                                                    <div class="form-group has-success">
                                                        <input type="text" id="esp" style="width:75%; float:left; display:none; " name="esp" class="form-control"  placeholder="Exemplo: Cervical"><img src="img/warning.png" id="warning7" style="display:none; height:34px; width: 34px; float:left" title="Se tiver artrose, por favor escreva o tipo">
                                                    </div><div id="bug6"></div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="subtitulo">Patologia Respiratoria</label><br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="pat_resp" class="radio_pat_res" id="optionsRadiosInline1" value="Sim">Sim
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="pat_resp" class="radio_pat_res" id="optionsRadiosInline2" value="Não" checked>Não
                                                    </label><br>
                                                    <div class="form-group has-success">
                                                        <input type="text" id="pat_res" style="width:75%; float:left; display:none; " name="pat_res" class="form-control"  placeholder="Exemplo: Cervical"><img src="img/warning.png" id="warning8" style="display:none; height:34px; width: 34px; float:left" title="Se tiver artrose, por favor escreva o tipo">
                                                    </div><div id="bug7"></div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="subtitulo">Depressão</label><br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="depr" class="radio_dep" id="optionsRadiosInline1" value="Sim">Sim
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="depr" class="radio_dep" id="optionsRadiosInline2" value="Não" checked>Não
                                                    </label><br>
                                                    <div class="form-group has-success">
                                                        <input type="text" id="dep" style="width:75%; float:left; display:none; " name="dep" class="form-control"  placeholder=""><img src="img/warning.png" id="warning9" style="display:none; height:34px; width: 34px; float:left" title="Se tiver artrose, por favor escreva o tipo">
                                                    </div><div id="bug8"></div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="subtitulo">Outra(especifique)</label><br>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="outra" class="radio_outra" id="optionsRadiosInline1" value="Sim">Sim
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="outra" class="radio_outra" id="optionsRadiosInline2" value="Não" checked>Não
                                                    </label><br>
                                                    <div class="form-group has-success">
                                                        <input type="text" id="outra" style="width:75%; float:left; display:none; " name="outra" class="form-control"  placeholder=""><img src="img/warning.png" id="warning10" style="display:none; height:34px; width: 34px; float:left" title="Se tiver artrose, por favor escreva o tipo">
                                                    </div><div id="bug9"></div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-lg-12" class="checkbtn_sim">

                                            <div style="margin:auto;width:500px">
                                                <br><br>
                                                <label style="font-size: 30px">Teve dor na ultima semana?</label><br>
                                                <div style="width:200px; margin:auto"> 
                                                    <button type="button" class="btn btn-success" id="btn_sim">Sim</button>
                                                </div>
                                            </div>
                                            <div id="aparece_ao_conf">
                                                <br>
                                                <label>
                                                    Considere apenas os locais onde sente dor neste momento e indique a intensidade da dor atribuindo um numero entre 0 (sem dor) e 10 (pior dor imaginavel):
                                                </label>

                                                <div class="col-xs-6">                                               


                                                    <div id="main_skeleton_joint_div">
                                                        <div style="overflow: hidden; float:left;">
                                                            <img id="body_hand_foot_image" src="img/body_hand_foot_highlights_75p.jpg"  usemap="#joint_map_name" alt="Skeleton joint image" />
                                                        </div>

                                                    </div>

                                                    <map id="jointMap" name="joint_map_name">
                                                        <area alt="HEAD" href="#" joint="HEAD" full="HEAD" class="HEAD" shape="poly" coords="337,52,320,58,311,65,308,100,326,136,336,136,346,136,366,100,365,69,362,58" />

                                                        <area alt="L THIGH" href="#" joint="L THIGH" full="L THIGH" shape="poly" coords="374,419,357,515,387,515,404,419" />
                                                        <area alt="R THIGH" href="#" joint="R THIGH" full="R THIGH" shape="poly" coords="270,419,282,515,312,515,300,419" />

                                                        <area alt="L HAND" href="#" joint="L HAND" full="L HAND" shape="poly" coords="466,390,472,397,472,439,477,439,481,419,480,396,479,403,485,445,490,445,489,419,499,448,504,448,501,424,511,440,516,440,504,404,515,417,520,417,518,406,509,394,492,380" />
                                                        <area alt="R HAND" href="#" joint="R HAND" full="R HAND" shape="poly" coords="181,382,167,392,156,414,161,414,172,402,157,436,162,436,174,423,170,445,175,445,182,424,184,446,189,446,194,424,197,442,202,442,203,418,203,400,205,387" />


                                                        <area alt="Left SI Joint" href="#" joint="Left SI Joint" full="Left SI Joint" shape="poly" coords="354,355,354,336,358,334,360,330,362,341,362,356,359,362,351,362" />
                                                        <area alt="Right SI Joint" href="#" joint="Right SI Joint" full="Right SI Joint" shape="poly" coords="314,330,317,333,320,335,320,353,324,362,320,362,317,362,312,356,312,344"/>
                                                        <area alt="Left Knee" href="#" joint="Left Knee" full="Left Knee" shape="poly" coords="386,530,389,537,393,544,391,556,388,563,388,569,373,569,359,566,356,560,359,557,353,551,354,543,359,537,361,532"/>
                                                        <area alt="Right Knee" href="#" joint="Right Knee" full="Right Knee" shape="poly" coords="287,535,297,532,314,530,320,542,321,551,317,566,300,569,287,570,287,564,284,556,282,550,282,543" />


                                                        <area alt="Right Shoulder" href="#" joint="Right Shoulder" full="Right Shoulder" shape="poly" coords="263,163,271,161,277,161,282,169,283,181,276,191,270,186,263,191,254,182,254,173,257,168,260,165" />
                                                        <area alt="Left Shoulder" href="#" joint="Left Shoulder" full="Left Shoulder" shape="poly" coords="407,161,413,164,417,167,418,169,422,173,422,180,421,185,410,189,405,186,401,188,393,185,390,176,389,170,389,164,396,161,402,160" />

                                                        <area alt="Left SC" href="#" joint="Left SC" full="Left SC" shape="poly" coords="345,169,352,171,355,177,352,182,345,184,339,180,340,173" />
                                                        <area alt="Right SC" href="#" joint="Right SC" full="Right SC" shape="poly" coords="325,169,332,171,335,177,332,182,325,184,319,180,320,173" />

                                                        <area alt="Left Hip" href="#" joint="Left Hip" full="Left Hip" shape="poly" coords="369,370,377,369,383,374,385,378,385,381,383,386,380,390,378,392,374,392,370,389,367,386,365,382,365,377" />
                                                        <area alt="Right Hip" href="#" joint="Right Hip" full="Right Hip" shape="poly" coords="290,373,294,370,298,368,302,369,308,373,311,379,310,383,307,389,302,392,297,391,292,387,290,383,288,377" />

                                                        <area alt="C-Spine" href="#" joint="C-Spine" full="C-Spine" class="C-Spine" 
                                                              shape="poly" coords="323,166,323,158,324,148,323,141,326,135,333,137,341,137,348,135,352,140,351,148,350,156,352,166,344,167,331,168" />

                                                        <area alt="T-Spine" href="#" joint="T-Spine" full="T-Spine" shape="poly" 
                                                              coords="328,291,329,285,322,288,320,284,329,280,329,275,326,272,326,267,327,263,327,258,327,254,327,250,326,237,326,232,326,227,325,221,324,201,328,192,323,190,324,188,330,188,351,188,351,191,348,192,351,200,350,220,350,231,347,249,347,254,347,258,347,264,348,266,349,271,346,275,346,281,354,284,354,288,348,287,346,286,347,291" />

                                                        <area alt="L-Spine" href="#" joint="L-Spine" full="L-Spine" shape="poly" 
                                                              coords="327,343,328,337,321,335,317,330,320,327,324,328,327,331,328,326,317,322,317,317,323,317,328,317,328,313,320,313,317,311,317,306,323,306,328,305,328,299,323,300,320,299,320,294,324,293,329,292,344,292,350,293,355,294,355,299,351,301,347,299,347,304,348,307,353,306,358,308,357,312,350,312,347,312,347,317,351,317,357,317,357,322,351,324,347,325,347,330,353,327,357,329,355,334,347,336,347,338,347,341,347,344,341,347,331,347"/>

                                                        <area alt="Left Arm" href="#" joint="Left Arm" full="Left Arm" shape="poly" coords="428,287,439,281,444,282,449,287,450,293,487,372,493,380,496,383,488,386,472,387,470,386,467,381,433,308,431,302,428,300,424,294,426,290" />
                                                        <area alt="Right Arm" href="#" joint="Right Arm" full="Right Arm" shape="poly" coords="231,282,246,285,255,293,207,383,211,389,195,388,185,386,179,384,182,380 ///,220,304,223,296,225,290,227,287" />





                                                        <area alt="Left Ankle" href="#" joint="Left Ankle" full="Left Ankle" shape="poly" coords="350,695,372,694,371,706,373,710,354,709,350,709,350,701" />    
                                                        <area alt="Right Ankle" href="#" joint="Right Ankle" full="Right Ankle" shape="poly" coords="302,698,313,693,323,693,325,702,324,708,313,710,303,708" />



                                                    </map>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>Cabeça</label> <br>
                                                    <input type="number" name="cabeca" id="cabeca" min="0" max="10" class="form-control number" value="0">
                                                    <br>
                                                    <label>Pescoco</label> <br>
                                                    <input type="number" id="pescoco" min="0" max="10" name="pescoco" class="form-control number" class="input_dor" value="0">
                                                    <br>
                                                    <label>Ombros</label> <br>
                                                    <input type="number" id="ombros" name="ombros" min="0" max="10" class="form-control" value="0">
                                                    <br>
                                                    <label>Bracos</label> <br>
                                                    <input type="number" id="bracos" name="bracos" min="0" max="10" class="form-control" value="0">
                                                    <br>
                                                    <label>Punhos e maos</label> <br>
                                                    <input type="number" id="punhos_maos" name="punhos_maos" min="0" max="10" class="form-control" value="0">
                                                    <br>
                                                    <label>Coluna toracica</label> <br>
                                                    <input type="number" id="coluna_toracica" name="coluna_toracica" min="0" max="10" class="form-control" value="0">
                                                    <br>

                                                    <label>Lombar</label> <br>
                                                    <input type="number" id="lombar" min="0" max="10" name="lombar" class="form-control" value="0">
                                                    <br>
                                                    <label>Anca</label> <br>
                                                    <input type="number" id="anca" min="0" max="10" name="anca" class="form-control" value="0">
                                                    <br>
                                                    <label>Coxa</label> <br>
                                                    <input type="number" id="coxa" min="0" max="10" name="coxa" class="form-control" value="0">
                                                    <br>
                                                    <label>Joelho</label> <br>
                                                    <input type="number" id="joelho" min="0" max="10" name="joelho" class="form-control" value="0">
                                                    <br>
                                                    <label>Tornozelos e pes</label> <br>
                                                    <input type="number" id="tornozelos_pes" min="0" max="10" name="tornozelos_pes" class="form-control" value="0">
                                                    <br>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-12"><br></div>
                                        <div style="clear:both">
                                            <div class="form-group" style="text-align: left;">
                                                <br><br>
                                                <button type="submit" class="btn btn-success" id="gravar">GRAVAR</button>
                                                <button type="button" class="btn btn-danger" id="cancelar">CANCELAR</button>
                                            </div>
                                        </div>


                                    </form>
                                </div>
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
    </div>
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
<?php include 'includes/footer-links.php'; ?>
<!-- - - - - - - - - - - - - - - - -->

</body>

<script src="image_mapster/javascripts/jquery.imagemapster.js" type="text/javascript"></script>
<script src="image_mapster/javascripts/SkeletonJointMapping.js" type="text/javascript"></script>

</html>
