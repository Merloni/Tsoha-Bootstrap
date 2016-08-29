<?php

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

#ReservationRoutes

  $routes->get('/', function() {
    ReservationController::index();
  });
  $routes->get('/reservation', function() {
    ReservationController::index();
  });
  $routes->get('/reservations', function(){
    ReservationController::index();
  });
  $routes->post('/reservation', function(){
    ReservationController::store();
  });
  $routes->get('/reservation/new', function(){
    ReservationController::create();
  });
  $routes->get('/reservation/:id', function($id){
    ReservationController::show($id);
  });
  $routes->get('/reservation/:id/edit', function($id){
    ReservationController::edit($id);
  });
  $routes->post('/reservation/:id/edit', function($id){
    ReservationController::update($id);
  });
  $routes->post('/reservation/:id/destroy', function($id){
    ReservationController::destroy($id);
  });


  #ApartmentRoutes

  $routes->get('/login', function(){
    ApartmentController::login();
  });
  $routes->post('/login', function(){
    ApartmentController::handle_login();
  });

  $routes->get('/apartments', function(){
    ApartmentController::index();
  });
  $routes->get('/logout', function(){
    ApartmentController::logout();
  });