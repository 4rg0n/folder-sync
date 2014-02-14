<?php

namespace OST\Loader;

use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;

class Config extends FileLoader
{
    /**
     * @see Symfony\Component\Config\Loader\FileLoader::load()
     *
     * @param mixed $resource
     * @param null $type
     * @return array|bool|float|int|mixed|null|number|string
     */
    public function load($resource, $type = null)
    {
        $configValues = Yaml::parse($resource);

        return $configValues;
    }


    /**
     * @see Symfony\Component\Config\Loader\FileLoader::supports()
     *
     * @param mixed $resource
     * @param null $type
     * @return bool
     */
    public function supports($resource, $type = null)
    {
        return is_string($resource) && 'yml' === pathinfo(
            $resource,
            PATHINFO_EXTENSION
        );
    }
} 