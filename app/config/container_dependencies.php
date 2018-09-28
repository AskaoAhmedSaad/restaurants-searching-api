<?php

return [
    'definitions' => [
        'app\modules\api\repositories\SearchingRepositoryInterface' => [
               'class' =>  'app\modules\api\repositories\ResturantsSearchRepository'
           ],
        'validatorFactory' => [
           'class' =>  'app\modules\api\components\requestsValidators\dependencies\ValidatorFactory'
       ],
      'ResturantsSearchingRequestValidator' => [
             'class' =>  'app\modules\api\components\requestsValidators\ResturantsSearchingRequestValidator'
         ],
      'SuccessResponse' => [
             'class' =>  'app\modules\api\components\responses\SuccessResponse'
         ],
      'ErrorResponse' => [
             'class' =>  'app\modules\api\components\responses\ErrorResponse'
         ],
    ]
];