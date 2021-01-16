<?php
final class ApagarJogadorController extends Controller {

  public function processRequest() {
    $r = $this->getRequest();
    $id = $r->getInt('id');
    $q = 
      <<<EOD
UPDATE jogador SET status=0 where id=$1;
EOD;
    $conn = dbconn();
    if (is_post()) {
      $res = $conn->execute($q, array($id));
      if ($res) {
        add_msg(SUCCESS, "Jogador inativado com sucesso");
      } else {
        add_msg(ERROR, "Erro ao inativar jogador");
      }
      send_redirect("/jogador/alterar");
    }
  }
}
