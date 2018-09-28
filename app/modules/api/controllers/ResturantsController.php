<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\Controller;
use Exception;
use app\modules\api\repositories\SearchingRepositoryInterface;

class ResturantsController extends Controller
{
    protected $searchingRepository;

    public function __construct($id, $module, SearchingRepositoryInterface $searchingRepository, $config = [])
    {
        $this->searchingRepository = $searchingRepository;
        parent::__construct($id, $module, $config);
    }

    /**
     * search for resturnats
     * @param String $q the search query
     **/
    public function actionSearch()
    {
        return $this->searchingRepository->search(Yii::$app->request->get());
    }
}
