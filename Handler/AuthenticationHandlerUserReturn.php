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
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

use Pulpmedia\NgHttpBundle\Services\ResponseFactory;

class AuthenticationHandlerUserReturn extends AuthenticationHandler implements AuthenticationSuccessHandlerInterface, AuthenticationFailureHandlerInterface, AuthenticationEntryPointInterface, LogoutSuccessHandlerInterface
{

    public function __construct(ResponseFactory $rf){
      parent::__construct($rf);
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
        $user = $token->getUser();
        $response = $this->rf->getSuccessResponse();
        $response->setContent($user);
        $response->setExclusionStrategy($response::EXCLUSION_GROUP);
        $response->setGroups(array('login'));
        return $response;
    }

}
