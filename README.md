# Weather API

![image](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![image](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![image](https://img.shields.io/badge/SQLite-07405E?style=for-the-badge&logo=sqlite&logoColor=white)

## About

It's more kind of exercises with Laravel than "must have" app :)

This is a RestAPI Service (in this case it is weather data for a city) for placing between outer source API (in this case OpenWeather) and your applications. It handle API query, check that data you ask exist in your database. If not it downloades this data from outer API and buffers it in database, or if cannot realize query, returns error information. If data exist, checks is it fresh (you can decide what range you accept), if not upgrades it from outer API and after process returns it. So if applications duplicate queries, the source is your database, not directly outer API.

## Instruction

You must add your api key in .env file as

```
API_KEY=
```

GET: [yourdomain]/api/weather/[country_code]/[city]

in trait Comparable:

```php
namespace App\Http\Traits;

trait Comparable
{
 /**
  * compare sended value of timestamp to now timestamp and check is fit in interval
  * @param string $time time you need to check
  * @param int $interval optional parameter, default is 60 seconds
  * @return bool
  */
 public function compareTime($time, $interval = 60)
 {

  if (strtotime('now') - strtotime($time) < $interval) {
   return true;
  } else {
   return false;
  }
 }
}

```

$interval parameter (seconds) decides about freshness data in database. Default is 60 seconds.

### In this moment, frequency of queries to outer API is a result of settings of API routes in RateLimiter class in App/Providers/RouteServiceProvider.

## License

[MIT](https://choosealicense.com/licenses/mit/)
