<?php

namespace overplex\GoogleFeedGenerator\attributes;

class AttributesSet
{
    use AttributesTrait;

    /**
     * Property name
     *
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return AttributesSet
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
