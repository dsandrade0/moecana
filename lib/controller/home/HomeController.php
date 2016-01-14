<?php
class HomeController extends LayoutController {
 /**
  * Seta css adicionais que estão posicionados em/htdocs/css/
  * no exemplo abaixo temos o arquivo /htdocs/css/componente.css
  * criado na pasta.
  */ 
  public $css = array();

  /**
   * Seta javascripts adicionais a esta página. Estes estão criados em
   * /htdocs/js
   * no exemplo abaixo temos os arquivos /htdocs/js/lightbox.js
   * estão criados na pasta.
   */
  public $js = array('lightbox');

  /**
   * Função que seta o título da página
   */
  public function setTitle() {
    return 'MoecanaFC';
  }

  public function setContent() {
    return
      <x:frag>
        <div class="row">
          <div class="span6">
          </div>
          <div class="span6">
            <form action="" method="post" 
              class="form-horizontal prepend-top pull-right">
              <input type="text" name="login" placeholder="login"/>
              <input type="password" name="senha" placeholder="senha"/>
              <input type="submit" value="Entrar" class="btn"/>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="span12 center">
            <img src={get_image('moecana.jpg')}/>
          </div>
        </div>
      </x:frag>;
  }

  public function composeMenu() {}
  /**
   * Função usada para processar as requisições feitas a este controller
   */
  public function processRequest() {
    $_SESSION['usuario'] = null;
    if (is_post()) {
      $r = $this->getRequest();
      $login = $r->getString('login');
      $senha = $r->getString('senha');

      if (!$login || !$senha) {
        add_msg(ERROR, 'Preencha login e/ou senha');
        return;
      }

      $this->login($login, $senha);
    }
  }

  private function login($login, $senha) {
    $conn = dbconn();
    $q =
      <<<EOD
SELECT id, nome, perfil FROM login WHERE login=$1 AND senha=$2;
EOD;

    $res = $conn->executeQueryParams($q, array($login, $senha));

    if ($res != null) {
      if ($row = pg_fetch_object($res)) {
        $_SESSION['usuario'] = $row;
        send_redirect('/principal');
      } else {
        add_msg(ERROR, 'Usuario não cadastrado');
        return;
      }
    } 
  }
}
