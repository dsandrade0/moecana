<?php
final class ErrorController extends LayoutController {
  public $js = array('utils');

  public function setContent() {
    header('Status: 404', false, 404);
    return
      <x:frag>
        <h3>Erro 404 - Página não encontrada</h3>
        <a href="#" 
          class="btn btn-primary" 
          onclick="Utils.back()">Voltar</a>
        &nbsp;<a href="#" onclick="alert(Utils.ip())">Ip</a>
      </x:frag>;
  }

  public function processRequest() {

  }

}
