<?php

namespace view;

class LayoutView {

 //   private $controller;

	//public function __construct(\controller\LoginController $controller) {
	//	$this->controller = $controller;
	//}
  
  public function render($isLoggedIn, $htmlResponse, DateTimeView $dtv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $htmlResponse . '
              
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
      //var_dump($this->controller->isLoggedIn());
      //$test = isset($_SESSION);
      //var_dump($_SESSION["UserName"]);

      
      
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
}
