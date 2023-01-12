<?php

namespace App\Controller; 

use App\Util\Router;
use App\Util\Routes;
use App\Util\SessionManager;

class BaseController
{
    protected $sub_title;
    protected $nav_states;
    protected $logged_user_id;
    protected $user_nav_rights;

    protected $action;
    protected $uri_arguments ;

    function __construct() {



        $uri_elements = \App\Util\Router::getUriElements();

        $this->action = $uri_elements[0];
        $this->uri_arguments = array_slice($uri_elements, 1);

    }

    /**
     * Affiche la vue donnée en paramètre en lui passant les paramètres $params
     *
     * @param string $view_path
     * @param array $params
     * @return void
     */
    protected function show($view_path, $params = []) {
        if (!\file_exists(APP_VIEW . $view_path)) {
            \App\Util\Router::redirectAction('404');
        }

        if (isset($params) && is_array($params)) {
            $params = (object)$params;
        } else {
            $params = (object)[];
        }

        $params->action = $this->action;
        $params->url = \App\Util\UrlPath::add_post_data_to_url('', $_GET);

        $params->sub_title = $this->sub_title ?? 'Default';
        $params->title = $params->sub_title;

        include(APP_VIEW . $view_path);
    }
}
