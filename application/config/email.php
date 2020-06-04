<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['migration_enabled'] = TRUE;
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_port'] = 465;
$config['smtp_user'] = SMTP_USER;
$config['smtp_pass'] = SMTP_PASS;
$config['mailtype'] = 'html'; 
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
