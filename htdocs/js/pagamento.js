function pagamentoToggle(id, mes, bool) {
  $.post(
    'api/pagamento',
    {'id': id, 'mes': mes, 'atual': bool},
    function() {
      Utils.reload();
    }
  );
}
