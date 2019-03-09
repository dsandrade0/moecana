<?php
final class DespesasMigration extends Migration {

	public function run() {
		$q = 
			<<<EOD
CREATE TABLE despesa
(
	id serial NOT NULL,
	tipo integer NOT NULL,
	valor decimal(10,2) NOT NULL,
	ano integer,
	PRIMARY KEY(id)
)
EOD;
		return $q;
	}

	public function undo() {}
}
