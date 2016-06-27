<?php

use Mvc\Model\Mapper\DataMapperFactory;
use Mvc\Model\Domain\DomainObjectFactory;
use Mvc\Model\Mapper\PdoObjectSingletonFactory;
use Mvc\Model\ServiceFactory;
use Trzczy\Login\View\View;

require_once __DIR__ . '/model/Autoload.php';


$loader = new Autoload();
$loader->register();
$loader->addNamespace('Trzczy\Frameworks\Tpl', __DIR__ . '/view/tplFramework');
$loader->addNamespace('Trzczy\Frameworks\Tpl', __DIR__ . '/view/tplFramework/engines');
$loader->addNamespace('Trzczy\Frameworks\Tpl', __DIR__ . '/view/pygments');
$loader->addNamespace('Trzczy\Login\View', __DIR__ . '/view/templates/engines');
$loader->addNamespace('Trzczy\Login\View', __DIR__ . '/view');
$loader->addNamespace('Trzczy\Login\Controller', __DIR__ . '/controller');
$loader->addNamespace('Mvc\Model\Mapper', __DIR__ . '/model/dataMapperFactory');
$loader->addNamespace('Mvc\Model\Domain', __DIR__ . '/model/domainObjectFactory');
$loader->addNamespace('Mvc\Model', __DIR__ . '/model');
date_default_timezone_set('Europe/Warsaw');

$test = 12;

$view = new View();
$dbhProvider = function () {
    return PdoObjectSingletonFactory::getInstance();
};

$serviceFactory = new Mvc\Model\ServiceFactory(
    new DataMapperFactory($dbhProvider),
    new DomainObjectFactory()
);

$class = (isset($_GET['ctrlr']))
    ?
    ucwords($_GET['ctrlr'])
    :
    'Index';

$class = 'Trzczy\\Login\\Controller\\' . $class . 'Controller';


if (isset($_GET['id']) AND !empty($_GET['id'])) {
    new $class($view, isset($_GET['debug']), $serviceFactory, $_GET['id']);
} else if (isset($_GET['tag']) AND !empty($_GET['tag'])) {
    $tag = $_GET['tag'];
    new $class($view, isset($_GET['debug']), $serviceFactory, $_GET['tag']);
}else{
    new $class($view, isset($_GET['debug']), $serviceFactory);
}
