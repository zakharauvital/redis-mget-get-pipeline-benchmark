# Redis MGET VS GET VS GET + pipeline benchmark

This benchmark shows us how faster **MGET** is compared to **GET** and **GET** 
that is wrapped with Redis' pipeline technique.


### What does this benchmark do?

- [benchmark-redis-test.php](app%2Fbenchmark-redis-test.php) creates 1 000 000 keys in Redis
  - invokes one MGET call with 60 keys
  - invokes 60 times **GET** with 1 key
  - invokes 60 times **GET** with 1 key is wrapped with Redis' pipeline technique
  - calculates execution time for every case

### Need to have the following software:

```shell
docker >= 20.10.xx
Docker Compose version >= v2.x.x
```

### How to run?

```shell
docker compose up -d
```
### How to stop?

```shell
docker compose down
```

### Conclusion

One invoke MGET is faster than 60x **GET** and is faster than 60x **GET** is wrapped with Redis' pipeline technique.

You will be able to see the following results:
```shell
Connection to Redis is successfully

Redis' keys is generating...
Generation is successfully

Time get x60: 4.133939743042 ms
Time get x60 with pipeline : 0.12397766113281 ms
Time mget x1: 0.092983245849609 ms
```
