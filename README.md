[![Plant a Tree](https://img.shields.io/badge/dynamic/json?color=brightgreen&label=Plant%20a%20Tree&query=%24.total&url=https%3A%2F%2Fpublic.offset.earth%2Fusers%2Ftreeware%2Ftrees)](https://plant.treeware.earth/freshbitsweb/laravel-google-analytics-4-measurement-protocol)

# Laravel Google Analytics 4 Measurement Protocol
A Laravel package to use [Measurement Protocol for Google Analytics 4](https://developers.google.com/analytics/devguides/collection/protocol/ga4).

## Introduction
This package allows you to post events to Google Analytics 4 from your Laravel backend.

## Installation
1) Install the package by running this command in your terminal/cmd:
```bash
composer require freshbitsweb/laravel-google-analytics-4-measurement-protocol
```

2) Set `MEASUREMENT_ID` and `MEASUREMENT_PROTOCOL_API_SECRET` in your .env file.
You can get them from: Google Analytics > Admin > Data Streams > [Select Site] > Measurement Protocol API secrets

Optional: You can publish the config file by running this command in your terminal/cmd:
```bash
php artisan vendor:publish --tag=laravel-google-analytics-4-measurement-protocol-config
```

3) Add a call to the package provided blade component which makes a POST request to the backend to store the client id in the session which is later used to post events to Google Analytics 4.

```html
<!-- Google Analytics Code -->
<x-google-analytics-client-id />
<!-- </head> -->
```

## Authors

* [**Gaurav Makhecha**](https://github.com/gauravmak) - *Initial work*

See also the list of [contributors](https://github.com/freshbitsweb/laravel-google-analytics-4-measurement-protocol/graphs/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

## Treeware

You're free to use this package, but if it makes it to your production environment I would highly appreciate you buying the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to <a href="https://www.bbc.co.uk/news/science-environment-48870920">plant trees</a>. If you contribute to our forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees at for our forest here [offset.earth/treeware](https://plant.treeware.earth/freshbitsweb/laravel-google-analytics-4-measurement-protocol)

Read more about Treeware at [treeware.earth](http://treeware.earth)

## Special Thanks to

* [Laravel](https://laravel.com) Community
