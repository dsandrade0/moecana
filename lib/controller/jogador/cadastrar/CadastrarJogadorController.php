<?php
final class CadastrarJogadorController extends LayoutController {
  private $form;

  public function setContent() {
    return
      <x:frag>
        <div class="row margin-top">
          <div class="span12">
            {$this->form}
          </div>
        </div> 
      </x:frag>;
  }

  public function processRequest() {
    $usuario = $_SESSION['usuario'];
    if ($usuario->perfil == 1) {
      $this->form = 
        <form action="#" method="post" class="box prepend-top">
          <fieldset class="center">
            <legend> Cadastro de Jogador </legend>
            <label> Nome do jogador </label>
            <input type="text" name="nome"/>
            <label> Numero de gols </label>
            <input type="number" name="gols"/>
            <label> Cartões amarelos </label>
            <input type="number" name="amarelo"/>
            <label> Cartões vermelhos </label>
            <input type="number" name="vermelho"/> <br/>
            <input type="submit" 
              value="Cadastrar" class="btn btn-primary offset1"/>
          </fieldset>
        </form>;
    }
    if (is_post()) {
      $r = $this->getRequest();
      $nome = $r->getString('nome');
      $amarelo = $r->getInt('amarelo', 0);
      $gols = $r->getInt('gols', 0);
      $vermelho = $r->getInt('vermelho', 0);

      if (!$nome) {
        add_msg(ERROR, 'O nome do jogador precisar ser preenchido!');
        return;
      }

      $q =
        <<<EOD
INSERT INTO jogador(nome, gols, amarelo, vermelho) VALUES($1, $2, $3, $4);
EOD;
      $conn = dbconn();
      $res = $conn->execute($q, array($nome, $gols, $amarelo, $vermelho));
      if ($res) {
        add_msg(SUCCESS, 'Jogador cadastrado com sucesso.');
      }
    } 
  }

  public function composeMenu() {
    return
      <a:menu idMenu="jogador"/>;
  }
}
