<?php
namespace Pulpmedia\NgHttpBundle\Exceptions\ResponseExceptions;

use Pulpmedia\NgHttpBundle\Exceptions\ResponseException;
use Symfony\Component\HttpFoundation\Response;

class UserExistsException extends ResponseException
{
  const MESSAGE = 'This User already exist.';
  
  const ERROR_CODE = Response::HTTP_UNPROCESSABLE_ENTITY;
    
  const HTTP_STATUS = Response::HTTP_UNPROCESSABLE_ENTITY;

}