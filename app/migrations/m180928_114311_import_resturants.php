<?php

class m180928_114311_import_resturants extends \yii\mongodb\Migration
{
    public function up()
    {
        $collection = \Yii::$app->mongodb->getCollection('resturants');
        $backendDataJson = file_get_contents( __DIR__ . '/../data/backend-data.json');
        $backendData = json_decode($backendDataJson, true);
        foreach ($backendData as $item) {
            $collection->insert([
                "clientKey"=>  $item["clientKey"],
                "restaurantName"=>  $item["restaurantName"],
                "cuisine"=>  $item["cuisine"],
                "city"=>  $item["city"],
                "loc" =>  [
                  "type" =>  "Point",
                  "coordinates" => [
                    (float)$item["longitude"],
                    (float)$item["latitude"]
                  ] 
              ]
            ]);
        }

        // $this->createIndex('resturants', '{loc: {"2dsphere"}');
    }

    public function down()
    {
        echo "m180928_114311_import_resturants cannot be reverted.\n";

        return false;
    }
}
