<?php

namespace App\Controllers\Candidates;

use App\Controllers\Controller;

class CandidatesController extends Controller
{
    public function getCandidates($request, $response){
        return $this->view->render($response, 'candidates/candidates.twig');
    }
}