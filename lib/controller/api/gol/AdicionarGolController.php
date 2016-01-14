<?php
final class AdicionarGolController extends Controller {
  
  public function processRequest() {
    if (is_post()) {
      $r = $this->getRequest();
      $id = $r->getInt('id');
      $gol = $r->getInt('gol');

      $conn = dbconn();
      $q =
        <<<EOD
UPDATE jogador SET gols=$1 WHERE id=$2;
EOD;
      $res = $conn->execute($q, array($gol, $id));
    }
  }
}
