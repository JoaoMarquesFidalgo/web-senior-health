$(document).ready(function () {
	$('#file-upload').prop("disabled", true);
	$('.custom-file-upload').css('opacity', '0.6');
	$('.custom-file-upload').css('cursor', 'default');
	var one = true;

	$(document).on("click","#inputImage",function(e){
		e.preventDefault();
	});

	$.ajax({
		url: "scriptsPHP/listar_info_perfil.php",
		dataType: "json",
		type: "post",
		success: function (data) {
			console.log(data[0]);
			if (tipo == "familiar") {
				$("#nomeP").val(data[0]["nome"]);
				$("#dataP").val(data[0]["data_nascimento"]);
				if (data[0]["gender"] == "Masculino") {
					$("#masculino").prop("checked", true);
				} else {
					$("#feminino").prop("checked", true);
				}
				if (data[0]["image"] == '' || data[0]["image"] == null) {
					$("#imgDiv").append("<img src='img/man.png' id='img' class='img-thumbnail'>");
				} else {
					console.log(data[0]["image"]);
					$("#imgDiv").append("<img src=" + data[0]["image"] + " id='img' width='180' height='140' class='img-thumbnail'>");
				}
				$(".panelFamiliar").remove();
				$(".ut").empty();
			} else if (tipo == "utente") {
				$("#nomeP").val(data[0]["nome"]);
				$("#dataP").val(data[0]["data_nascimento"]);
				if (data[0]["image"] == '' || data[0]["image"] == null) {
					$("#imgDiv").append("<img src='img/man.png' id='img' class='img-thumbnail'>");
				} else {
					console.log(data[0]["image"]);
					$("#imgDiv").append("<img src=" + data[0]["image"] + " id='img' width='180' height='140' class='img-thumbnail'>");
				}

				if (data[0]["computador_ou_tablet"] == "1") {
					$("#pcs").prop("checked", true);
				} else {
					$("#pcn").prop("checked", true);
				}

				if (data[0]["gender"] == "Masculino") {
					$("#masculino").prop("checked", true);
				} else {
					$("#feminino").prop("checked", true);
				}
				if (data[0]["telemovel"] == 0) {
					$("#telemovelNao").prop("checked", true);
				} else if (data[0]["telemovel"] == 1) {
					$("#telemovelSim").prop("checked", true);
					$("#chamadas").prop("checked", true);
				} else if (data[0]["telemovel"] == 2) {
					$("#telemovelSim").prop("checked", true);
					$("#chamadas").prop("checked", true);
					$("#sms").prop("checked", true);
				} else if (data[0]["telemovel"] == 3) {
					$("#telemovelSim").prop("checked", true);
					$("#chamadas").prop("checked", true);
					$("#sms").prop("checked", true);
					$("#internet").prop("checked", true);
				}

				if (data[0]["descricao"] == "Não sabe ler nem escrever") {
					$(".edformal")[0].selectedIndex = 1;
				} else if (data[0]["descricao"] == "Sabe ler e escrever") {
					$(".edformal")[0].selectedIndex = 2;
				} else if (data[0]["descricao"] == "4 ºano de escolaridade") {
					$(".edformal")[0].selectedIndex = 3;
				} else if (data[0]["descricao"] == "6 ºano de escolaridade") {
					$(".edformal")[0].selectedIndex = 4;
				} else if (data[0]["descricao"] == '9º ano de escolaridade') {
					$(".edformal")[0].selectedIndex = 5;
				} else if (data[0]["descricao"] == '12ºano de escolaridade') {
					$(".edformal")[0].selectedIndex = 6;
				} else if (data[0]["descricao"] == "Bacharelato/Licenciatura") {
					$(".edformal")[0].selectedIndex = 7;
				} else {
					$(".edformal")[0].selectedIndex = 8;
					$("#outroedformal").css('display', 'block');
					$("#outro").attr("required", true);
					$("#outro").val(data[0]["descricao"]);
				}
			}
		}
	});

	$("#edformal").change(function () {
		if ($('#edformal option:selected').text() == "Outro") {
			$("#outroedformal").css('display', 'block');
			$("#outro").attr("required", true);
		} else {
			$("#outroedformal").css('display', 'none');
			$("#outro").attr("required", false);
		}
	});
	$(document).on("click", "#gravar", function (e) {
		e.preventDefault();
		console.log($("#formPerfil").serialize());
		var formData = new FormData($('#formPerfil')[0]);
		formData.append('inputImage', $('input[type=file]')[0].files[0]);

		$.ajax({
			url: "scriptsPHP/editarperfil2.php",
			dataType: "json",
			type: "post",
			processData: false,
			contentType: false,
			data: formData,
			success: function (data) {
				if (data['status'] == true) {
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
			}
		});
	});

	$(document).on("click", "#removeImage", function () {
		$.ajax({
			url: "scriptsPHP/deleteFoto.php",
			dataType: "json",
			type: "post",
			success: function (data) {
				$("#imgDiv").empty();
				$("#imgDiv").append("<img src='img/man.png' id='img' class='img-thumbnail'>");
			}
		});
	});

	$('input[type=radio][name=telemovel]').change(function () {
		if (this.value == '1') {
			$("#chamadas").prop("disabled", true);
			$("#sms").prop("disabled", false);
			$("#internet").prop("disabled", false);

			$("#chamadas").prop("checked", true);
		} else if (this.value == '0') {
			$("#chamadas").prop("disabled", true);
			$("#sms").prop("disabled", true);
			$("#internet").prop("disabled", true);

			$("#chamadas").prop("checked", false);
			$("#sms").prop("checked", false);
			$("#internet").prop("checked", false);
		}
	});

	$('#internet').change(function () {
		if ($(this).is(":checked")) {
			$("#sms").prop("checked", true);
		}
	});

	$('#sms').change(function () {
		if (!$(this).is(":checked")) {
			$("#internet").prop("checked", false);
		}
	});


	//---------------------------------------

	$.ajax({
		url: "scriptsPHP/verificar-familiar-associado.php",
		dataType: "json",
		type: "post",
		success: function (data) {
			if (data["resp"] == true) {
				$("#infoFamiliar").append("<button type='button' id='familiar' class='btn btn-primary'>Adicionar Familiar</button>");
				$("#infoFamiliar").append("<label class='control-label' id='labelMSG'>Marque esta opção para adicionar um familiar</label>");
			} else {
				$("#container").removeClass("hidden");
				listarInfo();
			}
		}
	});

	$(document).on('click', '#removeFamiliar', function () {
		$.ajax({
			url: "scriptsPHP/removerFamiliarAssociado.php",
			dataType: "json",
			type: "post",
			success: function (data) {
				$('#confirm-delete').modal('hide');
				$(".modal-body.message").empty();
				$('#popupModalTitle').text("Sucesso!");
				$(".modal-body.message").append("Familiar eliminado com sucesso!");
				$('#popupModal').modal('show');
				//// ainda n testado BURRO TESTA ISTO CRLH
				$("#container").addClass("hidden");
				$("#infoFamiliar").empty();
				$("#infoFamiliar").removeClass("hidden");
				$(".tbl").empty();
				$("#infoFamiliar").append("<button type='button' id='familiar' class='btn btn-primary'>Adicionar Familiar</button>");
				$("#infoFamiliar").append("<label class='control-label' id='labelMSG'>Marque esta opção para adicionar um familiar</label>");
				one = true;
			}
		});

	});

	$(document).on('click', '#familiar', function () {
		$("#labelMSG").hide("labelMSG");
		$("#infoFamiliar button").addClass("adicionar-familiar");
		$('#add-familiar').show(500);
		$("#inserir-familiar").show(500);
		$(this).removeAttr('id');
	});

	$(document).on("change", ".inputErro", function () {
		$(this).removeClass("inputErro");
	});

	$(document).on("click", ".adicionar-familiar", function (event) {
		event.preventDefault();

		//1 envia email
		if ($("#emailF").val() != "" && one == true) {
			//verifica se familiar ja existe
			$.ajax({
				url: "scriptsPHP/verifica-familiar-email.php",
				dataType: "json",
				type: "post",
				data: {
					email: $("#emailF").val()
				},
				success: function (data) {
					console.log(data);
					if (data['resp'] == false) {
						$("#inserir-familiar div").removeClass("hidden");
					} else {
						// caso o email exista, associar logo o familiar
						$.ajax({
							url: "scriptsPHP/associar-familiar.php",
							dataType: "json",
							type: "post",
							data: {
								emailF: $("#emailF").val()
							},
							success: function () {
								//mostrar o user associado
								$(".modal-body.message").empty();
								$('#popupModalTitle').text("Sucesso!");
								$(".modal-body.message").append("Familiar adicionado com sucesso!");
								$('#popupModal').modal('show');
								//
								$("#inserir-familiar").hide(500);
								$("#emailF").val("");
								$("#infoFamiliar").addClass("hidden");
								$("#container").removeClass("hidden");
								listarInfo();
							}
						});
					}
				}
			});
			one = false;
		}

		var status = true;
		$("#inserir-familiar").find('input').each(function (idx, elem) {
			if ($(elem).val().length == 0) {
				$(this).addClass("inputErro");
				status = false;
			}
		});
		//associa familiar caso ele ainda não exista
		if (status == true) {
			$.post('scriptsPHP/associar-familiar.php', $('#inserir-familiar').serialize(), function (resp) {
				console.log($('#inserir-familiar').serialize());
				if (resp['status'] === false) {
					$(".modal-body.message").empty();
					$.each(resp['msg'], function (index, value) {
						$(".modal-body.message").append(value + '<br>');
						$('#popupModal').modal('show');
					});
				} else if (resp['status'] === true) {
					$(".modal-body.message").empty();
					$('#popupModalTitle').text("Sucesso!");
					$(".modal-body.message").append("Registo introduzido com sucesso!");
					$('#popupModal').modal('show');

					$("#inserir-familiar").hide(500);
					$('#inserir-familiar div').find('input').val('');
					$("#infoFamiliar").addClass("hidden");
					$("#container").removeClass("hidden");
					listarInfo();
				}
			}, 'json');
		}
	});

});

function listarInfo() {
	$.ajax({
		url: "scriptsPHP/listar_familiar.php",
		dataType: "json",
		type: "post",
		success: function (data) {
			$(".tbl").empty();
			$(".tbl").append("<tbody> <tr><td> Nome: </td><td> " + data[0].nome + " </td></tr> <tr><td> Data Registo: </td> <td> " + data[0].data_conta + " </td></tr> <tr><td> Email: </td><td> " + data[0].email + " </td> </tr> <tr><td> Sexo: </td> <td> " + data[0].gender + " </td></tr></tbody>");
		}
	});
}
