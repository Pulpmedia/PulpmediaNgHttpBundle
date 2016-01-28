<?php
namespace Pulpmedia\NgHttpBundle\Exceptions\ResponseExceptions;

use Pulpmedia\NgHttpBundle\Exceptions\ResponseException;
use Symfony\Component\HttpFoundation\Response;

class FormInvalidException extends ResponseException
{
  const MESSAGE = 'This form is invalid.';
  
  const ERROR_CODE = Response::HTTP_UNPROCESSABLE_ENTITY;
    
  const HTTP_STATUS = Response::HTTP_UNPROCESSABLE_ENTITY;

}