<?php

namespace overplex\GoogleFeedGenerator;

/**
 * Represents a value that should be written to XML as CDATA
 */
class Cdata
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Allows to get the wrapped value by casting an instance to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}
