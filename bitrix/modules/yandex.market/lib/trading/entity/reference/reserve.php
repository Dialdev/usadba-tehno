<?php

namespace Yandex\Market\Trading\Entity\Reference;

use Bitrix\Main;
use Yandex\Market;

abstract class Reserve
{
	protected $environment;

	public function __construct(Environment $environment)
	{
		$this->environment = $environment;
	}

	/**
	 * @param array $context
	 */
	public function configure(array $context)
	{
		// nothing by default
	}

	/**
	 * @param int[] $orderIds
	 * @param string[] $productIds
	 *
	 * @return array<string, array{QUANTITY: float, TIMESTAMP_X: Main\Type\DateTime}>
	 */
	public function getAmounts(array $orderIds, array $productIds)
	{
		throw new Market\Exceptions\NotImplementedMethod(static::class, 'getOrderReserves');
	}

	/**
	 * @param int[] $orderIds
	 * @param string[] $productIds
	 * @param Main\Type\DateTime|null $after
	 *
	 * @return array<int, string[]> $orderId => $orderProducts
	 */
	public function mapProducts(array $orderIds, array $productIds, Main\Type\DateTime $after = null)
	{
		throw new Market\Exceptions\NotImplementedMethod(static::class, 'mapOrderProducts');
	}
}