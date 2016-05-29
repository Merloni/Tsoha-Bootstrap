<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make ('login.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
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
