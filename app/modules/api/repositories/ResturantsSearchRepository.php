<?php
/**
* repository for searching in resturants collection
*/
namespace app\modules\api\repositories;

use Yii;
use app\modules\api\models\Resturants;
use Exception;

class ResturantsSearchRepository implements SearchingRepositoryInterface
{
    protected $params;
    protected $requestValidator;
    protected $errorMessages;
    protected $successResponse;
    protected $errorResponse;

    public function __construct()
    {
        $this->requestValidator = Yii::$container->get('ResturantsSearchingRequestValidator');
        $this->successResponse = Yii::$container->get('SuccessResponse');
        $this->errorResponse = Yii::$container->get('ErrorResponse');
    }

    /**
     * initilize searching 
     * @param Array $params search params
     **/
    public function search(Array $params)
    {
        try {
            $this->params = $params;
            if ($this->isValidParams()) {
                $result = $this->getSearchResult();
                $this->successResponse->setData($result);

                return $this->successResponse->getResponse();

            } else {
                Yii::$app->response->statusCode = 422;
                throw new Exception('Invalid Params', 1);
            }
        } catch (Exception $e) {
            // throw new Exception($e->getMessage(), 1);
            $this->errorResponse->setData($this->errorMessages);
            return $this->errorResponse->getResponse();
        } 
    }

    /**
     * get search result
     * @return Array result 
     **/
    protected function getSearchResult()
    {
        $query = Resturants::find()->select(['restaurantName', 'city', 'cuisine', 'loc']);
        if (isset($this->params['name']))
            $query->andWhere(['like' , 'restaurantName',  $this->params['name']]);
        if (isset($this->params['city']))
            $query->andWhere(['like' , 'city',  $this->params['city']]);
        if (isset($this->params['cuisine']))
            $query->andWhere(['like' , 'cuisine',  $this->params['cuisine']]);
        if (isset($this->params['freetext'])) {
            $query->orWhere(['like', 'restaurantName', $this->params['freetext']]);
            $query->orWhere(['like', 'city', $this->params['freetext']]);
            $query->orWhere(['like', 'cuisine', $this->params['freetext']]);
        }
        if (isset($this->params['lon']) && isset($this->params['lat'])) {
            $query->where([
                "loc" => [
                    '$near' => [
                        '$geometry' => [
                                'type' => "Point",
                                'coordinates' => [(float)$this->params['lon'], (float)$this->params['lat']]
                            ],
                        '$maxDistance' => 300
                    ]
                ]
            ]);
        }
        
        $result = $query->limit(50)->all();
        
        return $result;
    }
    
    /**
     * validate the request params
     * @return Boolean $valid
     * */
    protected function isValidParams()
    {
        $valid = true;
        $this->requestValidator->load($this->params, '');
        $errorMessages = $this->requestValidator->getValidationErrors();
        if ($errorMessages) {
            $this->errorMessages = $errorMessages;        
            $valid = false;
        }

        return $valid;
    }
}
