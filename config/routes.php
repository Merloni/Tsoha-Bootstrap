<?php

  $routes->get('/', function() {
    ReservationController::index();
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
  $routes->get('/reservation/:id', function($id){
    ReservationController::show($id);
  });
  $routes->post('/reservation', function(){
    ReservationController::store();
  });
  $routes->get('/reservation/new', function(){
    ReservationController::create();
  });