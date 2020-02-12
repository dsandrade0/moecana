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

      $q2 =
        <<<EOD
INSERT INTO
pagamento(jogador, jan, fev,mar,abr,mai,jun,jul,ago,set,out,nov,dez, ano)
(SELECT 
  id, 
  false,
  false,
  false,
  false,
  false,
  false,
  false,
  false,
  false,
  false,
  false,
  false,
  2020
FROM jogador
WHERE id NOT IN (SELECT jogador FROM pagamento where ano = 2019))
EOD;
      $conn = dbconn();
      $res = $conn->execute($q, array($nome, $gols, $amarelo, $vermelho));
      if ($res) {
        add_msg(SUCCESS, 'Jogador cadastrado com sucesso.');
      }

      $res2 = $conn->executeQuery($q2);
      if ($res2) {
        add_msg(SUCCESS, 'Jogador adicionado as financas');
      }
    } 
  }

  public function composeMenu() {
    return
      <a:menu idMenu="jogador"/>;
  }
}
