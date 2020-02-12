<?php
final class AdicionarCartaoController extends Controller {

  public function processRequest() {
  
    if (is_post()) {
      $r = $this->getRequest();
      $id = $r->getInt('id');
      $cartao = $r->getString('cartao');
      $numero = $r->getInt('numero');

      $q;
      $conn = dbconn();
      if ($cartao == 'amarelo') {
        $q =
          <<<EOD
UPDATE jogador SET amarelo=$1 WHERE id=$2;
EOD;
      
      }

      if ($cartao == 'vermelho') {
        $q =
          <<<EOD
UPDATE jogador SET vermelho=$1 WHERE id=$2;
EOD;
      }

      if ($cartao == 'azul') {
        $q =
          <<<EOD
UPDATE jogador SET azul=$1 WHERE id=$2;
EOD;
      }


      if (!$q) {
        return;
      }
      $res = $conn->execute($q, array($numero, $id));
    }
  }
}
