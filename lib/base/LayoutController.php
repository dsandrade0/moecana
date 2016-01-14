<?php
class LayoutController extends WebController {
  
  protected function setTitle() {
    return 'MoecanaFC';
  }

  protected function composeBody() {
    $html = 
      <x:frag>
        <div class="container">
          <div class="row">
            {$this->composeMenu()} 
          </div>
          <div class="row">
            <div class="span12 margin-top">
              {$this->getMsg()} 
            </div>
          </div>
            {$this->setContent()}
            {$this->composeFooter()}
        </div>
      </x:frag>;
    return $html;
  }

  protected function setContent() {
    return
      <x:frag>
        <div class="row-fluid">
          <div class="span2">
            {$this->composeFirstColl()}
          </div>
          <div class="span8">
            {$this->composeSecondColl()}
          </div>
          <div class="span2">
            {$this->composeThirdColl()}
          </div>
        </div>
      </x:frag>;
  }

  protected function composeFirstColl() {
    return 'Teste coluna 1';
  }

  protected function composeSecondColl() {
    return 'Teste coluna 2';
  }

  protected function composeThirdColl() {
    return 'Teste coluna 3';
  }

  protected function composeMenu() {
    return
      <x:frag>
        <div class="span12 center box">
        </div>
        <hr/>
      </x:frag>;
  }

  protected function composeTop() {
  }

  protected function composeFooter() {
    return
      <x:frag>
        <footer class="footer hidden-phone">
          <div class="container">
            <p> MoecanaFC - {date('Y')}</p>
          </div>
        </footer>

       <!-- visão mobile -->
        <footer class="footer visible-phone">
          <div class="container">
            <p>MoecanaFC - {date('Y')}</p>
          </div>
          </footer>
        </x:frag>;
  }
}
