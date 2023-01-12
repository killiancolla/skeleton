<?php

namespace App\Controller;

class DashboardController extends BaseController
{
    public function __construct() {
        parent::__construct();
        $this->sub_title = 'Dashboard';
    }

    public function dashboard() {
        $params = [];
        $this->show('dashboard/dashboard.php', $params);
    }
}
