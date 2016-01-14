<?php
final class JogadorMigration extends Migration {
  
  public function run() {
    $q =
      <<<EOD
CREATE TABLE jogador
(
  id serial NOT NULL,
  nome varchar(255) NOT NULL,
  gols integer NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
)
EOD;
    return $q; 
  }

  public function undo() {}
}
