<?php

  #CalendarRoutes
  $routes->get('/calendar/', function(){
    CalendarController::calendar();
  });

  $routes->get('/hiekkalaatikko', function() {
    CalendarController::thisMonth();
  });

  $routes->get('/naytakaikki', function(){
    ReservationController::index();
  });

#ReservationRoutes

  $routes->get('/', function() {
    ReservationController::frontpage();
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
  $routes->get('/reservation/new/:day', function($day){
    ReservationController::create($day);
  });
  $routes->get('/reservations/:day', function($day){
    ReservationController::showday($day);
  });
  $routes->get('/ownreservations', function(){
    ReservationController::showallown();
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
  $routes->get('/register', function(){
    ApartmentController::create();
  });
  $routes->post('/register', function(){
    ApartmentController::store();
  });

  #SaunaRoutes

  $routes->get('/saunas', function(){
    SaunaController::index();
  });
  $routes->get('/sauna/new', function(){
    SaunaController::create();
  });
  $routes->get('/sauna/:id', function($id){
    SaunaController::show($id);
  });
  $routes->post('/sauna', function(){
    SaunaController::store();
  });
  $routes->get('/sauna/:id/edit', function($id){
    SaunaController::edit($id);
  });
  $routes->post('/sauna/:id/edit', function($id){
    SaunaController::update($id);
  });
  $routes->post('/sauna/:id/destroy', function($id){
    SaunaController::destroy($id);
  });
