<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|
| https://www.mercadopago.com.ar/developers/es/solutions/payments/basic-checkout/receive-payments/
|
*/

// Custom Checkout
$config['app_id'] = ''; // not used by the Library
$config['public_key'] = '';  // not used by the Library
$config['access_token'] = '';
$config['use_access_token'] = FALSE; // TRUE or FALSE

// Basic Checkout
$config['client_id'] = '57058460190181';
$config['client_secret'] = 'mxvDsx8BNBJceo0F39U6StA3RY5wnuOG';

// Sandbox
$config['sandbox_mode'] = TRUE; // TRUE or FALSE

/* End of file mercadopago.php */
/* Location: ./application/config/mercadopago.php */
