<?php

namespace App\Controller;

class DashboardController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }

    public function dashboard() {
        $params = [];
        $this->show('dashboard/dashboard.php', $params);
    }
}
