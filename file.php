<?php

$file = fopen('uploads/sample.txt', 'r');
if ($file)
    while ($contents = fgetcsv($file)) {
        print_r($contents);
        echo "<br>";
    }
