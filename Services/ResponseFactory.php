<?php

namespace Pulpmedia\NgHttpBundle\Services;

use JMS\Serializer\Serializer;

use Pulpmedia\NgHttpBundle\HttpFoundation\BaseResponse;
use Pulpmedia\NgHttpBundle\HttpFoundation\ErrorResponse;
use Pulpmedia\NgHttpBundle\HttpFoundation\SuccessResponse;

class ResponseFactory{

    private $serializer;

    public function __construct(Serializer $serializer){
        $this->serializer = $serializer;
    }

    public function getResponse(){
        $response = new BaseResponse($this->serializer);
        return $response;
    }

    public function getSuccessResponse(){
        $response = new SuccessResponse($this->serializer);
        return $response;
    }

    public function getErrorResponse(){
        $response = new ErrorResponse($this->serializer);
        return $response;

    }
}
