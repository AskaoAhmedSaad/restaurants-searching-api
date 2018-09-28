<?php

use \Codeception\Util\Fixtures;
use \Codeception\Util\HttpCode;

class GtiSearchingCest
{
    public function _before(ApiTester $I)
    {; 
        Fixtures::add('responses_case1', require( __DIR__ . '/../fixtures/_data/searchApiResponse/responses_case1.php'));
        Fixtures::add('responses_case2', require( __DIR__ . '/../fixtures/_data/searchApiResponse/responses_case2.php'));
    }

    public function _after(ApiTester $I)
    {
    }

    public function testPositiveSearching(ApiTester $I)
    {
        $I->wantTo('test searching with name,city,cuisine params ,  _case1');
        $I->sendGET('/api/resturants/search?name=Thaimidd&city=Stockholm&cuisine=Thai');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(Fixtures::get('responses_case1'));

        $I->wantTo('test searching with freetext');
        $I->sendGET('/api/resturants/search?freetext=Thai');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->wantTo('test searching with city only');
        $I->sendGET('/api/resturants/search?city=Thai');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->cantSeeResponseContainsJson(['city' => 'Stockholm']);

        $I->wantTo('test searching with near me params');
        $I->sendGET('/api/resturants/search?lon=13.000005&lat=55.601364');
        $I->seeResponseCodeIs(HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->cantSeeResponseContainsJson(["coordinates" => [
                                            55.703499,
                                            13.191
                                          ]]);
    }


    public function testNegativeSearchingWithValidationError(ApiTester $I)
    {
        $I->wantTo('test searching with wrong location params');
        $I->sendGET('/api/resturants/search?lon=Thai&lat=Stockholm');
        $I->seeResponseCodeIs(HttpCode::UNPROCESSABLE_ENTITY); // 422
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(Fixtures::get('responses_case2'));
    }
}
