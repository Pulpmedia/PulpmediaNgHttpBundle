<?php

namespace Pulpmedia\NgHttpBundle\Handler;

use Symfony\Component\HttpFoundation\Response;
use Pulpmedia\NgHttpBundle\Component\HttpFoundation\SuccessResponse;
use Pulpmedia\NgHttpBundle\Component\HttpFoundation\ErrorResponse;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;
use Symfony\Component\Security\Http\EntryPoint\AuthenticationEntryPointInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

use Pulpmedia\NgHttpBundle\Services\ResponseFactory;

class AuthenticationHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface, AuthenticationEntryPointInterface
{

    private $rf;
    public function __construct(ResponseFactory $rf){
        $this->rf = $rf;
    }


    /**
     * start function.
     * 
     * @access public
     * @param Request $request
     * @param AuthenticationException $authException
     * @return Response the response to return
     */
    public function start(Request $request, AuthenticationException $authException = null ) {

          $response = $this->rf->getErrorResponse();
          $response->setErrors(array('message' => $authException->getMessage()));
          return $response;  
    }

    /**
     * This is called when an interactive authentication attempt succeeds. This
     * is called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @see \Symfony\Component\Security\Http\Firewall\AbstractAuthenticationListener
     * @param Request        $request
     * @param TokenInterface $token
     * @return Response the response to return
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
            $result = array('success' => true);
            $response = $this->rf->getSuccessResponse();
            $response->setContent($result);
            return $response;
    }

    /**
     * This is called when an interactive authentication attempt fails. This is
     * called by authentication listeners inheriting from
     * AbstractAuthenticationListener.
     *
     * @param Request                 $request
     * @param AuthenticationException $exception
     * @return Response the response to return
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {

            $response = $this->rf->getErrorResponse();
            $response->setErrors(array('message' => $exception->getMessage()));
            return $response;
    }
}
