<?php
namespace Models\RealEstate;

use Vendor\Parser\Parse;

class RealEstate
{
    // we define  attributes
    // they are public so that we can access them using directly
    public $rooms;
    public $adress;
    public $floors;
    public $houseType;
    public $area;
    public $areaLiving;
    public $areaKitchen;
    public $toilet;
    public $price;
    public $conditions;
    public $seller;
    public $phone;
    public $notes;
    public $metro;


    public function __construct()
    {
    }

    public function FindFlats($url)
    {
        $parser = new Parse();
        $html = $parser->file_get_contents_curl($url);

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
                if (strpos($cells[0], 'район') !== false) {
                    // finding the metro district
                    $metro_rayon = explode('район', $cells[0])[0] ;
                } else {
                    // Room numbers
                    $roomCount = (int)reset($cells);
                }
            } else {
                $cells[0] = $roomCount;
                $cells[13] = $metro_rayon;

                // some rows has colspan on columns with price
                if (count($cells) == 10) {
                    array_splice(
                        $cells,
                        6,
                        1,
                        array(0, '', $cells[6], '')
                    );
                }

                // link to site.
                $html = $row->ownerDocument->saveXML($row);
                if (preg_match('~<a href="([^"]+)~u', $html, $match)) {
                    array_unshift($cells, 'http://www.bn.ru'.$match[1]);
                } else {
                    array_unshift($cells, '');
                }

                // here we go for our result .
                $keys = array( 'url','rooms', 'address', 'floors', 'houseType', 'area', 'areaLiving', 'areaKitchen', 'toilet', 'price', 'conditions', 'seller', 'phone', 'notes','metro');

                $result[] = array_combine($keys, $cells);
            }
        }

        return $result;
    }
}
