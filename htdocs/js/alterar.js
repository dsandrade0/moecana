function confirma(id) {
 var r = confirm('Deseja realmente inativar o jogador');

 if (r) {
  $.post('/jogador/apagar', {'id': id}, function(dados, status) {
    if (status === 'success') {
      location.reload(); 
    }
  });
 }
}
