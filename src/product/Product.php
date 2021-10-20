<?php

namespace overplex\GoogleFeedGenerator\product;

use overplex\GoogleFeedGenerator\attributes\AttributesTrait;
use overplex\GoogleFeedGenerator\exception\InvalidArgumentException;

class Product
{
    use AttributesTrait;

    /**
     * Sets id of product.
     *
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->setAttribute('id', $id);
        return $this;
    }

    /**
     * Sets title of product.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->setAttribute('title', $title);
        return $this;
    }

    /**
     * Sets description of product.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setDescription($title)
    {
        $this->setAttribute('description', $title);
        return $this;
    }

    /**
     * Sets link to the product.
     *
     * @param string $link
     *
     * @return $this
     */
    public function setLink($link)
    {
        $this->setAttribute('link', $link);
        return $this;
    }

    /**
     * Sets length of the product.
     *
     * @param string $length
     * @param string $unit
     *
     * @return $this
     */
    public function setLength($length, $unit)
    {
        $this->setAttribute('product_length', $length . ' ' . $unit);
        return $this;
    }

    /**
     * Sets width of the product.
     *
     * @param string $width
     * @param string $unit
     *
     * @return $this
     */
    public function setWidth($width, $unit)
    {
        $this->setAttribute('product_width', $width . ' ' . $unit);
        return $this;
    }

    /**
     * Sets height of the product.
     *
     * @param string $height
     * @param string $unit
     *
     * @return $this
     */
    public function setHeight($height, $unit)
    {
        $this->setAttribute('product_height', $height . ' ' . $unit);
        return $this;
    }

    /**
     * Sets weight of the product.
     *
     * @param string $weight
     * @param string $unit
     *
     * @return $this
     */
    public function setWeight($weight, $unit)
    {
        $this->setAttribute('product_weight', $weight . ' ' . $unit);
        return $this;
    }

    /**
     * Sets mobile link to the product.
     *
     * @param string $link
     *
     * @return $this
     */
    public function setMobileLink($link)
    {
        $this->setAttribute('mobile_link', $link);
        return $this;
    }

    /**
     * Sets image of the product.
     *
     * @param string $imageUrl
     *
     * @return $this
     */
    public function setImage($imageUrl)
    {
        $this->setAttribute('image_link', $imageUrl);
        return $this;
    }

    /**
     * Sets additional image of the product.
     *
     * @param string $imageUrl
     *
     * @return $this
     */
    public function setAdditionalImage($imageUrl)
    {
        $this->setAttribute('additional_image_link', $imageUrl);
        return $this;
    }

    /**
     * Sets additional image of the product.
     *
     * @param string $imageUrl
     *
     * @return $this
     */
    public function addAdditionalImage($imageUrl)
    {
        $this->addAttribute('additional_image_link', $imageUrl);
        return $this;
    }

    /**
     * Sets availability of the product.
     *
     * @param string $availability
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setAvailability($availability)
    {
        if (!in_array($availability, [
            Availability::IN_STOCK,
            Availability::OUT_OF_STOCK,
            Availability::PREORDER,
            Availability::BACKORDER,
        ], true)) {
            throw new InvalidArgumentException('Invalid availability property');
        }
        $this->setAttribute('availability', $availability);
        return $this;
    }

    /**
     * Sets price of the product.
     *
     * @param string $price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->setAttribute('price', $price);
        return $this;
    }

    /**
     * Sets sale price of the product.
     *
     * @param string $price
     *
     * @return $this
     */
    public function setSalePrice($price)
    {
        $this->setAttribute('sale_price', $price);
        return $this;
    }

    /**
     * Sets Google category of the product.
     *
     * @param string $category
     *
     * @return $this
     */
    public function setGoogleCategory($category)
    {
        $this->setAttribute('google_product_category', $category);
        return $this;
    }

    /**
     * Sets Google product_type of the product.
     *
     * @param string product_type
     *
     * @return $this
     */
    public function setProductType($product_type)
    {
        $this->setAttribute('product_type', $product_type);
        return $this;
    }

    /**
     * Sets brand of the product.
     *
     * @param string $brand
     *
     * @return $this
     */
    public function setBrand($brand)
    {
        $this->setAttribute('brand', $brand);
        return $this;
    }

    /**
     * Sets GTIN code of the product.
     *
     * @param string $gtin
     *
     * @return $this
     */
    public function setGtin($gtin)
    {
        $this->setAttribute('gtin', $gtin);
        return $this;
    }

    /**
     * Sets MPN code of the product.
     *
     * @param string $mpn
     *
     * @return $this
     */
    public function setMpn($mpn)
    {
        $this->setAttribute('mpn', $mpn);
        return $this;
    }

    /**
     * Sets identifier_exists code of the product. (yes / no)
     *
     * @param string $identifierExists
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setIdentifierExists($identifierExists)
    {
        $identifierExists = strtolower($identifierExists);
        if (!in_array($identifierExists, ['yes', 'no'])) {
            throw new InvalidArgumentException("identifier_exists property should be one of 'yes' or 'no'");
        }
        $this->setAttribute('identifier_exists', $identifierExists);
        return $this;
    }

    /**
     * Sets condition of the product. `new`, `refurbished` or `used` are valid
     *
     * @param string $condition
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setCondition($condition)
    {
        if (!in_array($condition, [
            Condition::NEW_PRODUCT,
            Condition::REFURBISHED,
            Condition::USED,
        ], true)) {
            throw new InvalidArgumentException("Invalid condition property");
        }
        $this->setAttribute('condition', $condition);
        return $this;
    }

    /**
     * Sets adult of the product.
     *
     * @param bool $adult
     *
     * @return $this
     */
    public function setAdult($adult)
    {
        $this->setAttribute('adult', $adult ? 'yes' : 'no');
        return $this;
    }

    /**
     * Sets color of the product.
     *
     * @param string $color
     *
     * @return $this
     */
    public function setColor($color)
    {
        $this->setAttribute('color', $color);
        return $this;
    }

    /**
     * Sets material of the product.
     *
     * @param string $material
     *
     * @return $this
     */
    public function setMaterial($material)
    {
        $this->setAttribute('material', $material);
        return $this;
    }

    /**
     * Sets size of the product.
     *
     * @param string $size
     *
     * @return $this
     */
    public function setSize($size)
    {
        $this->setAttribute('size', $size);
        return $this;
    }

    /**
     * Sets shipping of the product.
     *
     * @param Shipping $shipping
     *
     * @return $this
     */
    public function setShipping($shipping)
    {
        $attributesSet = $shipping->getAttributesSet()->setName('shipping');
        $this->setAttribute('shipping', $attributesSet);
        return $this;
    }

    /**
     * Adds shipping of the product.
     *
     * @param Shipping $shipping
     *
     * @return $this
     */
    public function addShipping($shipping)
    {
        $attributesSet = $shipping->getAttributesSet()->setName('shipping');
        $this->addAttribute('shipping', $attributesSet);
        return $this;
    }
}
