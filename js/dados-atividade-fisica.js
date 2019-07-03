$(document).ready(function() {
  displayTabelas();

  $("#exportar-graph-movimento").on('click', function() {
    xepOnline.Formatter.Format('morris-line-chart-movimento',{render:'download', srctype:'svg'});
  });

  $("#exportar-graph-repouso").on('click', function() {
    xepOnline.Formatter.Format('morris-line-chart-repouso',{render:'download', srctype:'svg'});
  });

  $(".adicionar-registo-af-movimento").click(function(event) {
    event.preventDefault();

    $.post('script/adicionar-registo-af-andar.php', $('#inserir-novo-af-movimento').serialize(), function(resp) {

      if (resp['status'] === false) {
        $(".modal-body.message").empty();
        $.each(resp['msg'], function(index, value) {
          $(".modal-body.message").append(value + '<br>');
          $('#introduzir-atividade-fisica-movimento').modal('hide');
          $('#popupModal').modal('show');
        });
      } else if (resp['status'] === true) {
        displayResultMovimento();
        $(".modal-body.message").empty();
        $('#popupModalTitle').text("Sucesso!");
        $(".modal-body.message").append("Registo introduzido com sucesso!");
        $('#introduzir-atividade-fisica-movimento').modal('hide');
        $('#popupModal').modal('show');
      }
      $("#frequencia").val("-1");
      $("#duracao").val("");
      $("#condicao_fisica").val("-1");

    }, 'json');
  });

  $(".adicionar-registo-af-repouso").click(function(event) {
    event.preventDefault();

    $.post('script/adicionar-registo-af-repouso.php', $('#inserir-novo-af-repouso').serialize(), function(resp) {

      if (resp['status'] === false) {
        $(".modal-body.message").empty();
        $.each(resp['msg'], function(index, value) {
          $(".modal-body.message").append(value + '<br>');
          $('#introduzir-atividade-fisica-repouso').modal('hide');
          $('#popupModal').modal('show');
        });
      } else if (resp['status'] === true) {
        displayResultRepouso();
        $(".modal-body.message").empty();
        $('#popupModalTitle').text("Sucesso!");
        $(".modal-body.message").append("Registo introduzido com sucesso!");
        $('#introduzir-atividade-fisica-repouso').modal('hide');
        $('#popupModal').modal('show');
      }
      $("#frequencia").val("-1");
      $("#duracao").val("");
      $("#condicao_fisica").val("-1");

    }, 'json');
  });
});

function displayResultMovimento() {
  $.ajax({
    url: 'script/tabledit-af-andar-select.php',
    type: 'post',
    dataType: 'json',
    cache: false,

    success: function(data) {
      $('#tabledit-andamento tbody').empty();
      $.each(data, function(index, item) {
        $('#tabledit-andamento tbody').append("<tr><td>" + item.id + "</td><td>" + diaDaSemana(item.data) + "</td><td>" + item.data + "</td><td>" + item.frequencia + "</td><td>" + item.duracao + "</td><td>" + item.condicao_saude + "</td></tr>");
      });
      tableEditMovimento();
    }
  });
}

function displayResultRepouso() {
  $.ajax({
    url: 'script/tabledit-af-sentado-select.php',
    type: 'post',
    dataType: 'json',
    cache: false,

    success: function(data) {
      $('#tabledit-repouso tbody').empty();
      $.each(data, function(index, item) {
        $('#tabledit-repouso tbody').append("<tr><td>" + item.id + "</td><td>" + diaDaSemana(item.data) + "</td><td>" + item.data + "</td><td>" + item.duracao + "</td><td>" + item.condicao_saude + "</td></tr>");
      });
      tableEditRepouso();
    }
  });
}

