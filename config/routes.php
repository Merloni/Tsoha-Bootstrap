<?php

  #CalendarRoutes
  $routes->get('/calendar/', function(){
    CalendarController::calendar();
  });

  $routes->get('/hiekkalaatikko', function() {
    CalendarController::thisMonth();
  });

#ReservationRoutes

  $routes->get('/', function() {
    CalendarController::calendar();
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
  $routes->get('/reservations/:day', function($day){
    ReservationController::showday($day);
  });
  $routes->get('/reservations/own', function(){
    ReservationController::showallown();
  });
  $routes->get('reservation/new/:day', function($day){
    ReservationController::create($day);
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

