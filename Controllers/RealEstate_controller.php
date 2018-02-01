<?php
namespace Controllers\RealEstateController;

use Models\RealEstate\RealEstate;

class RealEstateController
{
    public $RoomFrom ;
    public $RoomTo ;
    public $PriceFrom;
    public $PriceTo;
    public $Metro;

    private $BnUrl ;

    public function __construct($request = null)
    {
        $this->RoomFrom = $request['room-from'] ;
        $this->RoomTo = $request['room-to'] ;
        $this->PriceFrom = $request['price-from'] ;
        $this->PriceTo = $request['price-to'];
        $this->Metro = $request['metro'];
        $this->BnUrl = $this->SearchResultsQuery();
    }


    public function index()
    {
        $inner = new RealEstate()  ;
        $RealEstate = $inner->FindFlats($this->BnUrl);

        require_once('Views/RealEstate/index.php');
    }

    public function SearchResultsQuery()
    {
        $BaseUrl = SEARCH_URL ;
        if ($this->RoomFrom!=null) {
            $BaseUrl = $BaseUrl."kkv1=".$this->RoomFrom."&";
        }
        if ($this->RoomTo!=null) {
            $BaseUrl = $BaseUrl."kkv2=".$this->RoomTo."&";
        }
        if ($this->PriceFrom!=null) {
            $BaseUrl = $BaseUrl."price1=".$this->PriceFrom."&";
        }
        if ($this->PriceTo!=null) {
            $BaseUrl = $BaseUrl."price2=".$this->PriceTo."&";
        }
        if (!empty($this->Metro)):
            foreach ($this->Metro as $metro_station):
                $BaseUrl = $BaseUrl."metro[]=".$metro_station."&";
        endforeach;
        endif;

        return $BaseUrl;
    }
}
