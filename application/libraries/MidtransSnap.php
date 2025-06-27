<?php
require_once APPPATH . '../vendor/autoload.php';

class MidtransSnap {
    public function __construct()
    {
        \Midtrans\Config::$serverKey = 'Mid-server-3GvsI0VRkPbHij-6qFqqFHRo';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    public function getSnapToken($params)
    {
        return \Midtrans\Snap::getSnapToken($params);
    }
}
