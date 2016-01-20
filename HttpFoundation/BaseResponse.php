<?php

namespace Pulpmedia\NgHttpBundle\HttpFoundation;

use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializationContext;

class BaseResponse extends Response{

    const EXCLUSION_DEFAULT = 0;
    const EXCLUSION_VERSION = 1;
    const EXCLUSION_GROUP = 2;

    protected $content;
    private $serializer;
    private $exclusionStrategy = self::EXCLUSION_DEFAULT;
    private $groups = array();
    protected $version = 0;
    protected $contentData;

    public function __construct(Serializer $serializer){
        $this->serializer = $serializer;
        parent::__construct();
        $this->headers->set('Content-Type','application/json');
    }

    public function setExclusionStrategy($strategy){
        $this->exclusionStrategy = $strategy;
        $this->setSerializedContent();
    }

    public function setVersion($version){
        $this->version = $version;
        $this->setSerializedContent();
    }

    public function setGroups($groups = array()){
        $this->groups = $groups;
        $this->setSerializedContent();
    }

    public function setContent($content){
        $this->contentData = $content;
        $this->setSerializedContent();
    }

    private function setSerializedContent(){
        parent::setContent($this->serializeContent($this->contentData));
    }
    private function serializeContent($content){
        $serializedContent = "";
        if($this->exclusionStrategy == self::EXCLUSION_GROUP){
            $serializedContent = $this->serializer->serialize($content,'json',SerializationContext::create()->setGroups($this->groups));
        } elseif($this->exclusionStrategy == self::EXCLUSION_VERSION){
            $serializedContent = $this->serializer->serialize($content,'json',SerializationContext::create()->setVersion($this->version));
        } else{
            $serializedContent = $this->serializer->serialize($content,'json');
        }
        return $serializedContent;
    }
}
