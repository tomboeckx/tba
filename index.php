<?php
function parse_path() {
  $path = array();
  if (isset($_SERVER['REQUEST_URI'])) {
    $request_path = explode('?', $_SERVER['REQUEST_URI']);
    $path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
    $path['call_utf8'] = substr(urldecode($request_path[0]), strlen($path['base']) + 1);
    $path['call'] = utf8_decode($path['call_utf8']);
    if ($path['call'] == basename($_SERVER['PHP_SELF'])) {
      $path['call'] = '';
    }
	$call = rtrim($path['call'],"/");
    if(strlen($call)>0) {
		$path['call_parts'] = explode('/', $call);
	}
    $path['query_utf8'] = urldecode($request_path[1]);
    $path['query'] = utf8_decode(urldecode($request_path[1]));
    $vars = explode('&', $path['query']);
    foreach ($vars as $var) {
      $t = explode('=', $var);
      $path['query_vars'][$t[0]] = $t[1];
    }
  }
return $path;
}

$path_info = parse_path();

$numparams = count($path_info['call_parts']);
//print_r( $path_info);

switch($numparams) {
	case 1:switch($path_info['call_parts'][0]) {
			case 'home' : include 'home.php';
				break;
			case 'info' : include 'info.php';
				break;
			case 'voorwaarden' : include 'conditions.php';
				break;
			case 'contact' : include 'contact.php';
				break;
			case 'sitemap' : include 'sitemap.php';
				break;
			default:
				include 'products.php';
		}
		break;
	case 0: include 'home.php';
		break;
	case 2: include 'product.php';
		break;
	default:
		include 'home.php';
}

?>