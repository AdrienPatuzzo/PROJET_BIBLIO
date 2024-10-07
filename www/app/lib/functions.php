<?php

//------------------------------------
function debug($var, $mode = 0) 
{
        echo '<div style="background: green; padding: 5px; float: right; clear: both; ">';
        $trace = debug_backtrace(); 
        $trace = array_shift($trace);
        echo "Debug demandé dans le fichier : $trace[file] la ligne $trace[line].<hr />";
        if($mode === 1)
        {
            echo "<pre>"; print_r($var); echo "</pre>";
        }
        else
        {
            echo "<pre>"; var_dump($var); echo "</pre>";
        }
    echo '</div>';
}
//------------------------------------