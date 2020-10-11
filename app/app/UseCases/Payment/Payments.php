<?php


namespace App\UseCases\Payment;


class Payments
{
     const ROBOKASSA='robokassa';

     public static $paymentClass= [
         self::ROBOKASSA=>Robokassa::class
     ];
}
