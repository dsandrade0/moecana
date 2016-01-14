<?php
final class AlterarJogadorController extends LayoutController {

  public function composeMenu() {
    return
      <a:menu idMenu="jogador"/>;
  }

  public function processRequest() {
    add_msg(WARNING, 'Ainda em desenvolvimento');  
  }
}
