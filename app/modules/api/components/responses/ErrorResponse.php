<?php
/**
 * return error response
 * */
namespace app\modules\api\components\responses;

class ErrorResponse implements ResponseInterface
{
	protected $data;

	public function setData(Array $data = null)
	{
		$this->data = $data;
	}

	public function getResponse()
	{
		return [
			"error" => true,
			"data" => $this->data
		];
	}
}