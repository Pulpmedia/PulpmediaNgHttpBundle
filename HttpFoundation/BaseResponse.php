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
    private $serializeNull = false;

    public function __construct(Serializer $serializer){
        $this->serializer = $serializer;
        parent::__construct();
        $this->headers->set('Content-Type','application/json');
    }

    public function setExclusionStrategy($strategy){
        $this->exclusionStrategy = $strategy;
        $this->setSerializedContent();
    }
    public function setSerializeNull($serializeNull){
        $this->serializeNull = $serializeNull;
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

        if($this->exclusionStrategy == self::EXCLUSION_GROUP && !empty($this->groups)){
            $context = SerializationContext::create()->setGroups($this->groups);
        } elseif($this->exclusionStrategy == self::EXCLUSION_VERSION){
            $context = SerializationContext::create()->setVersion($this->version);
        } else{
            $context = SerializationContext::create();
        }

        $context->setSerializeNull($this->serializeNull);
        $serializedContent = $this->serializer->serialize($content,'json',$context);

        return $serializedContent;
    }
}
