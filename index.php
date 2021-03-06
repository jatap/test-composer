<?php

require 'vendor/autoload.php';

// -----------------------------------------------------------------------------

ini_set('display_errors', true);
error_reporting(-1);

// -----------------------------------------------------------------------------

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Symfony\Component\Finder\Finder;
use User\Base as BaseUser;

// -----------------------------------------------------------------------------

/**
 * Testing Monolog
 */

// create a log channel
$log = new Logger('name');
$log->pushHandler(new StreamHandler('data/log/app.log', Logger::WARNING));

// add records to the log
$log->addWarning('Foo');
$log->addError('Bar');

// -----------------------------------------------------------------------------

/**
 * Testing Finder
 */

$finder = new Finder();

$iterator = $finder
  ->directories()
  ->in('/Users/julioantuneztarin/Sites')
  ->depth(0)
  ->exclude('HTMLPurifier')
  ->size('>= 1K');

echo "<pre>";
foreach ($iterator as $file) {
    print $file->getRealpath()."\n";
}
echo "</pre>";

/**
 * Testing new module
 */
$newModule = new BaseUser('Julio');
echo $newModule->getName();


// -----------------------------------------------------------------------------

