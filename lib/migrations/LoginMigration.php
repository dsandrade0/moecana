<?php
final class LoginMigration extends Migration {

  public function run() {
    $q =
      <<<EOD
CREATE TABLE login
(
  id serial NOT NULL,
  login varchar(255) NOT NULL,
  senha varchar(255) NOT NULL,
  nome varchar(255) NOT NULL,
  perfil integer NOT NULL,
  PRIMARY KEY (id)
)
EOD;
    return $q;
  }

  public function undo() {}
}
