<?php

use Lavoiesl\PhpBenchmark\Benchmark;

require_once './vendor/autoload.php';

$data = [];
for ($i=0; $i<100000; $i++) {
    $data[] = [
        'string' => 'hogehogehoge',
        'num' => 10000,
        'bool' => true,
        'array' => [1,2,3,4,5,6,7,8,9,10],
        'hash' => ['aaa'=>111, 'bbb'=>'string', 'ccc'=>false],
        'null' => null,
    ];
}

$serialized = serialize($data);
$json_encoded= json_encode($data);


$benchmark = new Benchmark;

declare(ticks=1);

$benchmark->add('serialize', function() use ($data) { return serialize($data); });
$benchmark->add('json_encode', function() use ($data) { return json_encode($data); });
$benchmark->setCount(1);
$benchmark->run();



$benchmark = new Benchmark;

$benchmark->add('unserialize', function() use ($serialized) { return unserialize($serialized); });
$benchmark->add('json_decode', function() use ($json_encoded) { return json_decode($json_encoded, true); });
$benchmark->setCount(1);
$benchmark->run();
