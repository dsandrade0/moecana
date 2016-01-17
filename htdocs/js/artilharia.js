function gol1(id, gol) {
  $.post(
    '/api/gol', 
    {'id': id, 'gol': gol+1}, 
    function() {
      Utils.reload(); 
    }
  );
}

function tiraGol(id, gol) {
  $.post(
    '/api/gol', 
    {'id': id, 'gol': gol-1}, 
    function() {
      Utils.reload(); 
    }
  );
}

function gol2(id, gol) {
  $.post(
    '/api/gol', 
    {'id': id, 'gol': gol+2}, 
    function() {
      Utils.reload(); 
    }
  );
}

function amarelo(id, cartao) {
  $.post(
    '/api/cartao', 
    {'id': id, 'cartao': 'amarelo', 'numero': cartao+1}, 
    function() {
      Utils.reload(); 
    }
  );
}

function tiraAmarelo(id, cartao) {
  $.post(
    '/api/cartao', 
    {'id': id, 'cartao': 'amarelo', 'numero': cartao-1}, 
    function() {
      Utils.reload(); 
    }
  );
}

function vermelho(id, cartao) {
  $.post(
    '/api/cartao', 
    {'id': id, 'cartao': 'vermelho', 'numero': cartao+1}, 
    function() {
      Utils.reload(); 
    }
  );
}

function tiraVermelho(id, cartao) {
  $.post(
    '/api/cartao', 
    {'id': id, 'cartao': 'vermelho', 'numero': cartao-1}, 
    function() {
      Utils.reload(); 
    }
  );
}
