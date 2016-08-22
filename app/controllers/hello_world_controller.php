<?php


  require 'app/models/reservation.php';
  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make ('login.html');
    }

    public static function sandbox(){
      
      $asd = new Reservation(array(
        'apartment_id' => '1',
        'sauna_id' => '2',
        'reserved' => false,
        'reservestart' => '14:00',
        'reserve_end' => '13:00'
        ));

      $errors = $asd->errors();

      Kint::dump($errors);

      $asd = new Reservation(array(
        'apartment_id' => '1',
        'sauna_id' => '2',
        'reserved' => false,
        'reservestart' => '',
        'reserve_end' => ''
        ));

      $errors = $asd->errors();

      Kint::dump($errors);

    }

    public static function reservation(){

      View::make('suunnitelmat/reservation.html');
    }

    public static function editReservation(){

      View::make('suunnitelmat/edit_reservation.html');
    }

    public static function login(){

      View::make('login.html');
    }

    public static function calendar(){

      View::make('suunnitelmat/calendar.html');
    }
  }
