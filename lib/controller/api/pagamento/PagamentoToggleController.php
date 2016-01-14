<?php
final class PagamentoToggleController extends Controller {
  
  public function processRequest() {
    $r = $this->getRequest();
    $conn = dbconn();

    $mes = $r->getString('mes');
    $id = $r->getInt('id');
    $atual = $r->getString('atual');

    $q;
    if ($atual == 'f') {
      $q =
        <<<EOD
UPDATE pagamento 
  SET $mes=TRUE 
WHERE jogador=$1
  AND ano=$2
EOD;
    } else if ($atual == 't') {
      $q =
        <<<EOD
UPDATE pagamento SET $mes=FALSE WHERE jogador=$1 AND ano=$2
EOD;
    }
    
    $res = $conn->execute($q, array($id, date('Y')));

  }
}
