function pagamentoToggle(id, mes, bool, ano) {
  $.post(
    'api/pagamento',
    {'id': id, 'mes': mes, 'atual': bool, 'ano': ano},
    function() {
      location.reload();
    }
  );
}

$(document).ready(function() {
    $('#idAno').on('change', function () {
        console.log('teste')
        $('#idFormAno').submit();
    });
});

