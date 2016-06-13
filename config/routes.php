<?php

  $routes->get('/', function() {
    ReservationController::index();
  });
  $routes->get('/reservation', function(){
    ReservationController::index();
  });
  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  $routes->get('/reservation/new', function(){
    ReservationController::create();
  });
  $routes->get('/reservation/:id', function($id){
    ReservationController::show($id);
  });
  $routes->post('/reservation', function(){
    ReservationController::store();
  });
  $routes->get('reservation/:id/edit', function($id){
    ReservationController::edit($id);
  });
  $routes->post('reservation/:id/edit', function($id){
    ReservationController::update($id);
  });
  $routes->post('reservation/:id/destroy', function($id){
    ReservationController::destroy($id);
  });