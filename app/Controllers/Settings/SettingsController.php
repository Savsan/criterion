<?php

namespace App\Controllers\Settings;

use App\Controllers\Controller;

class SettingsController extends Controller
{
    public function getSettings($request, $response){
        return $this->view->render($response, 'settings/mainsettings.twig');
    }
}