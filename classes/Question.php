<?php

namespace classes;

abstract class Question
{
    protected $source;
    
    protected $tags = array();
    
    abstract public function display();

    /**
     * @param $type
     * @return ImageQuestion
     */
    public static function constructByType($type)
    {
        switch ($type) {
            case "image":
                return new ImageQuestion();
                break;
            default:
                throw new \BadMethodCallException('Invalid type');
        }
    }
    
    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
    }
    
    
}