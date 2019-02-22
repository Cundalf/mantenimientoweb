<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['protocol'] = 'smtp';

$config['smtp_host'] = 'smtp.gmail.com';	
$config['smtp_user'] = '';	
$config['smtp_pass'] = '';
$config['smtp_port'] = '587';
$config['smtp_timeout'] = 30;
$config['smtp_crypto'] = 'tls';
$config['starttls'] = TRUE;
$config['charset'] = 'UTF-8';
$config['mailtype'] = 'html';
$config['validate'] = TRUE;

$config['wordwrap'] = TRUE;
$config['newline'] = '\r\n'; 
$config['crlf'] = '\r\n'; 
