<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/login', function(){
  	HelloWorldController::login();
  });
  $routes->get('/calendar', function(){
  	HelloWorldController::calendar();
  });
  $routes->get('/reservation', function(){
  	HelloWorldController::reservation();
  });
  $routes->get('/edit_reservation', function(){
  	HelloWorldController::editReservation();
  });