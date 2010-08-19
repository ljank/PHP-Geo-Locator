Simple PHP geolocation lib using [ipgp.net](http://www.ipgp.net/) as backend.

Examples
========

    try
    {
        // Magic
        /* GeoLocation */ $location = GeoLocator::lookup($_SERVER['REMOTE_ADDR']);
        
        // Usage Examples
        $User->setCountry($location->country);  // or $location->country();
        $User->setCountryCode($location->code); // or $location->code();
        
        $city   = City::findNearest($location->lat, $location->lng);
        
        $location->flag;    // or $location->flag();
        $location->region;  // or $location->region();
        $location->isp;     // or $location->isp();
    }
    catch (GeoLocatorException $e)
    {
        // Dealing with problems
        Logger::log($e);
    }

TODO
====

* Real user IP detection (proxy)
* Documentation