<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css"/>
    <title><?php echo $page_title . ' | ' . $site_name; ?></title>
</head>
<body>
<div id="wrap">
    <header>
        <h1><?php echo anchor('', $site_name); ?></h1>
    </header>
    <section>
<?php
if ($this->session->flashdata('success')) {
    echo '<p class="success">' . $this->session->flashdata('success') . '</p>';
}
if ($this->session->flashdata('error')) {
    echo '<p class="error">' . $this->session->flashdata('error') . '</p>';
}