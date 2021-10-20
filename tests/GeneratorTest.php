<?php

namespace overplex\GoogleFeedGenerator\tests;

use Faker\Factory as Faker;
use overplex\GoogleFeedGenerator\GoogleFeedFile;
use overplex\GoogleFeedGenerator\product\Availability;
use overplex\GoogleFeedGenerator\product\Condition;
use overplex\GoogleFeedGenerator\product\Product;
use overplex\GoogleFeedGenerator\Settings;
use PHPUnit_Framework_TestCase;
use function range;

/**
 * Generator test
 */
class GeneratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * Test setup
     */
    protected function setUp()
    {
        $this->faker = Faker::create();
    }

    /**
     * Test generate
     */
    public function testGenerate()
    {
        $feed = new GoogleFeedFile($this->faker->title, $this->faker->url, $this->faker->text, (new Settings())
            ->setOutputFile('google_feed.xml')
        );

        foreach (range(1, 2) as $id) {
            $feed->addProduct((new Product())
                ->setId($id)
                ->setMpn($this->faker->text(10))
                ->setLink($this->faker->url)
                ->setImage($this->faker->imageUrl())
                ->setTitle($this->faker->title)
                ->setPrice($this->faker->numberBetween(1, 9999) . ' RUB')
                ->setSalePrice($this->faker->numberBetween(1, 9999) . ' RUB')
                ->setCondition($this->faker->randomElement([
                    Condition::USED, Condition::REFURBISHED, Condition::NEW_PRODUCT
                ]))
                ->setDescription($this->faker->sentence)
                ->setAvailability($this->faker->boolean
                    ? Availability::IN_STOCK
                    : Availability::OUT_OF_STOCK)
                ->setLength($this->faker->randomFloat(3, 0), 'cm')
                ->setWidth($this->faker->randomFloat(3, 0), 'cm')
                ->setHeight($this->faker->randomFloat(3, 0), 'cm')
                ->setWeight($this->faker->numberBetween(1, 9999), 'kg')
                ->setAttribute('abc', 'my value')
                ->setGoogleCategory($this->faker->numberBetween(1, 9999))
                ->setBrand($this->faker->word()));
        }

        $feed->finish();
    }
}
