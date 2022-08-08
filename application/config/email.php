<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| E-mail constants
|--------------------------------------------------------------------------
*/
defined('EMAIL_FROM')              OR define('EMAIL_FROM',              'notificaciones@emtech.digital');
defined('EMAIL_FROM_NAME')         OR define('EMAIL_FROM_NAME',         'Portal Gob. Puebla');
defined('EMAIL_TO')                OR define('EMAIL_TO',                'xxxx@xxx.xx');
defined('EMAIL_SUBJECT')           OR define('EMAIL_SUBJECT',           'Codigo de recuperación');
defined('EMAIL_ENABLED')           OR define('EMAIL_ENABLED',            TRUE);

/*
|--------------------------------------------------------------------------
| E-mail configuration
|--------------------------------------------------------------------------
*/
$config['crlf']         = "\r\n";
$config['newline']      = "\r\n";
$config['charset']      = 'utf-8';
$config['protocol']     = 'smtp';
$config['mailtype']     = 'html';
$config['smtp_host']    = 'emtech.digital';
$config['smtp_user']    = EMAIL_FROM;
$config['smtp_pass']    = 'gobiernoSinaloa';
$config['smtp_port']    = 587;
$config['smtp_crypto']  = '';
$config['smtp_timeout'] = 10;
