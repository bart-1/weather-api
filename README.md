# Weather API

![image](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![image](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![image](https://img.shields.io/badge/SQLite-07405E?style=for-the-badge&logo=sqlite&logoColor=white)

## About

It's more kind of exercises with Laravel than "must have" app :)

This is a RestAPI Service (in this case it is weather data for a city) for placing between outer source API (in this case OpenWeather) and your applications. It handle API query, check that data you ask exist in your database. If not it downloades this data from outer API and buffers it in database, or if cannot realize query, returns error information. If data exist, checks is it fresh (you can decide what range you accept), if not upgrades it from outer API and after process returns it. So if applications duplicate queries, the source is your database, not directly outer API.

## Instruction

1. You must add your Open Weather api key in .env file as

```
API_KEY=
```
2. Set how often is possible to query outer source API:
``` php
FrequencyModelUpdateController::$frequency 

```

3. Set how long model data is accepted as fresh.
``` php
TimestampsFreshnessController::$acceptedInterval
```

4. Query by GET: 
```
[yourdomain]/api/weather/[country_code]/[city]
```

## License

[MIT](https://choosealicense.com/licenses/mit/)
