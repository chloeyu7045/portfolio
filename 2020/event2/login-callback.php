<?php
session_start(); // 啟用 session
$base_url = "http".((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "s" : "")."://".$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
# login-callback.php
require_once __DIR__ . '/Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '470511889817568',
  'app_secret' => '57099c6a5469897297102758aa6f3288',
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
	// Logged in!
	$_SESSION['facebook_access_token'] = (string) $accessToken;
	// Logged in!
	header("Location: ".$base_url."share.php?id=".$_SESSION['share_id']);
	//echo '<script>location.href="'.$base_url.'share.php?id='.$_SESSION["share_id"].'";</script>';
	exit;
}else{
	header("Location: ".$base_url."game.php");
	exit;
}
?>