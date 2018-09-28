<?php
/**
 * return success response
 * */
namespace app\modules\api\components\responses;

class SuccessResponse implements ResponseInterface
{
	protected $data;

	public function setData(Array $data)
	{
		$this->data = $data;
	}

	public function getResponse()
	{
		return [
			"success" => true,
			"data" => $this->data,
			"count" => count($this->data),

		];
	}
}