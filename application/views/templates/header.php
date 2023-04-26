<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo getTopTitle()." - ".$title ?></title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo getAssets() ?>css/bootstrap.css" rel="stylesheet">

  <!-- Add custom CSS here -->
  <link href="<?php echo getAssets() ?>css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo getAssets() ?>font-awesome/css/font-awesome.min.css">

  <style>
    .fixed-footer {
      position: fixed;
      left: 0;
      right: 50px;
      bottom: 0;
      width: 98%;
      height: 20px;
      background-color: #ffffff;
      color: white;
      text-align: right;
    }
  </style>

</head>