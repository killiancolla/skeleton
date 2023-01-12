<?php

namespace App\Util;

use App\Controller\DashboardController;
use App\Controller\ErrorPagesController;
use App\Controller\TestController; 

/**
 * Routeur
 */
class Router {
    /**
     * Vérifie si un utilisateur est authentifié en utilisant les données en
     * session.
     *
     * @return void
     */
    // public static function authenticate() {
    //     $action = Router::getActions()[0] ?? null;
    //     if (!SessionManager::isUserLogged()) {
    //         if (isset($action) &&
    //         !in_array($action, [Routes::LOGIN, Routes::RESET_PWD, Routes::PATIENT_LOGIN])) {
    //             // Si pas identifié et soit
    //             // - pas d'action
    //             // - pas sur login ou reset_pwd
    //             Router::redirectAction(Routes::LOGIN);
    //         }
    //     } elseif (SessionManager::getLoginPwdIsExpired() === true &&
    //     !in_array($action, [Routes::EXPIRED_PWD, Routes::DECONNECTION])) {
    //         // Mot de passe expiré
    //         Router::redirectAction(Routes::EXPIRED_PWD);
    //     } else {
    //         if (isset($action) &&
    //         in_array($action, [Routes::LOGIN, Routes::PATIENT_LOGIN])) {
    //             Router::redirectHome();
    //         }
    //     }
    // }

    /**
     * Route l'affichage des différentes pages en fonction de l'action de l'URL
     *
     * @return void
     */
    public static function route() {
        if (!Router::hasActions()) {
            Router::redirectHome();
        }

        $action = Router::getActions()[0];

        if (Routes::exists($action)) {
            if ($action === Routes::TEST) {
                (new TestController())->test();
             } elseif($action === Routes::DASHBOARD) {
                (new DashboardController())->dashboard(); 
             }
             else {
                // Page non implémenté
                (new ErrorPagesController())->_403();
            }
        } else {
            (new ErrorPagesController())->_404();
        }
    }

    /**
     * Découpe $_SERVER['REQUEST_URI'] et retourne les élements composant l'URI.
     *
     * @return array
     */
    public static function getUriElements() : array {
        $path = ltrim($_SERVER['REQUEST_URI'], '/');

        return array_filter(explode('/', $path),
            function($value) {
                return $value !== null && $value !== "";
            }
        );
    }

    /**
     * Retourne si l'URI contient une action
     *
     * @return bool
     */
    public static function hasActions() : bool{
        return Router::getActions() !== [];
    }

    /**
     * Retourne l'action de l'URI
     *
     * @return array
     */
    public static function getActions() : array{
        return Router::getUriElements() ?? null;
    }

    /**
     * Modifie l'action de routage par $action
     *
     * @param string $action
     * @return void
     */
    public static function setAction(string $action) {
        $_GET['action'] = $action;
    }

    /**
     * Redirige vers l'URI construite a partir de $uri_element
     *
     * @param array $uri_element
     * @return void
     */
    public static function redirect($uri_element = []) {
        if (!empty($_POST)) {
            $_SESSION['DEBUG']['LAST_POST'] = $_POST;
        }

        if (!empty($_GET)) {
            $_SESSION['DEBUG']['LAST_GET'] = $_GET;
        }

        header('Location: /' . UrlPath::build_url(\array_values($uri_element)));
        die();
    }

    /**
     * Redirige vers la page actuelle.
     *
     * @param mixed $get_data
     * @return void
     */
    public static function reload() {
        Router::redirect(Router::getActions());
    }

    /**
     * Redirige vers la page de l'action de routage $action.
     *
     * @param string $action
     * @return void
     */
    public static function redirectAction(string $action) {
        Router::redirect(['action' => $action]);
    }

    /**
     * Redirige vers l'action par défaut
     *
     * @return void
     */
    public static function redirectHome() {
        Router::redirect([Routes::default()]);
    }
}
