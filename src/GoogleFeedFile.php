<?php

namespace overplex\GoogleFeedGenerator;

use Exception;
use LogicException;
use overplex\GoogleFeedGenerator\product\Product;
use RuntimeException;
use XMLWriter;
use function copy;
use function is_array;
use function sprintf;
use function sys_get_temp_dir;
use function tempnam;
use function unlink;

/**
 * Class Generator
 */
class GoogleFeedFile
{
    const ATTRIBUTE_PREFIX = 'g';

    /**
     * @var string
     */
    protected $tmpFile;

    /**
     * @var XMLWriter
     */
    protected $writer;

    /**
     * @var Settings
     */
    protected $settings;

    /**
     * Generator constructor.
     *
     * @param string $title
     * @param string $link
     * @param string $description
     * @param Settings $settings
     */
    public function __construct($title, $link, $description, $settings = null)
    {
        $this->settings = $settings instanceof Settings ? $settings : new Settings();
        $this->writer = new XMLWriter();

        if ($this->settings->getOutputFile() !== null && $this->settings->getReturnResultAsString()) {
            throw new LogicException(
                'Only one destination need to be used ReturnResultAsString or OutputFile'
            );
        }

        if ($this->settings->getReturnResultAsString()) {
            $this->writer->openMemory();
        } else {
            $this->tmpFile = $this->settings->getOutputFile() !== null
                ? tempnam(sys_get_temp_dir(), 'GoogleFeedGenerator')
                : 'php://output';
            $this->writer->openURI($this->tmpFile);
        }

        if ($this->settings->getIndentString()) {
            $this->writer->setIndentString($this->settings->getIndentString());
            $this->writer->setIndent(true);
        }

        $this->addHeader($title, $link, $description);
    }

    public function finish()
    {
        try {
            $this->addFooter();

            if ($this->settings->getReturnResultAsString()) {
                return $this->writer->flush();
            }

            if ($this->settings->getOutputFile() !== null) {
                copy($this->tmpFile, $this->settings->getOutputFile());
                @unlink($this->tmpFile);
            }

            return true;
        } catch (Exception $exception) {
            $this->throwException($exception);
        }

        return false;
    }

    /**
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        $this->writer->startElement('item');
        $this->writeElements($product->getAttributes(self::ATTRIBUTE_PREFIX . ':'));
        $this->writer->fullEndElement();
    }

    /**
     * Add document header
     *
     * @param string $title
     * @param string $link
     * @param string $description
     */
    protected function addHeader($title, $link, $description)
    {
        try {
            $this->writer->startDocument('1.0');

            $this->writer->startElement('rss');
            $this->writer->writeAttribute('version', '2.0');
            $this->writer->writeAttribute('xmlns:' . self::ATTRIBUTE_PREFIX,
                'http://base.google.com/ns/1.0');

            $this->writer->startElement('channel');

            if (!empty($title)) {
                $this->writer->writeElement('title', $title);
            }

            if (!empty($link)) {
                $this->writer->writeElement('link', $link);
            }

            if (!empty($description)) {
                $this->writer->writeElement('description', $description);
            }
        } catch (Exception $exception) {
            $this->throwException($exception);
        }
    }

    /**
     * Add document footer
     */
    protected function addFooter()
    {
        $this->writer->fullEndElement();
        $this->writer->fullEndElement();
        $this->writer->endDocument();
    }

    /**
     * @param array $elements
     */
    private function writeElements($elements)
    {
        foreach ($elements as $item) {
            if (is_array($item['value'])) {
                $this->writer->startElement($item['name']);
                $this->writeElements($item['value']);
                $this->writer->endElement();
            } elseif ($item['value'] instanceof Cdata) {
                $this->writer->startElement($item['name']);
                $this->writer->writeCdata((string)$item['value']);
                $this->writer->endElement();
            } else {
                $this->writer->writeElement($item['name'], $item['value']);
            }
        }
    }

    private function throwException($exception)
    {
        throw new RuntimeException(sprintf(
            'Problem with generating Google Feed file: %s',
            $exception->getMessage()
        ), 0, $exception);
    }
}
