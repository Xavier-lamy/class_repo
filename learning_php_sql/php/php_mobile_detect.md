# Mobile detect

Pour réaliser un affichage différent en fonction de si on est sur mobile ou desktop on peut utiliser:

## Mobile_Detect
- Un fichier php qu'on peut télécharger sur le [github du projet](https://github.com/serbanghita/Mobile-Detect) (ou copier coller),
- on l'inclut dans nos fonctions (``require_once "libs/mobile_detect.php"``), note il est mieux de mettre le nom du fichier entièrement en minuscule, même si dans la doc il a des majuscules, car sinon ça peut poser problème sur certaines configs 
- on peut alors faire des conditions pour vérifier sur quelle type d'appareils on se trouve:
```php
// Include and instantiate the class.
$detect = new Mobile_Detect;
 
// Any mobile device (phones or tablets).
if ( $detect->isMobile() ) {
 
}
 
// Any tablet device.
if( $detect->isTablet() ){
 
}
 
// Exclude tablets.
if( $detect->isMobile() && !$detect->isTablet() ){
 
}
 
// Check for a specific platform with the help of the magic methods:
if( $detect->isiOS() ){
 
}
 
if( $detect->isAndroidOS() ){
 
}
 
// Alternative method is() for checking specific properties.
// WARNING: this method is in BETA, some keyword properties will change in the future.
$detect->is('Chrome')
$detect->is('iOS')
$detect->is('UC Browser')
// [...]
 
// Batch mode using setUserAgent():
$userAgents = array(
'Mozilla/5.0 (Linux; Android 4.0.4; Desire HD Build/IMM76D) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166 Mobile Safari/535.19',
'BlackBerry7100i/4.1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 VendorID/103',
// [...]
);
foreach($userAgents as $userAgent){
 
  $detect->setUserAgent($userAgent);
  $isMobile = $detect->isMobile();
  $isTablet = $detect->isTablet();
  // Use the force however you want.
 
}
 
// Get the version() of components.
// WARNING: this method is in BETA, some keyword properties will change in the future.
$detect->version('iPad'); // 4.3 (float)
$detect->version('iPhone') // 3.1 (float)
$detect->version('Android'); // 2.1 (float)
$detect->version('Opera Mini'); // 5.0 (float)
// [...]
```