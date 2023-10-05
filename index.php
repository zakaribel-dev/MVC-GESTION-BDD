<?php
 function getUrlWithoutFilename() {
    $url = $_SERVER["SCRIPT_NAME"];
    $zones = explode("/", $url);
    $resultat = "";
    for ($i=1; $i < count($zones)-1  ; $i++) { 
        $resultat .= "/". $zones[$i];
    }
    return $resultat;
 }

// On génère une constante contenant le chemin vers la racine publique du projet
define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));
define('PATH', getUrlWithoutFilename());

// On appelle le modèle et le contrôleur principaux
require_once(ROOT.'app/Model.php');
require_once(ROOT.'app/Controller.php');


    // On sépare les paramètres et on les met dans le tableau $params

    // Si au moins 1 paramètre existe
   try {
    $params = explode('/', @$_GET['p']);

    if($params[0] != ""){
        // On sauvegarde le 1er paramètre dans $controller en mettant sa 1ère lettre en majuscule
        $controller = ucfirst($params[0]);

        // On sauvegarde le 2ème paramètre dans $action si il existe, sinon index
        $action = isset($params[1]) ? $params[1] : 'index';

        // On appelle le contrôleur
        @require_once(ROOT.'controllers/'.$controller.'.php');

        $controller = new $controller();

        if(method_exists($controller, $action)){
            unset($params[0]);
            unset($params[1]);
            call_user_func_array([$controller,$action], $params);
        }
    }else{
        require_once('controllers/Home.php'); 
        $home = new Home();
        $home->index();
    }
} catch (Exception $e) {

    require_once(ROOT . 'controllers/Erreur.php');

    $controller = new Erreur($e);

    $controller->index();
} catch (Error $err) {

    require_once(ROOT . 'controllers/Erreur.php');

    $controller = new Erreur(new Exception($err->getMessage()));

    $controller->index();
}