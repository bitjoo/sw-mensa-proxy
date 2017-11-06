# studierendenWERK Berlin Mensa Proxy

The only reason this tiny project was created is the fact that there was no way to bookmark your favorite mensa at the sudierendenWERK Berlin website without any usage of cookies.
They have created that feature now, so you can still use that proxy to get rid of the unnecessary data appendage.

## Run on Ubuntu 16.04

### Install PHP
```
sudo apt-get install php php-xml
```

### Install dependencies
```
php composer.phar install
```

### Start PHP server
```
cd public/
php -S localhost:8000
```