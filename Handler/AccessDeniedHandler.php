<?php


namespace Pulpmedia\NgHttpBundle\Handler;

use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Pulpmedia\NgHttpBundle\Component\HttpFoundation\ErrorResponse;
use Pulpmedia\NgHttpBundle\Services\ResponseFactory;


class AccessDeniedHandler implements AccessDeniedHandlerInterface {

    private $rf;
    
    public function __construct(ResponseFactory $rf){
        $this->rf = $rf;
    }

    public function handle(Request $request, AccessDeniedException $accessDeniedException) {
    
        $response = $this->rf->getErrorResponse();
        $response->setErrors(array('message' => $accessDeniedException->getMessage()));
        return $response;
    }
}
