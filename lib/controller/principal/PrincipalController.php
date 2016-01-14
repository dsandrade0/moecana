<?php
final class PrincipalController extends LayoutController {
  
  public function setContent() {
    return
      <x:frag>
        <div class="row">
        <div class="center">
            <img class="center" src={get_image('moecana.jpg')}/> 
          </div>
        </div>
      </x:frag>;
  }

  public function processRequest() {
    $is_user = valida_usuario();
    if (!$is_user) {
      print_r($_SESSION['usuario']);
      add_msg(ERROR, 'Usuario nao validado');
      send_redirect('/home');
    } 
  }

  public function composeMenu() {
    return
      <a:menu idMenu="principal"/>;
  }
}
