<?php
namespace CloudFramework\Helpers;

/**
 * Class Response
 * @package CloudFramework\Helpers
 */
Trait Response
{

    public function dumpText($text)
    {
        ob_start();
        header("Content-type: text/html");
        header("Content-length: " . strlen($text));
        echo $text;
        ob_flush();
        ob_end_clean();
        exit(0);
    }

}
