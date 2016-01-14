<?php
class :d:componente extends :x:element {
  
  attribute
    string title = 'Chat';

  protected function render() {
    $this->title = $this->getAttribute('title');
    return  
      <x:frag>
        <div class="chat center">
          <h4> {$this->title}</h4>
          <a href="http://google.com"> Google </a>
        </div>
    </x:frag>;
  }
}
