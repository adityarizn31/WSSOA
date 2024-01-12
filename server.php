<?php

require 'vendor/autoload.php';

use nguyenanhung\MyFixNuSOAP\nusoap_server;

function user($username)
{
  $userData = "Nama :$username";
  return $userData;
}

function getStock($shopStock)
{
  $stocks = [
    "Gas Spontan" => 200.000,
    "Oil" => 150.000,
    "Shock Breaker" => 1.800000,
    "Handle" => 330.000
  ];

  foreach ($stocks as $stock => $count) {
    if ($stock == $shopStock) {
      return $count;
      break;
    }
  }

  $err = $stock->getError();
  if ($err) {
    return "Barang Tidak Ditemukan !! Silahkan Ganti Barang " . $err;
  } else {
    return "Barang Ditemukan " + $stocks;
  }
}

$server = new nusoap_server();

$server->configureWSDL('my_wsdl', 'urn:my_wsdl');

$server->register(
  'user',
  array('username' => 'xsd:string'),
  array('username' => 'xsd:string'),
);

$server->register(
  'getStock',
  array('shopStock' => 'xsd:string'),
  array('return' => 'xsd:integer'),
  false,
  'rpc',
  'encoded',
  'Dapatkan Stock dari Simbol Stock'
);


$server->soap_defencoding = 'utf-8';

// Mulai server NuSOAP
$server->service(file_get_contents('php://input'));
