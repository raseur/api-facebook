<?php
// Inclusion de la bibliothèque Facebook SDK
require_once 'facebook-sdk/autoload.php';

// Création de l'objet Facebook
$fb = new Facebook\Facebook([
  'app_id' => 'ID_DAPPLICATION',
  'app_secret' => 'SECRET_DAPPLICATION',
  'default_graph_version' => 'v3.3',
]);

// Récupération du jeton d'accès
$helper = $fb->getRedirectLoginHelper();
$accessToken = $helper->getAccessToken();

// Requête de récupération des informations de l'utilisateur
$request = $fb->request(
  'GET',
  '/me',
  ['access_token' => $accessToken]
);

// Exécution de la requête et récupération du résultat
try {
  $response = $fb->getClient()->sendRequest($request);
  $user = $response->getGraphUser();
  echo "Bonjour, " . $user->getName();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
}

// Préparation de la publication
$linkData = [
  'link' => 'http://www.example.com',
  'message' => 'Voici un lien intéressant !',
];

// Requête de publication
$request = $fb->request(
  'POST',
  '/MON_ID_DE_PAGE/feed',
  $linkData,
  $accessToken
);

// Exécution de la requête et vérification du résultat
try {
  $response = $fb->getClient()->sendRequest($request);
  echo "Publication publiée avec succès !";
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
}

// Préparation du message
$messageData = [
  'recipient' => ['id' => 'MON_ID_DUTILISATEUR'],
  'message' => ['text' => 'Bonjour, comment vas-tu ?']
];

// Requête d'envoi du message
$request = $fb->request(
  'POST',
  '/me/messages',
  $messageData,
  $accessToken
);





?>
