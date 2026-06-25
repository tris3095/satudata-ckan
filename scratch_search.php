<?php
$lines = file('d:\web\satudata-ckan\resources\views\metadata\show.blade.php');
foreach($lines as $i => $l) {
    if(strpos($l, '$collectionData[') !== false && strpos($l, '??') === false) {
        echo ($i+1) . ': ' . trim($l) . "\n";
    }
}
