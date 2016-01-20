<?php

namespace Pulpmedia\NgHttpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Pulpmedia\NgHttpBundle\HttpFoundation\ErrorResponse;
use Pulpmedia\NgHttpBundle\HttpFoundation\SuccessResponse;

class Controller extends Controller
{
    public function success($data, $headers = array(), $status = 200){
        $response = $this->get('pulpmedia_ng_http.response.factory')->getSuccessResponse();
        $response->setContent($data);
        $response->setStatusCode($status);

        return $response;

    }
    public function error($errorCode, $errors = array(), $data = null, $status = 404){

        $response = $this->get('pulpmedia_ng_http.response.factory')->getErrorResponse();
        $response->setErrorCode($errorCode);
        $response->setErrors($errors);
        $response->setStatusCode($status);

        return $response;
    }

}
