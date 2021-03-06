<?php
    if (!isset($_SESSION))
        session_start();
    
    include_once('userclass.php');
    include_once('pasm.php');
    include_once('routes.php');
    include_once('crud.php');
    
    $route = new Routes();
 
    
    if (!isset($route->QURY['req']))
    {
        @$route->route();
    }
    else if (isset($route->QURY['req']) && strtolower($route->QURY['req']) == strtolower('add'))
    {
        @$route->addContract();
        @$route->route();
    }
    else if (isset($route->QURY['req']) && strtolower($route->QURY['req']) == strtolower('remove'))
    {
        @$route->remContract();
        @$route->route();
    }
    else if (isset($route->QURY['req']) && strtolower($route->QURY['req']) == strtolower('adduser'))
    {
        @$route->addUserToContract();
        @$route->route();
    }
    else if (isset($route->QURY['req']) && strtolower($route->QURY['req']) == strtolower('remuser'))
    {
        @$route->remUserFromContract();
        @$route->route();
    }
    
    $route->pasm->load_str("routing.ini");
    $route->save("routing.ini");

?>
