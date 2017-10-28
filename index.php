<?php

error_reporting(E_ALL);



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
$loader->addNamespace('Trzczy\Frameworks\Tpl', __DIR__ . '/view/tplFramework/helpers');
$loader->addNamespace('Trzczy\Frameworks\Tpl', __DIR__ . '/view/pygments');
$loader->addNamespace('Trzczy\Login\View', __DIR__ . '/view/templates/engines');
$loader->addNamespace('Trzczy\Login\View', __DIR__ . '/view/templates/engines/helpers');
$loader->addNamespace('Trzczy\Login\View', __DIR__ . '/view');
$loader->addNamespace('Trzczy\Login\Controller', __DIR__ . '/controller');
$loader->addNamespace('Mvc\Model\Mapper', __DIR__ . '/model/dataMapperFactory');
$loader->addNamespace('Mvc\Model\Domain', __DIR__ . '/model/domainObjectFactory');
$loader->addNamespace('Mvc\Model\Domain', __DIR__ . '/model/domainObjectFactory/helpers');
$loader->addNamespace('Mvc\Model', __DIR__ . '/model');

date_default_timezone_set('Europe/Warsaw');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);
//error_reporting(E_ALL);
mb_internal_encoding("UTF-8");
$view = new View();
$dbhProvider = function () {
    return PdoObjectSingletonFactory::getInstance();
};

$serviceFactory = new Mvc\Model\ServiceFactory(
    new DataMapperFactory($dbhProvider),
    new DomainObjectFactory()
);

$class = (isset($_GET['ctrl']))
    ?
    ucwords($_GET['ctrl'])
    :
    'Index';
$classPrefix = 'Trzczy\\Login\\Controller\\';
switch ($class) {
    case 'Contact':
    case 'Index':
    case 'Blog':
    case 'Apps':
        $class = $classPrefix . $class . 'Controller';
        new $class($view, isset($_GET['debug']), $serviceFactory);
        break;
    case 'Article':
    case 'App':
        if (isset($_GET['id']) AND !empty($_GET['id'])) {
            $class = $classPrefix . $class . 'Controller';
            new $class($view, isset($_GET['debug']), $serviceFactory, $_GET['id']);
        } else {
            die('The "id" query string or its value is missing.');
        }
        break;
    case 'Excerpts':
        if (isset($_GET['tag']) AND !empty($_GET['tag'])) {
            $class = $classPrefix . $class . 'Controller';
            new $class($view, isset($_GET['debug']), $serviceFactory, $_GET['tag']);
        } else {
            die('The "tag" query string or its value is missing.');
        }
        break;
}