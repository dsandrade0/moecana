<?php
final class AlterarNomeController extends LayoutController{
	private $nome, $id;

	public function setContent() {
		return
			<x:frag>
        <div class="row margin-top center">
          <div class="span12 center">
						<form action="#" method="post" class="">
							<div class="row">
								<input type="text" name="nome" value={$this->nome} class="span3"/>
								<input type="hidden" name="id" value={$this->id}/>
							</div>
							<div class="row">
								<input type="submit" class="btn btn-primary" value="Alterar"/>
							</div>
						</form>
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

		$r = $this->getRequest();
		$this->id = $r->getInt('id');
		$conn = dbconn();
		if (is_post()) {
			$nome = $r->getString('nome');
			$q =
				<<<EOD
UPDATE jogador SET nome=$1 WHERE id=$2;
EOD;
			$res = $conn->execute($q, array($nome, $this->id));
			if ($res) {
				add_msg(SUCCESS, "Jogador alterado com sucesso");
				send_redirect('/jogador/alterar');
			} else {
				add_msg(ERROR, "Algo errado aconteceu ao alterar");
			}
		}

		$q_sel =
			<<<EOD
SELECT nome FROM jogador WHERE id = $1;
EOD;
		$res_sel = $conn->executeQueryParams($q_sel, array($this->id));
		if ($res_sel) {
			$j = pg_fetch_object($res_sel);
			$this->nome = $j->nome;	
		}
	}
}
