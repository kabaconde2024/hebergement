<?php
session_start(); // Démarrez la session s'il ne l'est pas déjà

// Unset all of the session variables
$_SESSION = array();

// Si vous souhaitez effacer complètement la session, effacez également le cookie de session.
// Note : cela détruira la session et pas seulement les données de session !
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Détruisez la session
session_destroy();

// Redirigez l'utilisateur vers la page d'accueil ou une autre page après la déconnexion
header("Location: /view/Accueil.php");
exit();
?>