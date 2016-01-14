#!/usr/bin/php -q
<?php
include_once "__init__.php";
error_reporting(E_CORE_ERROR);
if (sizeof($migrations_map) == 0) {
  echo "\n------------- NO MIGRATIONS TO RUNNING -------------\n";
} else {
echo "------------- RODANDO MIGRATIONS -------------\n";
  $conn = new Dbconn();
  for ($i=0; $i < sizeof($migrations_map); $i++) {
    $class = $migrations_map[$i];
    $obj = new $class();
    $result = $obj->go($conn);
    $msg= '';
    if (!$result) {
      $msg = "SKIP";
    } else {
      $msg = "RUNNING";
    }
    echo $class."\t\t .............. ". $msg."\n";
  }
}

echo "\n>>>>>>>>>>>>>>>>>> DONE <<<<<<<<<<<<<<<<<<\n\n";
