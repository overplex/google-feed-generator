<?php

namespace overplex\GoogleFeedGenerator\attributes;

use overplex\GoogleFeedGenerator\product\ProductAttribute;

trait AttributesTrait
{
    /**
     * Attributes
     *
     * @var ProductAttribute[]
     */
    private $attributes = [];

    /**
     * Sets attribute. If attribute is already exist, it would be overwritten.
     *
     * @param string $name
     * @param string $value
     * @return self
     */
    public function setAttribute($name, $value)
    {
        $productProperty = new ProductAttribute($name, $value);
        $this->attributes[strtolower($name)] = $productProperty;

        return $this;
    }

    /**
     * Adds attribute. Doesn't overwrite previous attributes.
     *
     * @param $name
     * @param $value
     * @return self
     */
    public function addAttribute($name, $value)
    {
        $productProperty = new ProductAttribute($name, $value);
        $attributeName = strtolower($name);

        if (!isset($this->attributes[$attributeName])) {
            $this->attributes[$attributeName] = [$productProperty];
            return $this;
        }

        if (!is_array($this->attributes[$attributeName])) {
            $this->attributes[$attributeName] = [$this->attributes[$attributeName], $productProperty];
            return $this;
        }

        $this->attributes[$attributeName][] = $productProperty;

        return $this;
    }

    /**
     * Returns attributes
     *
     * @param $prefix
     *
     * @return array
     */
    public function getAttributes($prefix)
    {
        $result = [];

        foreach ($this->attributes as $attributeItem) {
            if (is_object($attributeItem) && $attributeItem->getValue() instanceof AttributesSet) {
                $result[] = [
                    'name' => $prefix . $attributeItem->getName(),
                    'value' => $attributeItem->getValue()->getAttributes($prefix),
                ];

                continue;
            }

            $attributes = is_array($attributeItem) ? $attributeItem : [$attributeItem];
            /** @var ProductAttribute $attribute */
            foreach ($attributes as $attribute) {
                $result[] = $attribute->asArray($prefix);
            }
        }

        return $result;
    }

    /**
     * @return AttributesSet
     */
    public function getAttributesSet()
    {
        $attributesSet = new AttributesSet();
        foreach ($this->attributes as $attributeItem) {
            $attributes = is_array($attributeItem) ? $attributeItem : [$attributeItem];
            foreach ($attributes as $attribute) {
                $attributesSet->addAttribute($attribute->getName(), $attribute->getValue());
            }
        }

        return $attributesSet;
    }
}
