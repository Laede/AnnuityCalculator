<?php

$router->get('/', [
    'as' => 'home', 'uses' => 'HomeController@showForm'
]);

$router->get('/result', [
    'as' => 'show-result', 'uses' => 'ResultController@showResult'
]);