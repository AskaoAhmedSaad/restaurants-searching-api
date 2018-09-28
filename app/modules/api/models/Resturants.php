<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for collection "resturants".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $clientKey
 * @property mixed $restaurantName
 * @property mixed $cuisine
 * @property mixed $city
 * @property mixed $latitude
 * @property mixed $longitude
 */
class Resturants extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return ['hungrig', 'resturants'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            'clientKey',
            'restaurantName',
            'cuisine',
            'city',
            'loc',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['clientKey', 'restaurantName', 'cuisine', 'city', 'loc'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'clientKey' => 'Client Key',
            'restaurantName' => 'Restaurant Name',
            'cuisine' => 'Cuisine',
            'city' => 'City',
        ];
    }
}
