<?php
final class PagamentosMigration extends Migration {
  
  public function run() {
    $q =
      <<<EOD
CREATE TABLE pagamento
(
  id serial NOT NULL,
  jogador integer NOT NULL,
  jan boolean,
  fev boolean,
  mar boolean,
  abr boolean,
  mai boolean,
  jun boolean,
  jul boolean,
  ago boolean,
  set boolean,
  out boolean,
  nov boolean,
  dez boolean,
  ano integer NOT NULL,
  PRIMARY KEY (id)
)
EOD;
    return $q;
  }

  public function undo() {}
}
