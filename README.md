# redis-mget-get-pipeline-benchmark
Redis MGET VS GET VS GET + pipeline benchmark

This benchmark shows us how **MGET** is faster than **GET** and **GET** that is wrapped with Redis' pipeline technique.

What does this benchmark?
- [benchmark-redis-test.php](app%2Fbenchmark-redis-test.php) creates 1 000 000 keys in Redis
  - invokes one MGET call with 60 keys
  - invokes 60 times **GET** with 1 key
  - invokes 60 times **GET** with 1 key is wrapped with Redis' pipeline technique
  - calculates execution time for every case

One invoke MGET is faster than 60x **GET** and is faster than 60x **GET** is wrapped with Redis' pipeline technique.

You will be able to see the following results:
```shell
Connection to Redis is successfully
Redis' keys is generating...
Generation is successfully
Time get x60: 3.8268566131592 ms
Time get x60 with pipeline : 0.18596649169922 ms
Time mget x1: 0.14400482177734 ms
```
