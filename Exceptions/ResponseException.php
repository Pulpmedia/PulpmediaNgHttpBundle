<?php
namespace Pulpmedia\NgHttpBundle\Exceptions;
use Symfony\Component\HttpFoundation\Response;


class ResponseException extends \Exception
{   
    const MESSAGE = '';
  
    const ERROR_CODE = 0;
    
    const HTTP_STATUS = Response::HTTP_INTERNAL_SERVER_ERROR;
  
    private $errors = array();
    
    private $httpStatus = 0;
    
    public function __construct($message = null, $code = null, \Exception $previous = null) 
    {        
        $message = ($message) ?: static::MESSAGE;
        $code = ($code)  ?: static::ERROR_CODE;        
        parent::__construct($message, $code, $previous);
    }
    
    public function setErrors( $errors = array())
    {
      $this->errors = $errors;
    }

    public function getErrors()
    {
      return $this->errors;
    }
    
    public function setHttpStatus( $httpStatus = 0 )
    {
      $this->httpStatus = $httpStatus;
    }

    public function getHttpStatus()
    {
      return ($this->httpStatus) ?: static::HTTP_STATUS;
    }
}