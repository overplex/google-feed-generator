# Google Merchant Feed file generator

About
-----
[Google Merchant Feed](https://support.google.com/merchants/answer/160589) file generator.
Uses standard XMLWriter for generating Google Merchant Feed XML file. 
Not required any other library you just need PHP 5.5.0 or >= version.

Installation
------------
Run composer require

```bash
composer require overplex/google-feed-generator
```

Or add this to your `composer.json` file:

```json
"require": {
  "overplex/google-feed-generator": "dev-master",
}
```

Usage example
-------------

```php
<?php

use overplex\GoogleFeedGenerator\product\Availability;
use overplex\GoogleFeedGenerator\product\Condition;
use overplex\GoogleFeedGenerator\product\Product;
use overplex\GoogleFeedGenerator\GoogleFeedFile;
use overplex\GoogleFeedGenerator\Settings;

// Create second (unbuffered) connection to database (only for Yii 2)
$unbufferedDb = new \yii\db\Connection([
    'dsn' => \Yii::$app->db->dsn,
    'charset' => \Yii::$app->db->charset,
    'username' => \Yii::$app->db->username,
    'password' => \Yii::$app->db->password,
    'tablePrefix' => \Yii::$app->db->tablePrefix,
]);
$unbufferedDb->open();
$unbufferedDb->pdo->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

// Writing header to google_feed.xml
$feed = new GoogleFeedFile('My best shop', 'http://www.myshop.com/', 'Description of my shop',
    (new Settings())->setOutputFile('google_feed.xml')
);

// Writing products
/** @var ProductModel $product */
foreach ($this->getProductsQuery()->each(50, $unbufferedDb) as $product) {
    $feed->addProduct((new Product())
        ->setId($product->id)
        ->setMpn($product->articul)
        ->setLink($product->getViewAbsoluteUrl())
        ->setImage($product->getMainPhotoAbsoluteUrl())
        ->setTitle($product->name)
        ->setPrice($product->getOldPrice() . ' RUB')
        ->setSalePrice($product->getPrice() . ' RUB')
        ->setCondition(Condition::NEW_PRODUCT)
        ->setDescription($product->description)
        ->setAvailability($product->in_stock
            ? Availability::IN_STOCK
            : Availability::OUT_OF_STOCK)
        ->setLength($product->depth, 'cm')
        ->setWidth($product->width, 'cm')
        ->setHeight($product->height, 'cm')
        ->setWeight($product->weight, 'kg')
        ->setGoogleCategory($categoryId)
        ->setBrand($vendor));
    gc_collect_cycles();
}

$feed->finish();
$unbufferedDb->close();
```

Copyright / License
-------------------

See [LICENSE](https://github.com/overplex/google-feed-generator/blob/master/LICENSE)