function tableEditMovimento() {
  $('#tabledit-andamento').Tabledit({
    url: 'script/tabledit-action-af-movimento.php',
    restoreButton: false,
    hideIdentifier: true,
    columns: {
      identifier: [0, 'id'],
      editable: [
        [2, 'data'],
        [3, 'frequencia', '{"1":"1", "2":"2", "3":"3", "4":"4", "5":"5", "6":"6", "7":"7", "8":"8", "9":"9", "10":"10", "10+":"10+"}'],
        [4, 'duracao'],
        [5, 'condicao_saude', '{"Melhorou": "Melhorou", "Manteve": "Manteve", "Agravou": "Agravou"}']
      ]
    },
    onDraw: function() {
      console.log('onDraw()');

      $.ajax({
        type: 'GET',
        url: 'script/graph-movimento-af.php',
        dataType: 'json',

        success: function(res)
        {
          $('#morris-line-chart-movimento').empty();
          Morris.Area({
              // ID of the element in which to draw the chart.
              element: 'morris-line-chart-movimento',

              // Chart data records -- each entry in this array corresponds to a point
              // on the chart.
              data: res,

              // The name of the data record attribute that contains x-values.
              xkey: 'data',

              // A list of names of data record attributes that contain y-values.
              ykeys: ['frequencia', 'duracao'],

              // Labels for the ykeys -- will be displayed when you hover over the
              // chart.
              labels: ['Frequência', 'Duração'],

              lineColors: ['#0b62a4', '#D58665'],
              //ajusta o gráfico ao melhor
              xLabels: 'day',

              // Disables line smoothing
              smooth: true,
              resize: true
          });
        }
      });
    },
    onSuccess: function(data, textStatus, jqXHR) {
      console.log('onSuccess(data, textStatus, jqXHR)');
      console.log(data);
      console.log(textStatus);
      console.log(jqXHR);
      displayResultMovimento();
    },
    onFail: function(jqXHR, textStatus, errorThrown) {
      console.log('onFail(jqXHR, textStatus, errorThrown)');
      console.log(jqXHR);
      console.log(textStatus);
      console.log(errorThrown);
    },
    onAlways: function() {
      console.log('onAlways()');
    },
    onAjax: function(action, serialize) {
      console.log('onAjax(action, serialize)');
      console.log(action);
      console.log(serialize);
    }
  });
}

function tableEditRepouso() {
  $('#tabledit-repouso').Tabledit({
    url: 'script/tabledit-action-af-repouso.php',
    restoreButton: false,
    hideIdentifier: true,
    columns: {
      identifier: [0, 'id'],
      editable: [
        [2, 'data'],
        [3, 'duracao'],
        [4, 'condicao_saude', '{"Melhorou": "Melhorou", "Manteve": "Manteve", "Agravou": "Agravou"}']
      ]
    },
    onDraw: function() {
      console.log('onDraw()');

      $.ajax({
        type: 'GET',
        url: 'script/graph-repouso-af.php',
        dataType: 'json',

        success: function(res)
        {
          $('#morris-line-chart-repouso').empty();
          Morris.Area({
              // ID of the element in which to draw the chart.
              element: 'morris-line-chart-repouso',

              // Chart data records -- each entry in this array corresponds to a point
              // on the chart.
              data: res,

              // The name of the data record attribute that contains x-values.
              xkey: 'data',

              // A list of names of data record attributes that contain y-values.
              ykeys: ['duracao'],

              // Labels for the ykeys -- will be displayed when you hover over the
              // chart.
              labels: ['Duração'],

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
    onSuccess: function(data, textStatus, jqXHR) {
      console.log('onSuccess(data, textStatus, jqXHR)');
      console.log(data);
      console.log(textStatus);
      console.log(jqXHR);
      displayResultRepouso();
    },
    onFail: function(jqXHR, textStatus, errorThrown) {
      console.log('onFail(jqXHR, textStatus, errorThrown)');
      console.log(jqXHR);
      console.log(textStatus);
      console.log(errorThrown);
    },
    onAlways: function() {
      console.log('onAlways()');
    },
    onAjax: function(action, serialize) {
      console.log('onAjax(action, serialize)');
      console.log(action);
      console.log(serialize);
    }
  });
}

function diaDaSemana(date) {
  var dayOfWeek = new Date(date).getDay();
  return isNaN(dayOfWeek) ? null : ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'][dayOfWeek];
}

function displayTabelas() {
  displayResultMovimento();
  displayResultRepouso();
}
