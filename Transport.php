<?php
namespace Transport;

use \Parser\Parse;


class Transport  {

   public function GetMetroFromFile($file=null)
    {
        if (!$file or 0 == filesize( $file ) )
            $this->GetMetroFromBn() ;


        $contents = file_get_contents($file);
        $contents = utf8_encode($contents);
        $results = json_decode($contents);

        return $results ;

    }

    public function GetMetroFromBn()
    {

        $parser = new Parse();
        $html = $parser->file_get_contents_curl(BN_URL);

        $doc = new \DOMDocument();
        @$doc->loadHTML($html);
        $nodes = $doc->getElementById('metro')->getElementsByTagName('option');

        $metro = [];

        foreach($nodes as $key=>$optionNode) {
            $metro[$key]['Name'] = $optionNode->nodeValue;
            $metro[$key]['Id'] =  $optionNode->getAttribute('value');
        }

        $file = METRO_FILE ;

        file_put_contents($file, json_encode($metro));

    }


}

