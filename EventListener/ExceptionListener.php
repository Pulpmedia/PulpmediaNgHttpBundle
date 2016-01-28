<?php
  
namespace Pulpmedia\NgHttpBundle\EventListener;

use Pulpmedia\NgHttpBundle\Exceptions\ResponseException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Pulpmedia\NgHttpBundle\Services\ResponseFactory;
use Pulpmedia\NgHttpBundle\HttpFoundation\ErrorResponse;


class ExceptionListener
{

    private $rf;
    
    public function __construct(ResponseFactory $rf){
        $this->rf = $rf;
    }

    public function onKernelException( GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ( ! $exception instanceof ResponseException )
          return;
      
        $response = $this->rf->getErrorResponse();
        $response->setErrorCode($exception->getCode());
//         $response->setErrors($exception->getErrors());
        $response->setErrors($exception->getMessage());
        $response->setStatusCode($exception->getHttpStatus());

        $event->setResponse($response);

    }
}