<?php 
 
  require_once 'vendor/autoload.php';
   
     

  $clientID = '402042152092-569dap3jp571c2qiauvfpnf7ki0ik3bh.apps.googleusercontent.com';
  $clientSecret = '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';
  $redirectUri = 'http://localhost/login.php';
   
  $client = new Google_Client();
  $client->setClientId($clientID);
  $client->setClientSecret($clientSecret);
  $client->setRedirectUri($redirectUri);
  $client->addScope("email");
  $client->addScope("profile");

  if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
  
    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();

    
    $email =  $google_account_info->email;
    $name =  $google_account_info->name;
  
    // Estos datos son los que obtenemos....	
    echo $email .'<br>';
    echo $name ;
    
  }  


  /*Data response
  
  Google\Service\Oauth2\Userinfo Object
(
    [internal_gapi_mappings:protected] => Array
        (
            [familyName] => family_name
            [givenName] => given_name
            [verifiedEmail] => verified_email
        )

    [email] => frank1994mp@gmail.com
    [familyName] => Montilla Pérez
    [gender] => 
    [givenName] => Frank
    [hd] => 
    [id] => 107702030491093488183
    [link] => 
    [locale] => es
    [name] => Frank Montilla Pérez
    [picture] => https://lh3.googleusercontent.com/a/ACg8ocJt1vtGkkMAmVjMEcGcWcbxugYKwvQKYS3s_j7EWB9sCIbt=s96-c
    [verifiedEmail] => 1
    [modelData:protected] => Array
        (
            [verified_email] => 1
            [given_name] => Frank
            [family_name] => Montilla Pérez
        )

    [processed:protected] => Array
        (
        )

)
  
  
  
  */



?>