<?php

namespace App\Controller;

class TestController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }

    public function test() {
        $params = [];
        $this->show('test/test.php', $params);
    }
}
