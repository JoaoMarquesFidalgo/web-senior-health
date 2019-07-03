$(document).ready(function () {
	// $('#timepicker1').timepicker();

	$("#exportar-graph-fc").on('click', function() {
		xepOnline.Formatter.Format('morris-line-chart-fc',{render:'download', srctype:'svg'});
	});

	$("#exportar-graph-ta").on('click', function() {
		xepOnline.Formatter.Format('morris-line-chart-ta',{render:'download', srctype:'svg'});
	});

	$("#timepicker1").datetimepicker({
		format: "yyyy/m/d hh:ii",
		language: 'pt-BR'
	});
	$("#timepicker2").datetimepicker({
		format: "yyyy/m/d hh:ii",
		language: 'pt-BR'
	});
	viewDataFC();
	viewDataTA();

	$(document).on("click", ".pagination li a", function (event) {
		console.log($(this));
		event.preventDefault();
	});

	$(document).on("change", ".inputErro", function () {
		$(this).removeClass("inputErro");
	});

	$(document).on("click", ".adicionar-registo-fc", function (event) {
		event.preventDefault();
		var status = true;
		$("#inserir-novo-fc").find('input').each(function (idx, elem) {
			if ($(elem).val().length == 0) {
				$(this).addClass("inputErro");
				status = false;
			}
		});

		if (status == true) {
			$.post('script/adicionar-registo-fc.php', $('#inserir-novo-fc').serialize(), function (resp) {
				console.log($('#inserir-novo-fc').serialize());
				if (resp['status'] === false) {
					$(".modal-body.message").empty();
					$.each(resp['msg'], function (index, value) {
						$(".modal-body.message").append(value + '<br>');
						$('#introduzir-fc').modal('hide');
						$('#popupModal').modal('show');
					});
				} else if (resp['status'] === true) {
					viewDataFC();
					$(".modal-body.message").empty();
					$('#popupModalTitle').text("Sucesso!");
					$(".modal-body.message").append("Registo introduzido com sucesso!");
					$('#introduzir-fc').modal('hide');
					$('#popupModal').modal('show');
				}
				$("#datafc").val("");
				$("#horafc").val("");
				$("#fc").val("");
				$("#responsavelfc").val("");

				if (resp['has-fc'] === true) {
					$(".modal-body.bio").empty();
					$(".modal-body.bio").append(resp['erro-fc']);
					$('#popupModal').one('hidden.bs.modal', function() {
					$('#popupAlerta').modal('show');
					});
				}
			}, 'json');
		}
	});

	$(document).on("click", ".adicionar-registo-ta", function (event) {
		event.preventDefault();
		var status = true;
		$("#inserir-novo-ta").find('input').each(function (idx, elem) {
			if ($(elem).val().length == 0) {
				$(this).addClass("inputErro");
				status = false;
			}
		});
		if (status == true) {
			$.post('script/adicionar-registo-ta.php', $('#inserir-novo-ta').serialize(), function (resp) {

				if (resp['status'] === false) {
					$(".modal-body.message").empty();
					$.each(resp['msg'], function (index, value) {
						$(".modal-body.message").append(value + '<br>');
						$('#introduzir-ta').modal('hide');
						$('#popupModal').modal('show');
					});
				} else if (resp['status'] === true) {
					viewDataTA();
					$(".modal-body.message").empty();
					$('#popupModalTitle').text("Sucesso!");
					$(".modal-body.message").append("Registo introduzido com sucesso!");
					$('#introduzir-ta').modal('hide');
					$('#popupModal').modal('show');
				}
				$("#datata").val("");
				$("#horata").val("");
				$("#ta").val("");
				$("#responsavelta").val("");

				if (resp['has-ta'] === true) {
					$(".modal-body.bio").empty();
					$(".modal-body.bio").append(resp['erro-ta']);
					$('#popupModal').one('hidden.bs.modal', function() {
					$('#popupAlerta').modal('show');
					});
				}
			}, 'json');
		}
	});


	function viewDataFC() {
		$.ajax({
			url: "scriptsPHP/table.php",
			type: "post",
			data: {
				tipo: "fc"
			},
			dataType: "json",
			success: function (data) {
				$("#tabledit tbody").empty();
				$.each(data, function (i, value) {
					$("#tabledit tbody").append("<tr><td>" + value.id + "</td><td>" + value.datahora + "</td><td>" + value.frequencia_cardiaca + "</td><td>" + value.responsavel + "</td></tr>")
				});
				tableDataFC();
				show(1, 10);
			}

		});
	}

	function viewDataTA() {
		$.ajax({
			url: "scriptsPHP/table.php",
			type: "post",
			dataType: "json",
			data: {
				tipo: "ta"
			},
			success: function (data) {
				$("#tabledit1 tbody").empty();
				$.each(data, function (i, value) {
					$("#tabledit1 tbody").append("<tr><td>" + value.id + "</td><td>" + value.datahora + "</td><td>" + value.tensao_arterial + "</td><td>" + value.responsavel + "</td></tr>")
				});
				tableDataTA();
			}

		})
	}

	function tableDataFC() {
		$('#tabledit').Tabledit({
			restoreButton: false,
			hideIdentifier: true,
			url: 'scriptsPHP/tablEditFC.php',
			columns: {
				identifier: [0, 'id'],
				editable: [[1, 'data'], [2, 'frequencia_cardiaca'], [3, 'responsavel']]
			},
			onDraw: function () {
				console.log('onDraw()');

				$.ajax({
					type: 'GET',
					url: 'script/graph-fc-db.php',
					dataType: 'json',

					success: function(res)
					{
						$('#morris-line-chart-fc').empty();
						Morris.Area({
							// ID of the element in which to draw the chart.
							element: 'morris-line-chart-fc',

							// Chart data records -- each entry in this array corresponds to a point
							// on the chart.
							data: res,

							// The name of the data record attribute that contains x-values.
							xkey: 'datahora',

							// A list of names of data record attributes that contain y-values.
							ykeys: ['frequencia_cardiaca'],

							// Labels for the ykeys -- will be displayed when you hover over the
							// chart.
							labels: ['Frequência Cardíaca'],

							lineColors: ['#0b62a4'],
							//ajusta o gráfico ao melhor
							xLabels: 'day',

							// Disables line smoothing
							smooth: true,
							resize: true
						});
					}
				});
			},
			onSuccess: function (data, textStatus, jqXHR) {
				console.log('onSuccess(data, textStatus, jqXHR)');
				console.log(data);
				console.log(textStatus);
				console.log(jqXHR);
				viewDataFC();
			},
			onFail: function (jqXHR, textStatus, errorThrown) {
				console.log('onFail(jqXHR, textStatus, errorThrown)');
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);
			},
			onAjax: function (action, serialize) {
				console.log('onAjax(action, serialize)');
				console.log(action);
				console.log(serialize);
			}
		});
	}

	function tableDataTA() {
		$('#tabledit1').Tabledit({
			hideIdentifier: true,
			restoreButton: false,
			url: 'scriptsPHP/tablEditTA.php',
			columns: {
				identifier: [0, 'id'],
				editable: [[1, 'data'], [2, 'hora'], [3, 'tensao_arterial'], [4, 'responsavel']]
			},
			onDraw: function () {
				console.log('onDraw()');

				$.ajax({
					type: 'GET',
					url: 'script/graph-ta-db.php',
					dataType: 'json',

					success: function(res)
					{
						$('#morris-line-chart-ta').empty();
						Morris.Area({
							// ID of the element in which to draw the chart.
							element: 'morris-line-chart-ta',

							// Chart data records -- each entry in this array corresponds to a point
							// on the chart.
							data: res,

							// The name of the data record attribute that contains x-values.
							xkey: 'datahora',

							// A list of names of data record attributes that contain y-values.
							ykeys: ['tensao_arterial'],

							// Labels for the ykeys -- will be displayed when you hover over the
							// chart.
							labels: ['Tensão Arterial'],

							lineColors: ['#0b62a4'],
							//ajusta o gráfico ao melhor
							xLabels: 'day',

							// Disables line smoothing
							smooth: true,
							resize: true
						});
					}
				});
			},
			onSuccess: function (data, textStatus, jqXHR) {
				console.log('onSuccess(data, textStatus, jqXHR)');
				console.log(data);
				console.log(textStatus);
				console.log(jqXHR);
				viewDataTA();
			},
			onFail: function (jqXHR, textStatus, errorThrown) {
				console.log('onFail(jqXHR, textStatus, errorThrown)');
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);
			},
			onAjax: function (action, serialize) {
				console.log('onAjax(action, serialize)');
				console.log(action);
				console.log(serialize);
			}
		});
	}

	function show(min, max) {
		var $table = $('#tabledit'),
		$rows = $table.find('tbody tr');
		min = min ? min - 1 : 0;
		max = max ? max : $rows.length;
		$rows.hide().slice(min, max).show();
		return false;
	}

	$('#limit').bind('change', function () {
		show(0, this.value);
	});
});
