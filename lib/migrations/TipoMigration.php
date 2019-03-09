<?php
final class TipoMigration extends Migration {

	public function run() {
		$q = 
			<<<EOD
CREATE TABLE tipo 
(
	id serial NOT NULL,
	nome varchar(255) NOT NULL,
	PRIMARY KEY(id)
);

INSERT INTO tipo(nome) VALUES
('Campo'), ('Bola'), ('Copos'), ('Gelo'), ('Outros')

EOD;
		return $q;

	}

	public function undo() {}
}
