<?php
final class StatusJogadorMigration extends Migration {
  
  public function run() {
    $q =
      <<<EOD
ALTER TABLE jogador ADD COLUMN status int not NULL DEFAULT 1;
EOD;
    return $q;
  }

  public function undo() {}
}
