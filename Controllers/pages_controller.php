<?php
namespace Controllers\PagesController;

use Vendor\Transport\Transport ;
use Controllers\RealEstateController\RealEstateController;


class PagesController {
    public function home() {

        $obj = new Transport();
        $metros = $obj->GetMetroFromFile(METRO_FILE);
        $requests = new RealEstateController($_POST);

        require_once('Views/form_search.php');
    }


    public function error() {
        require_once('Views/error.php');
    }
}