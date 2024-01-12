<?php

require 'vendor/autoload.php';

use nguyenanhung\MyFixNuSOAP\nusoap_client;

$client = new nusoap_client("http://localhost/wssoa/server.php?wsdl");

$client->soap_defencoding = 'utf-8';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<header>
  <nav class="navbar">
    <div class="container-fluid">
      <span class="navbar-brand align-items-center fw-bold"> Meregister dan Mempublish NuSOAP</span>
    </div>
  </nav>
</header>

<body>

  <div class="container">
    <div class="row">
      <div class="mb-3">

        <form action="" method="post">
          <label for="input" class="form-label">Barang</label>
          <input type="text" class="form-control" id="input" placeholder="">
          <button type="submit" class="btn btn-primary mt-3">Get Stock</button>

        </form>

        <?php
        if (isset($_POST['submit'])) {
          $username = $_POST['symbolstock'];
          $response = $client->call('getStock', array("symbolstock" => $username));
          echo $response ?: "Barang Tidak Ditemukan, Silahkan ganti Barang !!";
        }
        ?>

      </div>
    </div>
  </div>

</body>

</html>