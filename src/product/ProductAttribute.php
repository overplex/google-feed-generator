<?php

namespace overplex\GoogleFeedGenerator\product;

use overplex\GoogleFeedGenerator\attributes\AttributesSet;

class ProductAttribute
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * ProductProperty constructor.
     *
     * @param      $name
     * @param      $value
     */
    public function __construct($name, $value)
    {
        $this->name = strtolower($name);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string|AttributesSet
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @param $prefix
     *
     * @return array
     */
    public function asArray($prefix)
    {
        $value = $this->getValue();

        if (is_object($value) && $value instanceof AttributesSet) {
            return [
                'name' => $prefix . $this->getName(),
                'value' => $value->getAttributes($prefix),
            ];
        }

        return [
            'name' => $prefix . $this->getName(),
            'value' => $value,
        ];
    }
}
