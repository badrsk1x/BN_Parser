<?php

use Controllers\PagesController\PagesController;
use Controllers\RealEstateController\RealEstateController;


class Call{

    static public function Action($controller, $action){

        self::call_controller($controller) ;

        switch($controller) {
            case 'pages':
                self::call_controller('RealEstate');
                $controller = new PagesController();
                break;
            case 'RealEstate':
                require_once('Models/RealEstate.php');
                $controller = new RealEstateController($_POST);
                 break;
        }

        $controller->{ $action }();

    }

    private function call_controller($controller){
    require_once('Controllers/' . $controller . '_controller.php');
    }
}


  // we're adding an entry for the new controller and its actions
  $controllers = array(
      'pages' => ['home', 'error'],
      'RealEstate' => ['index']
  );

  if (array_key_exists($controller, $controllers)) {
      if (in_array($action, $controllers[$controller])) {
          Call::Action($controller, $action);
      } else {
          Call::Action('pages', 'error');
      }
  } else {
      Call::Action('pages', 'error');
  }