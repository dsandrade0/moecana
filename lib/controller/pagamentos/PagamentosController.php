<?php
final class PagamentosController extends LayoutController {

  public function setContent() {
    return
      <x:frag>
      </x:frag>;
  }

  public function composeMenu() {
    return
      <a:menu idMenu="pagamentos"/>;
  }
  
  public function processRequest() {
    add_msg(WARNING, 'Ainda em desenvolvimento');
  }
}
