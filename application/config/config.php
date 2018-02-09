<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//$config['base_url'] = 'http://'.$_SERVER['HTTP_HOST'].'/eagleboys/';

$config['time_zone']='Asia/Kolkata';

$config['encryption_key'] = 'BITPOSWOWMYSOREPOINTOFSALEAPPLICATION';

$config['sess_cookie_name']		= 'ci_session';
$config['sess_expiration']		= 360000;//1 hour=60*60*100
$config['sess_expire_on_close']	= TRUE;
$config['sess_encrypt_cookie']	= FALSE;
$config['sess_use_database']	= TRUE;
$config['sess_table_name']		= 'ci_sessions';
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update']	= 360000;

$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';

// Don't Edit bellow this..............

$config['gcm_api_key'] = 'AIzaSyB1bLT3q0uBB94LuwKNHC0CZq8kKzSuJGY';
$config['gcm_api_send_address'] = 'https://android.googleapis.com/gcm/send';

$config['base_url'] = '';

$config['index_page'] = '';

$config['uri_protocol']	= 'AUTO';


$config['url_suffix'] = '';

$config['language']	= 'english';


$config['charset'] = 'UTF-8';

$config['enable_hooks'] = FALSE;

$config['subclass_prefix'] = 'MY_';


$config['allow_get_array']		= TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']	= 'c';
$config['function_trigger']		= 'm';
$config['directory_trigger']	= 'd'; // experimental not currently in use

$config['log_threshold'] = 0;

$config['log_path'] = '';


$config['log_date_format'] = 'Y-m-d H:i:s';

$config['cache_path'] = '';
$config['cookie_prefix']	= "";
$config['cookie_domain']	= "";
$config['cookie_path']		= "/";
$config['cookie_secure']	= FALSE;


$config['global_xss_filtering'] = FALSE;


$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;


$config['compress_output'] = FALSE;

$config['time_reference'] = 'local';

$config['rewrite_short_tags'] = FALSE;

$config['proxy_ips'] = '';


/* End of file config.php */
/* Location: ./application/config/config.php */
