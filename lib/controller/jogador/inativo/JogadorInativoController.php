<?php
final class JogadorInativoController extends LayoutController {

  private $table;

  public function setContent() {
    return
			<x:frag>
        <div class="row margin-top">
          <div class="span6 center offset3">
						{$this->table}
          </div>
        </div>
			</x:frag>;
	}

  public function composeMenu() {
    return
      <a:menu idMenu="jogador"/>;
  }

  public function processRequest() {
    if ($_SESSION['usuario']->perfil != 1) {
      add_msg(ERROR, "Você não pode alterar o jogador");
      send_redirect("/principal");
    }
    $conn = dbconn();
    $q =
      <<<EOD
SELECT nome, id FROM jogador where status = 0 ORDER BY nome ASC
EOD;
    $this->table = <table class="table center table-hover table-striped"/>;
		$this->table->appendChild(
			<tr>
				<th>Nome</th>
				<th>Ação</th>
			</tr>
		);
		$res = $conn->execute($q);
		while ($o = pg_fetch_object($res)) {
      $this->table->appendChild (
				<tr>
					<td>{$o->nome}</td>
          <td>
            <form id={'form'.$o->id} method="post" action="/jogador/apagar" class="form-inline">
              <input type="hidden" name="id" value={$o->id}/>
              <a class="btn btn-success" onclick={'confirma('.$o->id.')'}>
                Ativar
                </a>
            </form>
          </td>
				</tr>
			);
		}
  }

}