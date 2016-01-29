<?php
namespace Pulpmedia\NgHttpBundle\Exceptions\ResponseExceptions;

use Pulpmedia\NgHttpBundle\Exceptions\ResponseException;
use Symfony\Component\HttpFoundation\Response;

class UsernameExistsException extends ResponseException
{
  const MESSAGE = 'Username already exists.';
  
  const ERROR_CODE = Response::HTTP_UNPROCESSABLE_ENTITY;
    
  const HTTP_STATUS = Response::HTTP_UNPROCESSABLE_ENTITY;

}