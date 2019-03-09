<?php
class WebController extends Controller {
  public $js;
  public $css;

  public final function composePage() {
    $html = '<!DOCTYPE html>';
    $html .= '<html lang="pt-br">';
    $html .= '<meta http-equiv="Content-Type" 
      content="text/html;charset=utf8">';
    $html .= '<head>';
    $html .= '<link rel="icon" href="'.get_image("favicon.ico").'" type="image/x-icon"/>';
    $html .= '<title>'.$this->setTitle().'</title>';
    $html .= '<meta name="viewport" content="width=device-width">';
    $html .= $this->setHead();
    $html .= $this->setCss();
    $html .= $this->setJS();
    $html .= '</head>';
    $html .= '<body>'.(string)$this->composeBody().'</body>';
    $html .= '</html>';
    return $html;
  }

/*
 * This function can be fragmented in minimal functions to make a page
 */

  protected function composeBody() {
  }

  protected function processRequest() {
  }

  protected function setTitle() {
  }

  public function setCss() {
    $html = '';
    $html .= '<link rel="stylesheet" type="text/css" 
      href="/htdocs/css/bootstrap.min.css"/>';
    $html .= '<link rel="stylesheet" type="text/css" 
      href="/htdocs/css/layout.css"/>';
    $html .= '<link rel="stylesheet" type="text/css" 
      href="/htdocs/css/docs.css"/>';
    $html .= '<link rel="stylesheet" type="text/css" 
      href="/htdocs/css/bootstrap-responsive.min.css"/>';
    if (!empty($this->css)) {
      foreach ($this->css as $css) {
       $html .= '<link rel="stylesheet" type="text/css"'.
         'href="/htdocs/css/'.$css.'.css"/>'; 
      }
    } 
    return $html;
  }


  public function setJs() {
    $html = '';
    $html .= '
			<script type="text/javascript" src="/htdocs/js/jquery.js"></script>
			<script data-main="/htdocs/js/main" src="/htdocs/js/require.js"></script>
    	<script type="text/javascript" src="/htdocs/js/bootstrap.min.js"></script>';

    if (!empty($this->js)) {
      foreach ($this->js as $js) {
       $html .= '<script type="text/javascript"'.
         'src="/htdocs/js/'.$js.'.js"></script>'; 
      }
    } 
    return $html;
  }

  protected function setHead() {
    $r = $GLOBALS['head'];
    $GLOBALS['head'] = '';
    return $r;
  }

  protected function getRequest() {
    if ($this->request) {
     return $this->request;
    }
  }
}
