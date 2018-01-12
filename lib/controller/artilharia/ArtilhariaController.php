<?php
final class ArtilhariaController extends LayoutController {
  private $tabela;
  public $js = array('utils', 'artilharia');

  public function setContent() {
    return
      <x:frag>
        <div class="row">
          <div class="span12">
            <fieldset>
              <legend> Artilharia {Date('Y')} </legend>
              {$this->tabela}
            </fieldset>
          </div>
        </div>
      </x:frag>;
  }
  
  public function processRequest() {
    $usuario = $_SESSION['usuario'];
    $conn = dbconn();
    $q =
      <<<EOD
SELECT * FROM jogador where status = 1 ORDER BY gols DESC;
EOD;
    $this->tabela =
      <table class="table-striped table-hover center span12">
        <tr>
          <th> NOME </th>
          <th> GOLS </th>
          <th> AMARELO </th>
          <th> VERMELHO </th>
        </tr>
      </table>;
    $res = $conn->executeQuery($q);
    while ($obj = pg_fetch_object($res)) {
      $tira_gol;
      $gol_1;
      $gol_2; 
      $amarelo;
      $tira_amarelo;
      $tira_vermelho;
      $vermelho;

      if ($usuario->perfil == 1) {
        $tira_gol =
          <button class="btn btn-mini" 
          onclick={'tiraGol('.$obj->id.','.$obj->gols.')'}>-1</button>; 

        $gol_1 =
          <button class="btn btn-mini" 
          onclick={'gol1('.$obj->id.','.$obj->gols.')'}>+1</button>; 

        $gol_2 =
          <button class="btn btn-mini" 
          onclick={'gol2('.$obj->id.','.$obj->gols.')'}>+2</button>; 

        $tira_amarelo =
          <button class="btn btn-mini" 
          onclick={'tiraAmarelo('.$obj->id.','.$obj->amarelo.')'}>-1</button>; 

        $amarelo =
          <button class="btn btn-mini" 
          onclick={'amarelo('.$obj->id.','.$obj->amarelo.')'}>+1</button>; 

        $tira_vermelho =
          <button class="btn btn-mini" 
          onclick={'tiraVermelho('.$obj->id.','.$obj->vermelho.')'}>-1</button>; 

        $vermelho =
          <button class="btn btn-mini" 
          onclick={'vermelho('.$obj->id.','.$obj->vermelho.')'}>+1</button>; 

      }


      $this->tabela->appendChild(
        <tr class="success">
          <td> {$obj->nome} </td>
          <td> 
            {$tira_gol}
            <span class="badge badge-success">{$obj->gols}</span> 
            {$gol_1}
            {$gol_2}
          </td>
          <td>
		  	{$tira_amarelo}
            <span class="badge badge-warning">{$obj->amarelo}</span> 
            {$amarelo}
          </td>
          <td> 
		  	{$tira_vermelho}
            <span class="badge badge-important">{$obj->vermelho}</span>
            {$vermelho}
          </td>
        </tr>
      ); 
    }
  }

  public function composeMenu() {
    return
      <a:menu idMenu="artilharia"/>;
  }
}
