$(document).ready(function () {

	$.ajax({
		url: "scriptsPHP/listar_utentes_associados.php",
		dataType: "json",
		type: "post",
		success: function (data) {
			console.log(data);
			$.each(data, function (i, value) {
				$(".utentes").append(html(value.nome, value.id_utente, value.id, value.image));
			});
		}
	});

	$(document).on("click", ".butao", function () {
		$.ajax({
			url: "scriptsPHP/verificar_utente_associado.php",
			dataType: "json",
			type: "post",
			data: {
				idutente: $(this).attr('id-utente'),
			},
			success: function (data) {
				if (data["resp"] === true) {
					console.log(data);
					location.href = "inicio.php";
				} else {
					$(".modal-body.message").empty();
					$('#popupModalTitle').text("Erro!");
					$(".modal-body.message").append("Erro ao entrar no perfil do utente. Tente mais tarde");
					$('#popupModal').modal('show');
				}
			}
		});
	});


});

function html(nome, id, id2, image) {
	if (image == '' || image == null) {
		src = 'http://i.imgur.com/c9Ns3rV.png';
	} else {
		src = image;
	}
	var html = '<div class="panel panel-primary panel-familiar"><div class="panel-heading">' + nome + '</div><div class="panel-body"><div class="col-xs-6"><img src="'+src+'" width="120" height="120" class="img-circle pull-left"/></div><div class="col-xs-6"><button type="button" class="btn btn-primary btn-md center-block butao" id-utente="' + id + '" style="margin-top: 30px;">Entrar</button></div></div></div>';
	return html;
}
