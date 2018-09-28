<?php
/**
* interface for any searching repository
*/
namespace app\modules\api\repositories;


interface SearchingRepositoryInterface
{

    public function search(Array $params);
}
