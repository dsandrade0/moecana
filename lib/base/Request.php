<?php

final class Request {
  private $req;

  public function __construct($req) {
   $this->req = $req; 
  }

  public function getRequest() {
    return $this->req;  
  }

  public function getInt($param, $default = 0) {
    if ($this->req[$param]) {
      return (int) $this->req[$param];
    }
    return $default;  
  }

  public function getString($param, $default = null) {
    if ($this->req[$param]) {
      return (string) $this->req[$param];
    }
    return $default;  
  }

  public function getArray($param, $default = array()) {
    if ($this->req[$param]) {
      return (array) $this->req[$param];
    }
    return $default;
  }

  public function getDouble($param, $default = 0) {
    if ($this->req[$param]) {
      return (double) $this->req[$param];
    }
    return $default;
  }
}
