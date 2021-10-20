<?php

namespace overplex\GoogleFeedGenerator;

/**
 * Class Settings
 */
class Settings
{
    /**
     * Output file name. If null 'php://output' is used.
     *
     * @var string|null
     */
    protected $outputFile;

    /**
     * If true Generator will return generated Google Feed string.
     * Not recommended to use this for big catalogs because of heavy memory usage.
     *
     * @var bool
     */
    protected $returnResultAsString = false;

    /**
     * Indent string in xml file. False or null means no indent;
     *
     * @var string
     */
    protected $indentString = "\t";

    /**
     * @return string|null
     */
    public function getOutputFile()
    {
        return $this->outputFile;
    }

    /**
     * @param string|null $outputFile
     *
     * @return Settings
     */
    public function setOutputFile($outputFile)
    {
        $this->outputFile = $outputFile;

        return $this;
    }

    /**
     * @return string
     */
    public function getIndentString()
    {
        return $this->indentString;
    }

    /**
     * @param string $indentString
     *
     * @return Settings
     */
    public function setIndentString($indentString)
    {
        $this->indentString = $indentString;

        return $this;
    }

    /**
     * @param bool $returnResultAsString
     *
     * @return Settings
     */
    public function setReturnResultAsString($returnResultAsString)
    {
        $this->returnResultAsString = $returnResultAsString;

        return $this;
    }

    /**
     * @return bool
     */
    public function getReturnResultAsString()
    {
        return $this->returnResultAsString;
    }
}
