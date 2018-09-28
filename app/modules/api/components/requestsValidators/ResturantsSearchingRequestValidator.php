<?php
namespace app\modules\api\components\requestsValidators;

use app\modules\api\components\requestsValidators\dependencies\IlluminateRequestValidator;

class ResturantsSearchingRequestValidator extends IlluminateRequestValidator
{
    public $name, $cuisine, $city, $lat, $lon, $freetext;

    public function getRules()
    {
        return [
            'name' => 'string',
            'cuisine' => 'string|nullable',
            'city' => 'string|nullable',
            'lat' => ['numeric'],
            'lon' => ['numeric'],
            'freetext' => ['string', 'nullable'],
        ];
    }

}
