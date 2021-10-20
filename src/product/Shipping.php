<?php

namespace overplex\GoogleFeedGenerator\product;

use overplex\GoogleFeedGenerator\attributes\AttributesTrait;

/**
 * Describes product's specific shipping rules
 *
 * @see https://support.google.com/merchants/answer/6324484
 */
class Shipping
{
    use AttributesTrait;

    /**
     * Sets shipping country.
     *
     * @param string $countryCode ISO 3166-1 country code
     *
     * @return $this
     */
    public function setCountry($countryCode)
    {
        $this->setAttribute('country', $countryCode);
        return $this;
    }

    /**
     * Sets shipping country.
     *
     * @param string $region
     *
     * @return $this
     */
    public function setRegion($region)
    {
        $this->setAttribute('region', $region);
        return $this;
    }

    /**
     * Sets shipping postal code.
     *
     * @param string $postalCode
     *
     * @return $this
     */
    public function setPostalCode($postalCode)
    {
        $this->setAttribute('postal_code', $postalCode);
        return $this;
    }

    /**
     * Sets shipping location id.
     *
     * @param string $locationId
     *
     * @return $this
     */
    public function setLocationId($locationId)
    {
        $this->setAttribute('location_id', $locationId);
        return $this;
    }

    /**
     * Sets shipping location group name.
     *
     * @param string $locationGroupName
     *
     * @return $this
     */
    public function setLocationGroupName($locationGroupName)
    {
        $this->setAttribute('location_group_name', $locationGroupName);
        return $this;
    }

    /**
     * Sets shipping service.
     *
     * @param string $service
     *
     * @return $this
     */
    public function setService($service)
    {
        $this->setAttribute('service', $service);
        return $this;
    }

    /**
     * Sets shipping price.
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
}
