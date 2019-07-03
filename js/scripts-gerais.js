jQuery(document).ready(function () {

	$(document).on('click', 'li.nivel', function () {
		if ($('li.nivel').hasClass('nivel-estilizado'))
			$('li.nivel').removeClass('nivel-estilizado');
		else
			$('li.nivel').addClass('nivel-estilizado');

		//$('li.nivel').toggleClass('nivel-esltilizado'); // nao funciona
		if (!$('li.nivel').hasClass('nivel-estilizado')) {
			$('li.nivel > a').css('background-color', 'rgba(0, 198, 206, 0.05)');
		}
	});

	$("#login-button").click(function (event) {
		event.preventDefault();

		$.post('script/login_process.php', $('#log-in-form').serialize(), function (resp) {
			if (resp['status'] === false) {
				$(".modal-body.message").empty();
				$.each(resp['msg'], function (index, value) {
					$(".modal-body.message").append(value + '<br>');
					$('#popupModal').modal('show');
				});
			} else if (resp['tipo'] == 'utente') {
				location.href = "inicio.php";
			} else if (resp['tipo'] == 'familiar') {
				location.href = "familiar.php";
			} else if (resp['tipo'] == 'admin') {
				location.href = "admin-page.php";
			}
		}, 'json');
	});

	$("#registo-form").submit(function (event) {
		event.preventDefault();

		$.post('script/registar_process.php', $('#registo-form').serialize(), function (resp) {
			if (resp['status'] === false) {
				$(".modal-body.message").empty();
				$.each(resp['msg'], function (index, value) {
					$(".modal-body.message").append(value + '<br>');
					$('#popupModalregistar').modal('show');
				});
			} else if (resp['status'] === true) {
				$(".modal-body.message").empty();
				$('#popupModalTitle').text("Sucesso!");
				$(".modal-body.message").append("Registo introduzido com sucesso!<br><br>Por favor, inicie sua sessão <a href='login.php'>aqui</a>.");
				$('#popupModalregistar').modal('show');

				$("#popupModalregistar").on("hidden.bs.modal", function () {
					window.location = "login.php";
				});
			}
		}, 'json');
	});
});
