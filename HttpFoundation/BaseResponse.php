<?php

namespace Pulpmedia\NgHttpBundle\HttpFoundation;

use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\Serializer;

class BaseResponse extends Response{
    protected $content;
    private $serializer;

    public function __construct(Serializer $serializer){
        $this->serializer = $serializer;
        parent::__construct();
        $this->headers->set('Content-Type','Application/Json');
    }

    public function setContent($content){
        parent::setContent($this->serializer->serialize($content,'json'));
    }
}
