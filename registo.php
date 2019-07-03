<!DOCTYPE html>
<html>

<head>
	<title>Registar</title>
	<meta charset="utf-8" />
	<script src="vendor/jquery/jquery.min.js"></script>
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css" />
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="vendor/bootstrap/css/layout.css">
	<link rel="stylesheet" href="vendor/bootstrap/css/jquery-ui.min.css">
	<link rel="stylesheet" href="vendor/bootstrap/css/jquery-ui.structure.min.css">
	<link rel="stylesheet" href="vendor/bootstrap/css/jquery-ui.theme.min.css">
	<script src="vendor/bootstrap/js/jquery-ui.min.js"></script>
	<script src="js/scripts-gerais.js"></script>

	<script>
		$(function() {
			$('#datepicker').datepicker({
				closeText: 'Fechar',
				prevText: '&#x3c;Anterior',
				nextText: 'Pr&oacute;ximo&#x3e;',
				currentText: 'Hoje',
				monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
					'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
				],
				monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',
					'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'
				],
				dayNames: ['Domingo', 'Segunda-feira', 'Ter&ccedil;a-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
				dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
				dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
				weekHeader: 'Sm',
				dateFormat: 'yy/mm/dd',
				firstDay: 0,
				isRTL: false,
				showMonthAfterYear: false,
				yearSuffix: '',
				changeMonth: true,
				changeYear: true,
				yearRange: "-100:+0"
			});
		});

	</script>
	<style type="text/css">
		body {
			overflow: hidden;
		}

	</style>
</head>

<body>
	<div class="registo-page">
		<div class="form">
			<form id="registo-form" class="registo-form" method="post">
				<input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" required/>
				<input type="text" id="email" name="email" class="form-control" placeholder="E-mail" required/>
				<input type="password" id="password" class="form-control" name="password" placeholder="Password" required/>
				<input type="text" id="datepicker" name="datepicker" class="form-control" placeholder="Data de nascimento" required/>
				<select name="sexo" id="sexo" class="form-control" required>
          <option value="" disabled selected hidden>Selecione o seu sexo</option>
          <option value="Masculino">Masculino</option>
          <option value="Feminino">Feminino</option>
        </select>
				<select name="edformal" id="edformal" class="form-control" required>
          <option disabled selected hidden>Selecione a sua educação formal</option>
          <option value="Não sabe ler nem escrever">Não sabe ler nem escrever</option>
          <option value="Sabe ler e escrever">Sabe ler e escrever</option>
          <option value="4 ºano de escolaridade">4 ºano de escolaridade</option>
          <option value="6 ºano de escolaridade">6 ºano de escolaridade</option>
          <option value="9º ano de escolaridade">9ºano de escolaridade</option>
          <option value="12ºano de escolaridade">12ºano de escolaridade</option>
          <option value="Bacharelato/Licenciatura">Bacharelato/Licenciatura</option>
          <option value="Outro">Outro</option>
        </select>
				<div id="outroedformal" style="display: none;">
					<input type="text" id="outro" name="edformal_outro" class="form-control" placeholder="Por favor, especifique" />
				</div>

				<select name="literacia_informatica" id="literacia_informatica" class="form-control" required>
          <option value="" disabled selected hidden>Literacia Informática</option>
          <option value="0">Não tenho telemóvel</option>
          <option value="1">Utiliza o telemóvel para fazer ou receber chamadas</option>
          <option value="2">Utiliza o telemóvel para fazer ou receber chamadas e enviar e receber mensagens escritas</option>
          <option value="3">Utiliza o telemóvel para fazer ou receber chamadas, enviar e receber mensagens escritas e navegar na internet</option>
        </select>

				<select name="computador_ou_tablet" id="computador_ou_tablet" class="form-control" required>
          <option value="" disabled selected hidden>Utiliza o computador ou tablet?</option>
          <option value="0">Não</option>
          <option value="1">Sim</option>
        </select>

				<input type="submit" id="registar-button" class="btn btn-primary" value="REGISTAR" />
				<p class="message">Já tem uma conta? <a href="login.php">Entre aqui</a></p>
			</form>
		</div>
	</div>

	<div class="modal fade" id="popupModalregistar" tabindex="-1" role="dialog" aria-labelledby="popupModalTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="popupModalTitle">Erro no registo</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
				</div>
				<div class="modal-body message">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>

	<script>
		$("#edformal").change(function() {
			if ($('#edformal option:selected').text() == "Outro") {
				$("#outroedformal").css('display', 'block');
				$("#outro").attr("required", true);
				$("#edformal").attr("name", "edformal_old");
				$("#outro").attr("name", "edformal");
			} else {
				$("#outroedformal").css('display', 'none');
				$("#outro").attr("required", false);
				$("#outro").attr("name", "edformal_old");
				$("#edformal").attr("name", "edformal");
			}
		});

	</script>
</body>

</html>
