<?

require_once(dirname(__FILE__) . '/../../../config.php');
//require_once('renderer.php');

require_login(0, false);

global $OUTPUT;
$stagoreclip = required_param('stagoreclip', PARAM_TEXT);

if($stagoreclip == 1){
$easyonewmanbuildstring=file_get_contents('edit_newman_eclip.html').file_get_contents('newman_dragable.html');
	}
	else{
$easyonewmanbuildstring=file_get_contents('edit_newman.html').file_get_contents('newman_dragable.html');
	}
echo $easyonewmanbuildstring;

?>
