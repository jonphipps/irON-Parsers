<?php
// Here you can initialize variables that will for your tests
  require_once 'PHPUnit/Framework/Assert/Functions.php';

  //require_once //__DIR__ . '/../../config.xml';
  require_once __DIR__ . "/../../commON/CommonParser.php";

  require_once __DIR__ . '/../../EasyCSV/lib/EasyCSV/ClassLoader.php';
  $classLoader = new \EasyCSV\ClassLoader('EasyCSV', __DIR__ . '/../../EasyCSV/lib');
  $classLoader->register();