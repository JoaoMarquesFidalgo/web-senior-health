 $(document).ready(function () {

 	var emailAtual = "";
 	var senhaAtual = $('#pass').val();

 	$(document).on('click', '#editar-dados', function () {
 		$("#myModal").modal(); // aparece um modal ao clicar em editar
 	});

 	// focus no input quando aparece o modal
 	$('#myModal').on('shown.bs.modal', function () {
 		$('#senha').focus();
 	});
	 
 	// https://stackoverflow.com/questions/36821036/submit-button-in-bootstrap-form-doesnt-react-on-enter-key

 	$(document).on('click', '#cancelar', function () {
 		$('#email').prop("disabled", true);
 		$('#pass').prop("disabled", true);
 		$('#gravar').prop("disabled", true);
 		$('#gravar').css("opacity", 0.2);
 		$('#cancelar').prop("disabled", true);
 		$('#cancelar').css("opacity", 0.2);
 	});

 	// Obtem o e-mail a partir do id do user para exibir na caixa de texto bloqueada
 	$.ajax({
 		url: 'scriptsPHP/admin-autenticacao-obter.php',
 		type: 'post',
 		dataType: 'json',
 		success: function (data) {
 			console.log(data[0]['email']);
 			$('#email').val(data[0]['email']);
 			emailAtual = $('#email').val();
 		}
 	});

 	$(document).on('click', '#validar-senha', function () {
 		$.ajax({
 			url: 'scriptsPHP/admin-autenticacao-validar-senha.php',
 			type: 'post',
 			dataType: 'json',
 			data: {
 				email: $('#email').val(),
 				senha: $('#senha').val()
 			},
 			success: function (data) {
 				//console.log(data)
 				if (data['resposta'] === true) {
 					$("#myModal").modal('hide');
 					console.log(data);
 					$('.form-group input').prop("disabled", false);
 					$('#gravar').prop("disabled", false);
 					$('#gravar').css("opacity", 1);
 					$('#cancelar').prop("disabled", false);
 					$('#cancelar').css("opacity", 1);
 				} else {
 					// Aparece o modal de confirmação
 					$('#modalErro').modal();
					$('#modalErro .modal-content').css('border-color', 'rgb(255, 0, 0)');
 					// Depois de uns segundos, some
 					setTimeout(function () {
 						$('#modalErro').modal('hide');
 					}, 2500);
 				}
 			},
 			error: function (request, errorType, errorMessage) {
 				timeout: 500;
 				alert('Error: ' + errorType + ' with message: ' + errorMessage);
 			},
 			beforeSend: function () {
 				$('.is-loading').show(); // habilita a imagem de loading
 			},
 			complete: function () {
 				$('.is-loading').hide();
 			}
 		});
 	});

 	$(document).on('click', '#cancelar', function () {
 		$('#email').val(emailAtual);
 	});

 	$(document).on('click', '#gravar', function () {
 		//alert($('#pass').val().length);
 		$.ajax({
 			url: 'scriptsPHP/admin-autenticacao-gravar.php',
 			type: 'post',
 			data: {
 				email: $('#email').val(),
 				password: $('#pass').val()
 			},
 			dataType: 'json',
 			success: function (resp) {
 				//$('#email').val(data[0]['email']);
 				//alert("Alterado com sucesso!");
 				if (resp['status'] === true) {
 					// Aparece o modal de confirmação
 					$('#modalConfirm').modal();
 					// Depois de uns segundos, some
 					setTimeout(function () {
 						$('#modalConfirm').modal('hide');
 					}, 2500);
 					// https://stackoverflow.com/questions/19839335/bootstrap-hide-modal-after-delay
 				} else {
 					$('#modalErro').modal();
 					$('#modalErro .modal-content').css('border-color', 'rgb(255, 0, 0)');
 					$('#modalErro h4').html('<i class="fa fa-info-circle" style="color:red;"></i> ' + resp['msg']);
 					// Depois de uns segundos, some
 					setTimeout(function () {
 						$('#modalErro').modal('hide');
 					}, 5500);
 					//alert(resp['msg'])
 				}
 			},
 			error: function (resp) {
 				if (resp['status'] === false) {
 					$('#modalConfirm').modal();
 					//$('#modalConfirm h4').html()
 					// Depois de uns segundos, some
 					setTimeout(function () {
 						$('#modalConfirm').modal('hide');
 					}, 2500);
 					alert(resp['msg'])
 				}
 			}
 		});
 	});
 });
