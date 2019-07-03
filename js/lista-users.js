$.ajax({
	url: 'scriptsPHP/lista-users.php',
	dataType: 'json',
	type: 'post',
	success: function (dados) {
		//id, nome, data_nascimento, gender, email, password, data_conta, bloqueado, tipo
		$.each(dados, function (i, value) {

			var block = "";
			if (value.bloqueado == "0")
				block = "Não";
			else
				block = "Sim";

			// glyphicon glyphicon-ban-circle 
			// glyphicon glyphicon-ok 

			if (block == "Não") {
				$('#dataTables tbody').append(
					"<tr class='gradeA'>" +
					"<td class='id-user'>" + value.id + "</td>" +
					"<td>" + value.tipo + "</td>" +
					"<td>" + value.nome + "</td>" +
					"<td>" + value.email + "</td>" +
					"<td>" + value.data_conta + "</td>" +
					"<td class='estado-bloqueio'>" + block + "</td>" +
					"<td class='xxx'>" +
					"<div class='btn-group btn-group-sm'>" +
					"<button type='button' class='tabledit-ban-button btn btn-sm btn-default o' style='float: none;'><span class='glyphicon glyphicon-ok'></span></button>" +
					"<button type='button' class='tabledit-ban-button btn btn-sm btn-default x' style='float: none;'><span class='glyphicon glyphicon-remove'></span></button>" +
					"</div>" +
					"</td>" +
					"</tr>"
				);
				//console.log(value);
			} else {
				$('#dataTables tbody').append(
					"<tr class='gradeA'>" +
					"<td class='id-user'>" + value.id + "</td>" +
					"<td>" + value.tipo + "</td>" +
					"<td>" + value.nome + "</td>" +
					"<td>" + value.email + "</td>" +
					"<td>" + value.data_conta + "</td>" +
					"<td>" + block + "</td>" +
					"<td class='xxx'>" +
					"<div class='btn-group btn-group-sm'>" +
					"<button type='button' class='tabledit-ban-button btn btn-sm btn-default o-bloqueado'><span class='glyphicon glyphicon-ban-circle'></span></button>" +
					"<button type='button' class='tabledit-ban-button btn btn-sm btn-default x' style='float: none;'><span class='glyphicon glyphicon-remove'></span></button>" +
					"</div>" +
					"</td>" +
					"</tr>"
				);
			}
		});
	}
});

$(document).ready(function () {

	// --------------------------------------------------------------
	// Acao de clicar no buton verde para bloquear um user
	// --------------------------------------------------------------
	$(document).on('click', '.o', function () {

		var idUser = $(this).closest('tr').find('td.id-user').text();
		//alert('clicou no user ' + idUser)
		$.ajax({
			url: "scriptsPHP/user-bloquear.php",
			dataType: 'json',
			type: 'post',
			data: {
				id: idUser
			},
			success: function (data) {
				//alert('mudou o bloqueio');
				console.log('O id é ' + idUser);
				location.reload();

				/*$('td:contains("'+idUser+'")').closest('tr').find('td.xxx').find('button.o').addClass('o-bloqueado');
				$('td:contains("'+idUser+'")').closest('tr').find('td.xxx').find('button.o').removeClass('o');
				$('td:contains("'+idUser+'")').closest('tr').find('td.estado-bloqueio').text("Sim");*/
				
			}
		}); // fim ajax
	});

	// --------------------------------------------------------------
	// Acao de clicar no circle buton para desbloquear um user
	// --------------------------------------------------------------
	$(document).on('click', '.o-bloqueado', function () {

		var idUser = $(this).closest('tr').find('td.id-user').text();
		//alert('clicou no user ' + idUser)
		$.ajax({
			url: "scriptsPHP/user-desbloquear.php",
			dataType: 'json',
			type: 'post',
			data: {
				id: idUser
			},
			success: function (data) {
				//alert('mudou o bloqueio');
				console.log('O id é ' + idUser);
				location.reload();

				/*$('td:contains("'+idUser+'")').closest('tr').find('td.xxx').find('button.o').addClass('o-bloqueado');
				$('td:contains("'+idUser+'")').closest('tr').find('td.xxx').find('button.o').removeClass('o');
				$('td:contains("'+idUser+'")').closest('tr').find('td.estado-bloqueio').text("Sim");*/
				
			}
		}); // fim ajax
	});
	
	
	// --------------------------------------------------------------
	// Acao de clicar no X buton para remover um user
	// --------------------------------------------------------------
	$(document).on('click', '.x', function (e) {
		var idUser = $(this).closest('tr').find('td.id-user').text();
		console.log('clicou em ' + idUser);
		var $form = $(this).closest('form');
		e.preventDefault();
		$('#confirm').modal({
				/*backdrop: 'static',
				keyboard: false*/
			})
			.one('click', '#delete', function (e) {
				$form.trigger('submit');
				removerUser(idUser);

			});
	});

	function removerUser(idUser) {
		$.ajax({
			url: "scriptsPHP/user-remover.php",
			dataType: 'json',
			type: 'post',
			data: {
				id: idUser
			},
			success: function (data) {
				if (data["result"] === true) {

					// Aparece o modal de confirmação
					$('#confirmUserRemovido').modal();
					// Depois de uns segundos, some
					setTimeout(function () {
						$('#confirmUserRemovido').modal('hide');
					}, 2500);

					// remove a linha atual da tabela
					$('td.id-user:contains(' + idUser + ')').closest('tr').remove();
				}
			}
		}); // fim ajax
	}
});
