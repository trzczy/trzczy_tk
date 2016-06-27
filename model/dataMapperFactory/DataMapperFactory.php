<?php
namespace Mvc\Model\Mapper;
//echo '<pre>';
//print_r(get_declared_classes());
//echo '</pre>';

class DataMapperFactory
{
    protected $dbhProvider;
    function __construct($dbhProvider)
    {
        $this->dbhProvider = $dbhProvider;
    }
    /**
     * @param $name
     * @param $namespace
     * @return mixed
     */
    function build($name, $namespace)
    {
        $mapper = $namespace . ucwords($name) . 'DataMapper';
        return new $mapper($this->dbhProvider);
    }
}

