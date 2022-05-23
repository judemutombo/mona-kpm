<?php

namespace App\Controller;

use App;
use App\DbAuth\DbAuth;

class MainController{

    public function render($page, $template)
    {
        ob_start();
        require ROOT.'/App/views/pages/'.$page.'.php';
        $content = ob_get_clean();
        require ROOT.'/App/views/templates/'.$template.'.php';
    }
}
