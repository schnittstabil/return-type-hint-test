<?php
/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ fileInfos ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ */
$fileInfos = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('src'));

$files = [];
foreach($fileInfos as $fileInfo) {
    if ($fileInfo->isDir()) {
        continue;
    }
    $files[]  = (string) $fileInfo;
}

sort($files);

@unlink('readme.md');

$readme = fopen('readme.md','w');

fwrite($readme, '# Return Type-Hint Test'.PHP_EOL);

fwrite($readme, '```'.PHP_EOL);
fwrite($readme, trim(shell_exec('php -v')).PHP_EOL);
fwrite($readme, '```'.PHP_EOL);

foreach($files as $file) {
    fwrite($readme, PHP_EOL.'---'.PHP_EOL.PHP_EOL);
    fwrite($readme, '## '.$file.PHP_EOL.PHP_EOL);
    fwrite($readme, '### Script'.PHP_EOL.PHP_EOL);
    fwrite($readme, '```php'.PHP_EOL);

    $fileContents = file_get_contents($file);
    $fileContents = preg_split('/^require.*autoload.php\';/m', $fileContents)[1];

    fwrite($readme, trim($fileContents).PHP_EOL);
    fwrite($readme, '```'.PHP_EOL);
    fwrite($readme, '### Output'.PHP_EOL.PHP_EOL);
    fwrite($readme, '```'.PHP_EOL);
    fwrite($readme, shell_exec('php '.escapeshellarg($file).' 2>&1').PHP_EOL);
    fwrite($readme, '```'.PHP_EOL);
}

fclose($readme);
