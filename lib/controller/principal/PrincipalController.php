<?php
final class PrincipalController extends LayoutController {
	private $valor;
  
  public function setContent() {
    return
      <x:frag>
        <div class="row">
					<div class="center">
						<h2> Total gasto em {date('Y')} = R$ {$this->valor->valor}</h2>
            <img class="center" src={get_image('moecana.jpg')}/> 
          </div>
        </div>
      </x:frag>;
  }

  public function processRequest() {
    $is_user = valida_usuario();
    if (!$is_user) {
      print_r($_SESSION['usuario']);
      add_msg(ERROR, 'Usuario nao validado');
      send_redirect('/home');
    } 

		$q = 
			<<<EOD
SELECT SUM(valor) AS valor FROM despesa WHERE ano = $1
EOD;

		$conn = dbconn();
		$res = $conn->execute($q, array(date('Y')));
		$this->valor = pg_fetch_object($res);

  }

  public function composeMenu() {
    return
      <a:menu idMenu="principal"/>;
  }
}
