<?php
final class SairController extends Controller {
  
  public function processRequest() {
    $_SESSION['usuario'] = null;
    add_msg(SUCCESS, 'Logout feito com sucesso');
    send_redirect('/home');
  }
}
