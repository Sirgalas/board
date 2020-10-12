<?php


namespace App\UseCases\Payment;


class Payments
{
     const ROBOKASSA='robokassa';
     const LOCAL='local';

     public static $paymentClass= [
         self::ROBOKASSA=>Robokassa::class,
         self::LOCAL=>Local::class
     ];
}
