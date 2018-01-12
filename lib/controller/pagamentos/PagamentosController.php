<?php
final class PagamentosController extends LayoutController {
  public $js = array('utils', 'pagamento');
  private $jogadores, $valorArrecadado = 0;

  public function setContent() {
    return
      <x:frag>
        <div class="row box">
          <div class="span12">
            <fieldset>
              <legend>
                Pagamentos {date('Y')} -
                Total Arrecadado R$ {$this->valorArrecadado*20},00 
              </legend>
              {$this->jogadores}
            </fieldset>
          </div>
        </div>
      </x:frag>;
  }

  public function composeMenu() {
    return
      <a:menu idMenu="pagamentos"/>;
  }
  
  public function processRequest() {
    $this->jogadores =
      <table class="table table-bordered prepend-bottom table-hover">
        <tr>
          <th>NOME</th>
          <th>Jan</th>
          <th>Fev</th>
          <th>Mar</th>
          <th>Abr</th>
          <th>Mai</th>
          <th>Jun</th>
          <th>Jul</th>
          <th>Ago</th>
          <th>Set</th>
          <th>Out</th>
          <th>Nov</th>
          <th>Dez</th>
        </tr>
      </table>;
    $conn = dbconn();
    $ano = date('Y');
    $q =
      <<<EOD
SELECT 
  j.nome,
  j.id,
  p.jan,
  p.fev,
  p.mar,
  p.abr,
  p.mai,
  p.jun,
  p.jul,
  p.ago,
  p.set,
  p.out,
  p.nov,
  p.dez
FROM jogador j, pagamento p
WHERE p.ano=$1
  AND j.id=p.jogador
  AND j.status = 1
ORDER BY j.nome ASC
EOD;

    $res = $conn->executeQueryParams($q, array($ano)); 
    $usuario = $_SESSION['usuario'];
    if ($usuario->perfil == 1) {
      $this->montarAdm($res);
    } else {
      while ($o = pg_fetch_object($res)) {
        $this->jogadores->appendChild(
          <tr class="center">
            <td> {$o->nome} </td>
            <td> 
                {$this->traduzir($o->jan)} 
            </td>
            <td> 
                {$this->traduzir($o->fev)} 
            </td>
            <td> 
                {$this->traduzir($o->mar)} 
            </td>
            <td> 
                {$this->traduzir($o->abr)} 
            </td>
            <td> 
                {$this->traduzir($o->mai)}
            </td>
            <td> 
                {$this->traduzir($o->jun)}
            </td>
            <td> 
                {$this->traduzir($o->jul)}
            </td>
            <td> 
                {$this->traduzir($o->ago)} 
            </td>
            <td> 
                {$this->traduzir($o->set)}
            </td>
            <td> 
                {$this->traduzir($o->out)}
            </td>
            <td> 
                {$this->traduzir($o->nov)} 
            </td>
            <td> 
                {$this->traduzir($o->dez)}
            </td>
          </tr>
        ); 
      }
      
    } 
  }

  private function traduzir($bool) {
    if ($bool == 'f') {
      return
        <img width="15px" height="15px" src={get_image('x.png')}/>;
    } else {

      $this->valorArrecadado++;
      return
          <img width="15px" height="15px" src={get_image('ok.png')}/>;
    }
  }

  private function montarAdm($res) {
    while ($o = pg_fetch_object($res)) {
      $this->jogadores->appendChild(
        <tr class="center">
          <td> {$o->nome} </td>
          <td> 
            <button class="btn btn-mini" 
              onclick={'pagamentoToggle('.$o->id.',\'jan\',\''.$o->jan.'\')'}>
              {$this->traduzir($o->jan)} 
            </button>
          </td>
          <td> 
            <button class="btn btn-mini" 
              onclick={'pagamentoToggle('.$o->id.',\'fev\',\''.$o->fev.'\')'}>
              {$this->traduzir($o->fev)} 
            </button>
          </td>
          <td> 
            <button class="btn btn-mini" 
              onclick={'pagamentoToggle('.$o->id.',\'mar\',\''.$o->mar.'\')'}>
              {$this->traduzir($o->mar)} 
            </button>
          </td>
          <td> 
            <button class="btn btn-mini" 
              onclick={'pagamentoToggle('.$o->id.',\'abr\',\''.$o->abr.'\')'}>
              {$this->traduzir($o->abr)} 
            </button>
          </td>
          <td> 
            <button class="btn btn-mini" 
              onclick={'pagamentoToggle('.$o->id.',\'mai\',\''.$o->mai.'\')'}>
              {$this->traduzir($o->mai)}
            </button>
          </td>
          <td> 
            <button class="btn btn-mini" 
              onclick={'pagamentoToggle('.$o->id.',\'jun\',\''.$o->jun.'\')'}>
              {$this->traduzir($o->jun)}
            </button>
          </td>
          <td> 
            <button class="btn btn-mini" 
              onclick={'pagamentoToggle('.$o->id.',\'jul\',\''.$o->jul.'\')'}>
              {$this->traduzir($o->jul)}
            </button>
          </td>
          <td> 
            <button class="btn btn-mini" 
              onclick={'pagamentoToggle('.$o->id.',\'ago\',\''.$o->ago.'\')'}>
              {$this->traduzir($o->ago)} 
            </button>
          </td>
          <td> 
            <button class="btn btn-mini" 
              onclick={'pagamentoToggle('.$o->id.',\'set\',\''.$o->set.'\')'}>
              {$this->traduzir($o->set)}
            </button>
          </td>
          <td> 
            <button class="btn btn-mini" 
              onclick={'pagamentoToggle('.$o->id.',\'out\',\''.$o->out.'\')'}>
              {$this->traduzir($o->out)}
            </button>
          </td>
          <td> 
            <button class="btn btn-mini" 
              onclick={'pagamentoToggle('.$o->id.',\'nov\',\''.$o->nov.'\')'}>
              {$this->traduzir($o->nov)} 
            </button>
          </td>
          <td> 
            <button class="btn btn-mini" 
              onclick={'pagamentoToggle('.$o->id.',\'dez\',\''.$o->dez.'\')'}>
              {$this->traduzir($o->dez)}
            </button>
          </td>
        </tr>
      ); 
    }
  }
}
