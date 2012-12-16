<?php

function oesk_nav($current = false)
{
    $pages = array(
        'index' => array(
            'title' => 'Główna',
            'url' => site_url("oesk/index")
        ),
        'test' => array(
            'title' => 'Testy',
            'url' => site_url("oesk/test")
        ),
        'results' => array(
            'title' => 'Wyniki',
            'url' => site_url("oesk/results")
        ),
    );
    
    $out = '<ul id="nav" class="clearfix">';
    
    foreach($pages as $p => $pData) {
        if($p == $current) {
            $out .= "<li><strong>{$pData['title']}</strong></li>";
        }
        else {
            $out .= "<li><a href='{$pData['url']}'>{$pData['title']}</a></li>";
        }
        
    }
    
    $out .= '</ul>';
    
    
    return $out;
}


?>
