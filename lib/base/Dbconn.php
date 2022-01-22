<?php
final class Dbconn {
  private $conn;
  private $result;
  private $hasMemcache = false;
  private $mem;

  public function __construct() {
    if (!$GLOBALS['connection']) {
      $this->connect();
    } else {
      $this->conn = $GLOBALS['connection'];
    }
    if ($this->hasMemcache) {
      $this->mem = new Memcache(); 
      $this->mem->addServer($_SERVER['HTTP_HOST']);
    }
  }

  public function connect() {
    $this->conn = pg_connect(
      "host=162.243.146.22
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
    if ($this->hasMemcache) {
      $is_cache = $this->inMemory($q);
      if ($is_cache) {
        //Get data from the cache
        return $this->getCache($q);
      }
    }

    $this->result = pg_query($this->conn, $q);
    if ($this->result) {
      //Set data on cache
      if ($this->hasMemcache) { 
        $this->setCache($q, $result);
      }
      return $this->result;
    } else {
      return null;
    }
  }

  /** 
   * Função usada para UPDATE, INSERT e DELETE
   **/
  public function execute($query, $args = array()) {
    $res = pg_prepare($this->conn, "insert", $query);
    $this->result = pg_execute($this->conn, "insert", $args);
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

  private function inMemory($query) {
    $key = md5($query);
    $cache = $this->mem->get($key);
    if ($cache === false) {
      return false;
    } else {
      return true;
    }
  }

  private function getCache($query) {
    $key = md5($query);
    return $this->mem->get($key);
  }

  private function setCache($query, $result, $time = 3600) {
    $key = md5($query);
    $this->mem->set($key, $result, $time);
  }
}
