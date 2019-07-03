$(document).ready(function () {
    $(document).on('change', '#select_data', function () {
        if ($(this).val() === "0") {
            $("#tirar").css("display", "block");
        } else {
            $("#tirar").css("display", "none");
        }
        var id = $(this).val();
        $.ajax({
            url: 'scriptsPHP/lista_por_id_hist.php',
            data: {'id': id},
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                var msg = "";
                var diabetes = "";
                var artrose = "";
                var espondiloartrose = "";
                var patologia_vascular = "";
                var patologia_respiratoria = "";
                var cancro = "";
                var depressao = "";
                var trombose = "";
                var outra = "";
                for (var i = 0; i < response.length; i++) {
                    msg +=
                            '<button type="button" class="btn btn-info" id="editar-dados">EDITAR</button>' +
                            '<button type="submit" class="btn btn-success" id="gravar" disabled style="opacity: 0.2;">GRAVAR</button>' +
                            '<button type="button" class="btn btn-warning" id="cancelar" disabled style="opacity: 0.2;">CANCELAR</button>';


                    (response[i].diabetes === "") ? diabetes = "---" : diabetes = response[i].diabetes;
                    (response[i].artrose === "") ? artrose = "---" : artrose = response[i].artrose;
                    (response[i].espondiloartrose === "") ? espondiloartrose = "---" : espondiloartrose = response[i].espondiloartrose;
                    (response[i].patologia_vascular === "") ? patologia_vascular = "---" : patologia_vascular = response[i].patologia_vascular;
                    (response[i].patologia_respiratoria === "") ? patologia_respiratoria = "---" : patologia_respiratoria = response[i].patologia_respiratoria;
                    (response[i].cancro === "") ? cancro = "---" : cancro = response[i].cancro;
                    (response[i].depressao === "") ? depressao = "---" : depressao = response[i].depressao;
                    (response[i].trombose === "") ? trombose = "---" : trombose = response[i].trombose;
                    (response[i].outra === "") ? outra = "---" : outra = response[i].outra;
                    msg += "<h3>Histórico</h3>";
                    msg += '<table id="tabledit" class="table-bordered table-striped table">'
                            + '<thead><tr style="display: none"><th style="width: 20%">ID</th>' + '<td style="width: 20%"><input type="text" id="id" name="id" value="' + response[i].id + '" style="width:100%" disabled>' + "</td>"
                            + '<thead><tr><th style="width: 20%">Data</th>' + '<td style="width: 20%"><input type="text" id="data" name="data" value="' + response[i].data + '" style="width:100%" disabled>' + "</td>"
                            + '<thead><tr><th style="width: 20%">Hipertensão Arterial</th>' + '<td style="width: 20%"><input type="text" id="hipertensao_arterial" name="hipertensao_arterial" value="' + response[i].hipertensao_arterial + '" style="width:100%" disabled>' + "</td>"
                            + '<thead><tr><th style="width: 20%">Diabetes</th>' + '<td style="width: 20%"><input type="text" id="diabetes" name="diabetes" value="' + diabetes + '" style="width:100%" disabled>' + "</td>"
                            + '<thead><tr><th style="width: 20%">Artrose</th>' + '<td style="width: 20%"><input type="text" id="artrose" name="artrose" value="' + artrose + '" style="width:100%" disabled>' + "</td>"
                            + '<thead><tr><th style="width: 20%">Espondiloartrose</th>' + '<td style="width: 20%"><input type="text" id="espondiloartrose" name="espondiloartrose" value="' + espondiloartrose + '" style="width:100%" disabled>' + "</td>"
                            + '<thead><tr><th style="width: 20%">Patologia Cardiovascular</th>' + '<td style="width: 20%"><input type="text" id="patologia_vascular" name="patologia_vascular" value="' + patologia_vascular + '" style="width:100%" disabled>' + "</td>"
                            + '<thead><tr><th style="width: 20%">Patologia Respiratória</th>' + '<td style="width: 20%"><input type="text" id="patologia_respiratoria" name="patologia_respiratoria" value="' + patologia_respiratoria + '" style="width:100%" disabled>' + "</td>"
                            + '<thead><tr><th style="width: 20%">Cancro</th>' + '<td style="width: 20%"><input type="text" id="cancro" name="cancro" value="' + cancro + '" style="width:100%" disabled>' + "</td>"
                            + '<thead><tr><th style="width: 20%">Depressão</th>' + '<td style="width: 20%"><input type="text" id="depressao" name="depressao" value="' + depressao + '" style="width:100%" disabled>' + "</td>"
                            + '<thead><tr><th style="width: 20%">Trombose</th>' + '<td style="width: 20%"><input type="text" id="trombose" name="trombose" value="' + trombose + '" style="width:100%" disabled>' + "</td>"
                            + '<thead><tr><th style="width: 20%">Outra</th>' + '<td style="width: 20%"><input type="text" id="outra" name="outra" value="' + outra + '" style="width:100%" disabled>' + "</td>"
                            ;

                }

                $("#resultado2").css("display", "block");
                $("#resultado2").html(msg);
            },
            error: function (xhr, status, error) {
                alert(error + " " + xhr + " " + status);
            }
        });
        $.ajax({
            url: 'scriptsPHP/lista_por_id_dor.php',
            data: {'id': id},
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                var msg = "";
                for (var i = 0; i < response.length; i++) {

                    //console.log(response[i]);
                    msg += "<br><br><h3>Dor</h3>";
                    msg += '<table id="tabledit" class="table-bordered table-striped table">'
                            + '<thead><tr><th style="width: 20%">Cabeça</th>' + '<td style="width: 20%"><input type="number" min="0" max="10" id="cabeca" name="cabeca" value="' + response[i].cabeca + '" disabled style="width:100%">' + "</td>"
                            + '<thead><tr><th style="width: 20%">Pescoço</th>' + '<td style="width: 20%"><input type="number" min="0" max="10" id="pescoco" name="pescoco" value="' + response[i].pesoco + '" disabled style="width:100%">' + "</td>"
                            + '<thead><tr><th style="width: 20%">Ombros</th>' + '<td style="width: 20%"><input type="number" min="0" max="10" id="ombros" name="ombros" value="' + response[i].ombros + '" disabled style="width:100%"> ' + "</td>"
                            + '<thead><tr><th style="width: 20%">Braços</th>' + '<td style="width: 20%"><input type="number" min="0" max="10" id="bracos" name="bracos" value="' + response[i].bracos + '" disabled style="width:100%">' + "</td>"
                            + '<thead><tr><th style="width: 20%">Punhos e Mãos</th>' + '<td style="width: 20%"><input type="number" min="0" max="10" id="punhos_maos" name="punhos_maos" value="' + response[i].punhos_maos + '" disabled style="width:100%"> ' + "</td>"
                            + '<thead><tr><th style="width: 20%">Coluna Torácica</th>' + '<td style="width: 20%"><input type="number" min="0" max="10" id="coluna_toracica" name="coluna_toracica" value="' + response[i].coluna_toracica + '" disabled style="width:100%">' + "</td>"
                            + '<thead><tr><th style="width: 20%">Lombar</th>' + '<td style="width: 20%"><input type="number" min="0" max="10" id="lombar" name="lombar" value="' + response[i].lombar + '" disabled style="width:100%">' + "</td>"
                            + '<thead><tr><th style="width: 20%">Anca</th>' + '<td style="width: 20%"><input type="number" min="0" max="10" id="anca" name="anca" value="' + response[i].anca + '" disabled style="width:100%">' + "</td>"
                            + '<thead><tr><th style="width: 20%">Coxa</th>' + '<td style="width: 20%"><input type="number" min="0" max="10" id="coxa" name="coxa" value="' + response[i].coxa + '" disabled style="width:100%">' + "</td>"
                            + '<thead><tr><th style="width: 20%">Joelho</th>' + '<td style="width: 20%"><input type="number" min="0" max="10" id="joelho" name="joelho" value="' + response[i].joelho + '" disabled style="width:100%">' + "</td>"
                            + '<thead><tr><th style="width: 20%">Tornozelos e Pés</th>' + '<td style="width: 20%"><input type="number" min="0" max="10" id="tornozelos_pes" name="tornozelos_pes" value="' + response[i].tornozelos_pes + '" disabled style="width:100%">' + "</td>"
                }

                $("#resultado3").css("display", "block");
                $("#resultado3").html(msg);

            },
            error: function (xhr, status, error) {
                alert(error + " " + xhr + " " + status);
            }
        });
    });

    $(document).on('click', '#editar-dados', function () {
        $("input").prop("disabled", false);
        $("#gravar").prop("disabled", false);
        $("#gravar").css("opacity", "1");
        $("#cancelar").prop("disabled", false);
        $("#cancelar").css("opacity", "1");
    });
    $(document).on('click', '#cancelar', function () {
        $("input").prop("disabled", true);
        $("#gravar").prop("disabled", true);
        $("#gravar").css("opacity", "0.2");
        $("#cancelar").prop("disabled", true);
        $("#cancelar").css("opacity", "0.2");
    });
    $(document).on('click', '#gravar', function (e) {
        e.preventDefault();
        console.log($("#formPerfil").serialize());



        $.ajax({
            url: 'scriptsPHP/editar_hist_dor.php',
            data: $("#formPerfil").serialize(),
            type: 'POST',
            success: function () {
                
                $('#modal1 .modal-header').empty();
                $('#modal1').modal();
                $('#modal1 .modal-header').append("<h4 class='modal-title'><i class='fa fa-check' style='color:white; background-color:green; aria-hidden='true'></i></i>Dados Atualizados com sucesso</h4>");
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

        /*
         $.post('scriptsPHP/editar_hist_dor.php', $("#formPerfil").serialize(), function (resp) {
         console.log(1);
         if (resp['status'] == true) {
         console.log(1);
         $('#modal1 .modal-header').empty();
         $('#modal1').modal();
         $('#modal1 .modal-header').append("<h4 class='modal-title'><i class='fa fa-check' style='color:white; background-color:green; aria-hidden='true'></i></i>Dados Atualizados com sucesso</h4>");
         setTimeout(function () {
         $('#modal1').modal('hide');
         }, 2500);
         
         } else {
         $('#modal1 .modal-header').empty();
         $('#modal1').modal();
         $('#modal1 .modal-header').append("<h4 class='modal-title'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i>Erro ao modificar os dados</h4>");
         setTimeout(function () {
         $('#modal1').modal('hide');
         }, 2500);
         }
         $("#cancelar").click();
         }, 'json');
         */
    });


});