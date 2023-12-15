<?php  
 session_start();
require_once 'vendor/autoload.php';
print_r($_SESSION);
 
$fb = new Facebook\Facebook([
'app_id' => '6617581711685775',
'app_secret' => 'e546aa72259ddb546c9505ac21d67579',
'default_graph_version' => 'v12.0',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
    // Usa el token de acceso para obtener información del usuario
    $response = $fb->get('/me?fields=id,name,email', $accessToken);
    $user = $response->getGraphUser();
    $fbemail = $user->getProperty('email'); 
    print_r($user);
    // Aquí puedes manejar la información del usuario como desees
    echo 'ID: ' . $user->getId();
    echo 'Name: ' . $user->getName();
    echo 'Email: ' . $user->getEmail()."".$fbemail;
} catch (\Facebook\Exceptions\FacebookResponseException $e) {
    // Maneja errores de respuesta de Facebook
    echo 'Graph returned an error: ' . $e->getMessage();
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
    // Maneja errores del SDK de Facebook
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
}



?>