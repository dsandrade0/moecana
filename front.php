<?php
/*
 * Design Patter of Front Controller
 * http://en.wikipedia.org/wiki/Front_Controller_pattern
 */
$PROJECT_NAME = 'dlite';
session_start();

//Variaveis que teram o código da página
$GLOBALS['response'] = '';
$GLOBALS['js_call'] = '';
$GLOBALS['head'] = '';
if(!isset($GLOBALS['connection'])) {
	$GLOBALS['connection'] = null;
}

include_once 'application_configuration.php';
require_once('lib/third/__init__.php');
include_once 'lib/base/__ini__.php';
require_path('lib/base');
require_path('lib/components');

$_GET['__key__'] = ($_GET['__key__']) ? $_GET['__key__'] : 'home';
$uri = explode('/',$_GET['__key__']);
$controller_class = null;
$controller = null;
$num = count($uri);
$path = ''; 
$method = (is_post()) ? $_POST : $_GET;

if (is_post()) {
  $method = $_POST;
} else if (is_get()) {
  $method = $_GET;
} else if (is_put()) {
  $method = $_PUT;
} else if (is_delete()) {
  $method = $_DELETE;
}

$req = new Request($method);

if ($num == 1) {
	$path = $uri[0].'/';
	$controller_class = $map['/'.$uri[0]];

	if ($controller_class != ''){
		require_once('lib/controller/'.$path.$controller_class.'.php');
		$controller = new $controller_class($req);
	}
	
} else {
  	for ($i=0; $i<= $num-1; $i++) {
	  	if ($uri[$i]=='') {
	  	} else {
		  	$path .= '/'.$uri[$i];
	  	}
  	}
  	$controller_class = $map[$path];

  	if ($controller_class != '') {
  		require_once('lib/controller'.$path.'/'.$controller_class.'.php');
  		$controller = new $controller_class($req);
  	}
}

if (!isset($controller)) {
  send_redirect('error');
} else {
  if ($controller instanceof Controller) {
    $controller->processRequest();
  }

	if ($controller instanceof WebController) {
    $GLOBALS['response'] .= $controller->composePage();
  } 

  if ($controller instanceof RestController) {
   echo json_encode($controller->restResponse());
	}
  echo $GLOBALS['response'].$GLOBALS['js_call'];
}
