<?php
final class ApagarJogadorController extends Controller {

  public function processRequest()
  {
    $r = $this->getRequest();
    $id = $r->getInt('id');
    $status = $r->getInt('status');
    $q = '';
    if ($status) {
      $q =
        <<<EOD
UPDATE jogador SET status=1 where id=$1;
EOD;
    } else {
      $q =
        <<<EOD
UPDATE jogador SET status=0 where id=$1;
EOD;
    }

    $conn = dbconn();
    if (is_post()) {
      $res = $conn->execute($q, array($id));
      if ($res) {
        if ($status) {
          add_msg(SUCCESS, "Jogador ativado com sucesso");
        } else {
          add_msg(SUCCESS, "Jogador inativado com sucesso");
        }
      } else {
        add_msg(ERROR, "Erro ao inativar jogador");
      }
      send_redirect("/jogador/alterar");
    }
  }
}
