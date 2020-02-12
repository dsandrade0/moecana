<?php
final class CartaoAzulMigration extends Migration {

	public function run() {
		$q =
			<<<EOD
ALTER TABLE jogador ADD COLUMN azul int NOT NULL DEFAULT 0;
EOD;
		return $q;
	}

	public function undo() {}
}
