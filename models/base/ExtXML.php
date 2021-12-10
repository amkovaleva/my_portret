<?php

namespace app\models\base;

use SimpleXMLElement;

class ExtXML extends SimpleXMLElement
{
    public static function rotateSVG($file)
    {
        //Set the vars of the primary attributes we want to edit
        $w = "width";
        $h = "height";
        $viewbox = "viewBox";

        $xml = simplexml_load_file($file); //Load the File.
        $sxe = new ExtXML($xml->asXML()); //Load the child class (it will load the main one)

        $sizes = explode(" ", $sxe->attributes()->$viewbox);

        //Get SVG Width & Height
        $width = $sizes[3] . 'px';
        $height = $sizes[2] . 'px';

        //Get viewBox and background
        $sxe->attributes()->$viewbox = "0 0 " . $sizes[3] . " " . $sizes[2];

        //Get the numerical values for width and height
        $rw = floatval($sizes[3]);

        //Swap width and height
        $oldW = (string)$sxe->attributes()->$w;
        $sxe->attributes()->$w = $width;
        $sxe->attributes()->$h = $height;


        // Get the parents node childrens
        $nodeChildrens = $sxe->children();

        //If the transform attribute is set, this svg has already been rotated, as such, we'll just unset it
        if (isset($nodeChildrens->g->attributes()->transform)) {
            unset($nodeChildrens->g->attributes()->transform);
        } else {
            // Otherwise, we're going to add in the transform data for the rotation and re-centering.
            $nodeChildrens->g->addAttribute('transform', "translate(" . $rw . ") rotate(90)");
        }

        //This next line will overwrite the original XML file with new data added
        $file = str_replace(".svg", "_r.svg", $file);

        $sxe->asXML($file);

    }
}