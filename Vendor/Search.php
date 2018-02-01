<?php
namespace Vendor\Search;

use Vendor\Parser\Parse;

class Search{

    public $RoomFrom ;
    public $RoomTo ;
    public $PriceFrom;
    public $PriceTo;
    public $Metro;

    public function __construct($request = null){

        if(!$request) $this->SearchEmptyQuery();

        $this->RoomFrom = $request['room-from'] ;
        $this->RoomTo = $request['room-to'] ;
        $this->PriceFrom = $request['price-from'] ;
        $this->PriceTo = $request['price-to'];
        $this->Metro = $request['metro'];
    }


    public function SearchResultsQuery(){

        $BaseUrl = SEARCH_URL ;
        if($this->RoomFrom!=null) $BaseUrl = $BaseUrl."kkv1=".$this->RoomFrom."&";
        if($this->RoomTo!=null) $BaseUrl = $BaseUrl."kkv2=".$this->RoomTo."&";
        if($this->PriceFrom!=null) $BaseUrl = $BaseUrl."price1=".$this->PriceFrom."&";
        if($this->PriceTo!=null) $BaseUrl = $BaseUrl."price2=".$this->PriceTo."&";
        if(!empty($this->Metro)):
            foreach ($this->Metro as $metro_station):
                $BaseUrl = $BaseUrl."metro[]=".$metro_station."&";
            endforeach;
        endif;;

        return $this->SearchResultsFind($BaseUrl);
    }

    public function SearchResultsFind($BaseUrl){

        $parser = new Parse();
        $html = $parser->file_get_contents_curl($BaseUrl);

        $doc = new \DOMDocument();
        @$doc->loadHTML($html);

        $xpath = new \DOMXPath($doc);

        $nodes = $xpath->query('//table[@class="results"]/tr[th[@class="head_kvart"] or td[@width or @class="tooltip"] or td[@class="distr2"] ]');

        // Ready array with flats .
        $results = array();
        // We dont have rooms number all the time in the query result  - we will count them

        $roomCount = 1;

        foreach ($nodes as $row) {

            $cells = array();
            $cell = $row->firstChild;

            while ($cell) {
                $cell->nodeType == XML_ELEMENT_NODE and $cells[] = trim($cell->nodeValue);
                $cell = $cell->nextSibling;
            }

            if (count($cells) == 1) {

                if (strpos($cells[0], 'район') !== false)  {
                    // finding the metro district
                    $metro_rayon = explode('район',$cells[0])[0] ;
                } else {
                    // Room numbers
                    $roomCount = (int)reset($cells);
                }

            } else {

                $cells[0] = $roomCount;
                $cells[13] = $metro_rayon;

                // some rows has colspan on columns with price
                if (count($cells) == 10) {
                    array_splice($cells,
                        6,
                        1,
                        array(0, '', $cells[6], ''));
                }

                // here we go for our result .
                $keys = array( 'rooms', 'address', 'floors', 'houseType', 'area', 'areaLiving', 'areaKitchen', 'toilet', 'price', 'conditions', 'seller', 'phone', 'notes','metro');

                $result[] = array_combine($keys,
                    $cells);
            }
        }

        return $result;
    }

    public function SearchEmptyQuery(){

        $this->RoomFrom = 0 ;
        $this->RoomTo  = 0;
        $this->PriceFrom = 0;
        $this->PriceTo = 0;
        $this->Metro= 0;

    }

}