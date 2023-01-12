<?php

namespace App\Controller;


/**
 * Controller pour la page de tableau de bord
 */
class ErrorPagesController extends BaseController
{
    public function __construct() {
        parent::__construct();
        $this->sub_title = 'Erreur';
        $this->nav_states = [];
    }

    private function getErrorPageView() {
        return 'error_pages/error_pages.php';
    }

    /**
     * Affiche la page d'erreur 404
     *
     * @return void
     */
    public function _404($error_message = null) {
        $params = [
            'error_number' => 404,
            'error_message' => $error_message ?? 'La page demandée n\'existe pas...'
        ];

        $this->show($this->getErrorPageView(), $params);
    }

    /**
     * Affiche la page d'erreur 404
     *
     * @return void
     */
    public function _403() {
        $params = [
            'error_number' => 403,
            'error_message' => 'Accès interdit.'
        ];

        $this->show($this->getErrorPageView(), $params);
    }
}
