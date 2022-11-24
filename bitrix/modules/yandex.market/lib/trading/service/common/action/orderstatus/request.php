<?php

namespace Yandex\Market\Trading\Service\Common\Action\OrderStatus;

use Yandex\Market;
use Bitrix\Main;
use Yandex\Market\Trading\Service as TradingService;

class Request extends TradingService\Common\Action\HttpRequest
{
	/**
	 * @return Market\Api\Model\Order
	 * @throws Market\Exceptions\Api\InvalidOperation
	 */
	public function getOrder()
	{
		return $this->getRequiredModel('order');
	}

	public function isEmulated()
	{
		return (bool)$this->getField('emulated');
	}

	protected function getChildModelReference()
	{
		return [
			'order' => Market\Api\Model\Order::class
		];
	}
}