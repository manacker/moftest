<?php

$file = fopen('/Users/manacker/Downloads/top1000.csv','r');

$line=0;
while(!feof($file)) {
    $line++;
    $r=fgetcsv($file,1000,',','"');
    $name = str_replace(array(':','·','/'),'-',trim($r[5]));

    if(!$name or $line==1) continue;
    $folder = floor($r[10]/10).'0er';
    $filename = sprintf('%s (%d).mkv',$name, $r[10]);
    echo $filename."\n";
    $data[$folder]++;
    @mkdir('/Volumes/video/films/'.$folder);
    file_put_contents('/Volumes/video/films/'.$folder.'/'.$filename,'dummy');
}

ksort($data);
print_r($data);