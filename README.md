Simple PHP geolocation lib using http://www.ipgp.net/ as backend.

Usage
=====

    try
    {
        /* GeoLocation */ $location = GeoLocator::lookup($_SERVER['REMOTE_ADDR']);
    }
    catch (GeoLocatorException $e)
    {
        Logger::log($e);
    }
    
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