<?php
abstract class Migration {

  abstract protected function run();
  abstract protected function undo();

  public function go($conn) {
    try {
      $result = $conn->executeQuery($this->run());
    } catch(Exception $e) {
      return false;
    }
    return $result;
  }
}
