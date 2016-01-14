<?php
final class ArtilhariaController extends LayoutController {
  private $tabela;

  public function setContent() {
    return
      <x:frag>
        <div class="row box">
          <div class="span12">
            <fieldset>
              <legend> Artilharia 2016 </legend>
            </fieldset>
            <div class="span12 center prepend-bottom">
              {$this->tabela}
            </div>
          </div>
        </div>
      </x:frag>;
  }
  
  public function processRequest() {
    $conn = dbconn();
    $q =
      <<<EOD
SELECT * FROM jogador ORDER BY gols DESC;
EOD;
    $this->tabela =
      <table class="table-striped span10">
        <tr>
          <th> NOME </th>
          <th> GOLS </th>
          <th> AMARELO </th>
          <th> VERMELHO </th>
        </tr>
      </table>;
    $res = $conn->executeQuery($q);
    while ($obj = pg_fetch_object($res)) {
      $this->tabela->appendChild(
        <tr>
          <td> {$obj->nome} </td>
          <td> <span class="badge badge-success">{$obj->gols}</span> </td>
          <td> <span class="badge badge-warning">{$obj->amarelo}</span> </td>
          <td> <span class="badge badge-important">{$obj->vermelho}</span> </td>
        </tr>
      ); 
    }
  }

  public function composeMenu() {
    return
      <a:menu idMenu="artilharia"/>;
  }
}
