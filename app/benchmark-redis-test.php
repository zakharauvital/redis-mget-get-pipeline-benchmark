<?php

declare(strict_types=1);

const PAYLOAD = '{"type":"Product","id":493842,"attributes":{"pickup_point":{"available":true},"courier":{"available":true}}}';

//Connecting to Redis server on localhost
$redis = new Redis();
$redis->connect('redis', 6379);
echo "Connection to Redis is successfully" . PHP_EOL;

echo "Redis' keys is generating..." . PHP_EOL;

$pipeline = $redis->pipeline();
for ($i = 1; $i <= 100000; $i++) {
    $key = 'test:' . $i;
    $pipeline->set($key, PAYLOAD);
}
$pipeline->exec();

echo "Generation is successfully" . PHP_EOL;

$keys = [];
for ($i = 1; $i <= 60; $i++) {
    $keys[] = sprintf('test:%d', random_int(1, 1000000));
}

$milliseconds1 = microtime(true);
foreach ($keys as $key) {
    $redis->get($key);
}
$time = (microtime(true) - $milliseconds1) * 1000;
echo "Time get x60: $time ms" . PHP_EOL;

$milliseconds1 = microtime(true);
$pipeline = $redis->pipeline();
foreach ($keys as $key) {
    $pipeline->get($key);
}
$res = $pipeline->exec();
$time = (microtime(true) - $milliseconds1) * 1000;
echo "Time get x60 with pipeline : $time ms" . PHP_EOL;

$milliseconds1 = microtime(true);
$redis->mGet($keys);
$time = (microtime(true) - $milliseconds1) * 1000;
echo "Time mget x1: $time ms" . PHP_EOL;

