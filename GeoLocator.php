<?php

class GeoLocator
{
    protected static $_url  = 'http://www.ipgp.net/api/xml/%s';


    public static
    function lookup($ip)
    {
        return self::_fetch($ip);
    }


    public static
    function getCountry($ip)
    {
        if (!$result = self::lookup($ip))
            return false;

        return $result['country'];
    }


    protected static
    function _fetch($ip)
    {
        if (!$content = file_get_contents($source = sprintf(self::$_url, $ip)))
            throw new GeoLocatorException("Failed to fetch content from $source");

        return self::_geoLocation($content);
    }


    protected static
    function _geoLocation($xml)
    {
        if (!$data = self::_xml2array($xml))
            return false;

        if (empty($data) || !is_array($data) || empty($data['IpLookup']))
            return false;

        return new GeoLocation($data['IpLookup']);
    }


    protected static
    function _xml2array($xml)
    {
        $array  = array();

        try
        {
            if (!($xml instanceof SimpleXMLElement))
                $xml    = new SimpleXMLElement($xml);

            if (!$children = $xml->children())
                return (string)$xml;

            foreach ($children as $child)
            {
                $array[$xml->getName()][$child->getName()]
                        = self::_xml2array($child);
            }
        }
        catch (Exception $e)
        {
            throw new GeoLocatorException($e->getMessage());
        }

        return $array;
    }
}

class GeoLocation
{
    protected $_data;

    public
    function __construct($data)
    {
        $this->_data    = (array)$data;
    }


    public
    function __call($name, $args = array())
    {
        return $this->__get($name);
    }


    public
    function __get($name)
    {
        if (array_key_exists($key = ucfirst($name), $this->_data))
            return $this->_data[$key];

        return NULL;
    }
}

class GeoLocatorException
        extends Exception {}