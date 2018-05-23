<?php

$router->get('/', [
    'as' => 'home', 'uses' => 'HomeController@showForm'
]);

$router->get('/result', [
    'as' => 'show-result', 'uses' => 'ResultController@showResult',
    'middleware' => 'validate'
]);

$router->get('/download', [
    'as' => 'download-result', 'uses' => 'ResultController@downloadResult',
    'middleware' => 'validate'
]);

