<?php

namespace Pulpmedia\NgHttpBundle\HttpFoundation;

class ErrorResponse extends BaseResponse{

    private $errorCode = 0;
    private $errors = array();
    private $data;

    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
        $this->createContent();
    }
    public function setErrors($errors)
    {
        $this->errors = $errors;
        $this->createContent();
    }

    private function createContent(){
        $content = array(
                'errorCode' => $this->errorCode,
                'errors'    => $this->errors
        );
        parent::setContent($content);
    }

}
