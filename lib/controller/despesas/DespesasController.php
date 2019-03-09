<?php
final class DespesasController extends LayoutController {
	private $form;

	public function setContent() {
		return
			<x:frag>
				<div class="row">
					<div class="center">
						{$this->form}	
          </div>
				</div>
			</x:frag>;
	}

	public function processRequest() {
		$usuario = $_SESSION['usuario'];
    if ($usuario->perfil == 1) {
			$q_tipo = 
				<<<EOD
SELECT * FROM tipo;
EOD;
			$conn = dbconn();
			$res_tipo = $conn->executeQuery($q_tipo);
			$options = <select name="tipo"/>;
			while ($obj = pg_fetch_object($res_tipo)) {
				$options->appendChild(
					<option value={$obj->id}> {$obj->nome} </option>
				);
			}

      $this->form = 
        <form action="#" method="post" class="box prepend-top">
          <fieldset class="center">
            <legend> Cadastro de despesas </legend>
            <label> Tipo da despesa </label>
						{$options}
            <label> Valor da despesa </label>
            <input type="text" name="valor" autocomplete="off"/><br/>
            <input type="submit" 
              value="Cadastrar" class="btn btn-primary offset1"/>
          </fieldset>
        </form>;

			if (is_post()) {
				$r = $this->getRequest();
				$tipo = $r->getInt('tipo');
				$valor = $r->getDouble('valor');
				$ano = date('Y');

				$q_insert = 
					<<<EOD
INSERT INTO despesa(tipo, valor, ano) VALUES($1, $2, $3);
EOD;

				$res = $conn->execute($q_insert, array($tipo, $valor, $ano));
				if ($res) {
					add_msg(SUCCESS, "Despesa inserida com sucesso.");
				} else {
					add_msg(ERROR, "Falha ao inserir despesa");
				}
			}
    }
	}

	public function composeMenu() {
		return <a:menu idMenu="despesas"/>;
	}
}
