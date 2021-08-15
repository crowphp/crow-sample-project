## CrowPHP Sample project
This project is to showcase an example of how a real world project might look like. It has two basic endpoints
to show-case the raw performance like "hello world" and the other endpoint that needs to connect to database and fetch some data.


### Requirements
1. PHP-CLI >8.0
2. PHP Swoole Extension
```bash
$ pecl install swoole
```
3. Composer Packages
```bash
$ composer install
```
4. MySQL server
5. Import the sample schema and data from `db_schema/benchmark_db.sql` (the schema looks like as follows)
```mysql
CREATE TABLE `Users` (
  `userId` int(11) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
```
Note: We have a single table Users inside a database named `benchmark` that contains around 100 rows of random data.
6. Finally, adjust your MySQL details in `src/Bootstrap.php`

You can run the project as follows:

```
php server.php
$ Crow server listening on 0.0.0.0:5005
```

## Endpoints

1. `GET /`
This is a hello world example it simple returns `Hello World`
2. `GET /users`
returns a list of users from database in the following format
```json
[{"userId":0,"name":"Rhett Purdy","email":"stamm.deja@example.net"}]
```

## Benchmarking
I have used apache benchmark `Version 2.3 <$Revision: 1843412 $>` to run 20k requests with 30 concurrent calls on the `GET /`endpoint and 100k calls on `GET /users`, and here are the results
1. ```shell
    ab -n 20000 -c 30 http://localhost:5005/
    This is ApacheBench, Version 2.3 <$Revision: 1843412 $>
    Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
    Licensed to The Apache Software Foundation, http://www.apache.org/
    
    Benchmarking localhost (be patient)
    Completed 2000 requests
    Completed 4000 requests
    Completed 6000 requests
    Completed 8000 requests
    Completed 10000 requests
    Completed 12000 requests
    Completed 14000 requests
    Completed 16000 requests
    Completed 18000 requests
    Completed 20000 requests
    Finished 20000 requests
    
    
    Server Software:        CrowPHP/1
    Server Hostname:        localhost
    Server Port:            5005
    
    Document Path:          /
    Document Length:        21 bytes
    
    Concurrency Level:      30
    Time taken for tests:   1.086 seconds
    Complete requests:      20000
    Failed requests:        0
    Total transferred:      3800000 bytes
    HTML transferred:       420000 bytes
    Requests per second:    18408.63 [#/sec] (mean)
    Time per request:       1.630 [ms] (mean)
    Time per request:       0.054 [ms] (mean, across all concurrent requests)
    Transfer rate:          3415.66 [Kbytes/sec] received
    
    Connection Times (ms)
    min  mean[+/-sd] median   max
    Connect:        0    1   0.1      1       4
    Processing:     0    1   0.3      1      11
    Waiting:        0    1   0.3      1      11
    Total:          0    2   0.3      2      12
    
    Percentage of the requests served within a certain time (ms)
    50%      2
    66%      2
    75%      2
    80%      2
    90%      2
    95%      2
    98%      2
    99%      3
    100%     12 (longest request)
   ```
   This first test is trivial but, I still wanted to showcase the raw performance of the framework what this means is that the CrowPHP implementation adds almost no overhead for application.
2. ```shell
   ab -n 100000 -c 30 http://localhost:5005/users
    This is ApacheBench, Version 2.3 <$Revision: 1843412 $>
    Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
    Licensed to The Apache Software Foundation, http://www.apache.org/
    
    Benchmarking localhost (be patient)
    Completed 10000 requests
    Completed 20000 requests
    Completed 30000 requests
    Completed 40000 requests
    Completed 50000 requests
    Completed 60000 requests
    Completed 70000 requests
    Completed 80000 requests
    Completed 90000 requests
    Completed 100000 requests
    Finished 100000 requests
    
    
    Server Software:        CrowPHP/1
    Server Hostname:        localhost
    Server Port:            5005
    
    Document Path:          /users
    Document Length:        7190 bytes
    
    Concurrency Level:      30
    Time taken for tests:   24.018 seconds
    Complete requests:      100000
    Failed requests:        0
    Total transferred:      736600000 bytes
    HTML transferred:       719000000 bytes
    Requests per second:    4163.58 [#/sec] (mean)
    Time per request:       7.205 [ms] (mean)
    Time per request:       0.240 [ms] (mean, across all concurrent requests)
    Transfer rate:          29950.16 [Kbytes/sec] received
    
    Connection Times (ms)
    min  mean[+/-sd] median   max
    Connect:        0    0   0.1      0       6
    Processing:     1    7   2.5      7      45
    Waiting:        1    7   2.5      6      44
    Total:          1    7   2.5      7      45
    
    Percentage of the requests served within a certain time (ms)
    50%      7
    66%      7
    75%      8
    80%      8
    90%     10
    95%     13
    98%     15
    99%     16
    100%     45 (longest request)
   ```
   In this second result we can see that even with decent amount of data transfer the performance drop is not that much the mean stays at `1 ms` and the median at `7 ms` and if we look at our database the connections to the database stays steadily at 12 connections where if we were not using connection pooling we would have a lot more connections to database.

Note: System Specs
* CPU: Intel(R) Core(TM) i7-10510U CPU @ 1.80GHz   2.30 GHz
* RAM: 16.0 GB

## Learn More
Learn more at these links:
- [Website](https://crowphp.com)

## Security
If you discover security related issues, please email yousaf@bmail.pk or use the issue tracker.

## License

The Crow Framework is licensed under the MIT license. See [License File](LICENSE.md) for more information.