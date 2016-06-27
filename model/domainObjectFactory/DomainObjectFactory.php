<?php
namespace Mvc\Model\Domain;

class DomainObjectFactory
{
    /**
     * @param $name
     * @param $namespace
     * @return mixed
     */

    function build($name, $namespace, $object = null, $serialized = '')
    {
        $class = $namespace . ucwords($name) . 'Domain';
        return new $class($object, $serialized);
    }
}
