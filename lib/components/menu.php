<?php
class :a:menu extends :x:element {
  
  attribute
    string idMenu = "none";

  protected function render() {
    $this->idMenu = $this->getAttribute('idMenu');
    $usuario = $_SESSION['usuario'];

    try {
    if ($this->idMenu == -1) {
    return 
      <div class="center span6">
        <ul class="center span5 nav nav-pills prepend-top gray_back">
          <li class={($this->idMenu == "home") ? 'active' : ''}> 
            <a href="home"> Home </a> 
          </li>
          <li class={($this->idMenu == "quem") ? 'active' : ''}>
            <a href="#"> Quem Somos </a> 
          </li>
          <li class={($this->idMenu == "onde") ? 'active' : ''}> 
            <a href="#"> Onde Treinar </a> 
          </li>
          <li class={($this->idMenu == "fotos") ? 'active' : ''}> 
            <a href="#"> Fotos </a> 
          </li>
          <li class={($this->idMenu == "contato") ? 'active' : ''}> 
            <a href="contato"> Contato </a> 
          </li>
        </ul>
        </div>;
    } else {

    return
      <x:frag>
        <div class="navbar navbar-fixed-top">
          <div class="navbar-inner">
            <div class="container">
            <button class="btn btn-navbar" data-target=".nav-collapse" 
             data-toggle="collapse" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button> 
             
              <a class="brand" href="home">
                  <h6 class="pull-right visible-phone"> MoeCana</h6>
              </a>
              <div class="nav-collapse collapse">
                <ul class="nav">
                  <li class="disabled">
                    <a href=""> Bem Vindo {$_SESSION['usuario']->nome} </a>
                  </li>
                  <li class={($this->idMenu == "principal") ? 'active' : ''}> 
                    <a href="/principal"> Home </a> 
                  </li>
                  <li class={($this->idMenu == "pagamentos") ? 'active' : ''}> 
                    <a href="/pagamentos"> Pagamentos </a> 
                  </li>
                  <li class={($this->idMenu == "artilharia") ? 'active' : ''}> 
                    <a href="/artilharia"> Artilharia </a> 
                  </li>
                  <li class={($this->idMenu == "jogador") 
                    ? 'active dropdown' 
                    : 'dropdown'}> 
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> 
                      Jogador 
                      <b class="caret"></b>
                    </a> 
                    <ul class="dropdown-menu">
                      <li> <a href="/jogador/cadastrar"> Cadastrar Jogador</a> </li>
                      <li> <a href="/jogador/alterar"> Alterar Jogador </a> </li>
                    </ul>
                  </li>
                  <li class="offset5"> 
                    <a href="/sair"> Sair </a> 
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </x:frag>;
    }
    } catch (XHPException $e) {
      echo 'Error caused -> '. $e->getMessage();
    }
  }
}
