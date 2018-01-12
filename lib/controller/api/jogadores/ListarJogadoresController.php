<?php
final class ListarJogadoresController extends RestController {
	private $array = array();

	public function restResponse() {
		return $this->array;
	}

	public function processRequest() {
		$r = $this->getRequest();
		if (is_get()) {
			$q = 
<<<EOD
SELECT nome, gols, amarelo, vermelho
  FROM jogador
ORDER BY gols DESC;
EOD;
			$conn = dbconn();
			$res = $conn->executeQuery($q);
			if ($res) {
				while ($o = pg_fetch_object($res) ) {
					$this->array[] = $o;
				}	
			}
		}
	}
}
