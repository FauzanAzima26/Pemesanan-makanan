<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Ciqrcode $ciqrcode
 */

class QrcodeTest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Ciqrcode');
    }

    public function show($order_id)
    {
        header("Content-Type: image/png");

        $params['data'] = base_url("customer/order/detail/" . $order_id); // atau sesuai rute yang kamu mau
        $params['level'] = 'H';
        $params['size'] = 5;
        $params['savename'] = false;

        $this->ciqrcode->generate($params);
    }
}
