Simple PHP geolocation lib using [ipgp](http://www.ipgp.net/) as backend.

Examples
========

    // Magic
    try
    {
        /* GeoLocation */ $location = GeoLocator::lookup($_SERVER['REMOTE_ADDR']);
    }
    catch (GeoLocatorException $e)
    {
        Logger::log($e);
    }
    
    // Usage Examples
    $country   = $location->country;   // or $location->country();
    $code      = $location->code;      // or $location->code();
    
    $city      = City::findNearest($location->lat, $location->lng);
    
    $location->flag();
    $location->region();
    $location->isp();

TODO
====

* Real user IP detection (proxy)
* Documentation