<?php
final class Dbconn {
  private $conn;
  private $result;

  public function __construct() {
    if (!$GLOBALS['connection']) {
      $this->connect();
    } else {
      $this->conn = $GLOBALS['connection'];
    }
  }

  public function connect() {
    $this->conn = pg_connect(
      "host=localhost
      port=5432
      dbname=moecana
      user=postgres
      password=didijudoc@") or die ("Erro na conexão com banco de dados\n");
    $GLOBALS['connection'] = $this->conn;
  }

  public function close() {
    pg_close($this->conn);
  }

  public function executeQueryParams($q, $args) {
    $this->result = pg_query_params($this->conn, $q, $args);
    if ($this->result) {
      return $this->result;
    } else {
      return null;
    }
  }

  public function executeQuery($q) {
    $this->result = pg_query($this->conn, $q);
    if ($this->result) {
      return $this->result;
    } else {
      return null;
    }
  }

  /** 
   * Função usada para UPDATE, INSERT e DELETE
   **/
  public function execute($query, $args = array()) {
    $name = time();
    $res = pg_prepare($this->conn, $name, $query);
    $this->result = pg_execute($this->conn, $name, $args);
    return $this->result;
  }

  /** Trabalhando com transações em banco de dados **/
  public function beginTransaction() {
    pg_query('BEGIN');
  }

  public function rollbackTransaction() {
    pg_query('ROLLBACK');
  }

  public function commitTransaction() {
    pg_query('COMMIT');
  }
  
  public function getConn() {
    return $this->conn;
  }
}
