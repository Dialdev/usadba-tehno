<?php

namespace Yandex\Market\Trading\Entity\SaleCrm;

use Yandex\Market;
use Yandex\Market\Trading\Entity as TradingEntity;
use Yandex\Market\Trading\Setup as TradingSetup;
use Yandex\Market\Ui\Trading as UiTrading;
use Bitrix\Main;

class AdminExtension extends TradingEntity\Sale\AdminExtension
{
	use Market\Reference\Concerns\HasMessage;

	const MENU_ID = 'yandexMarketRouter';

	public static function onEntityDetailsTabsInitialized(Main\Event $event)
	{
		if (!defined('\CCrmOwnerType::Order')) { return null; } // old bitrix
		if ((int)$event->getParameter('entityTypeID') !== \CCrmOwnerType::Order) { return null; } // other entity type

		$disabled = true;

		if ($disabled) { return null; } // future reserved

		try
		{
			$orderInfo = static::getOrderInfo([ 'ID' => $event->getParameter('entityID') ]);
			$setup = TradingSetup\Model::loadByExternalIdAndSite($orderInfo['TRADING_PLATFORM_ID'], $orderInfo['SITE_ID']);
			$tabSet = new UiTrading\OrderViewTabSet($setup, $orderInfo['EXTERNAL_ORDER_ID']);

			$tabSet->checkReadAccess();
			$tabSet->checkSupport();

			$moduleTabs = $tabSet->getTabs();
			$moduleTab = reset($moduleTabs);

			$tabs = (array)$event->getParameter('tabs');
			$tabs[] = [
				'id' => 'tab_' . Market\Config::getLangPrefix() . 'trading_order',
				'name' => $moduleTab['TAB'],
				'loader' => [
					'serviceUrl' => $tabSet->getContentsUrl([
						'template' => 'bitrix24',
					]),
				],
			];

			$result = new Main\EventResult(Main\EventResult::SUCCESS, [
				'tabs' => $tabs,
			]);
		}
		catch (Main\SystemException $exception)
		{
			$result = null;
		}

		return $result;
	}

	public function install()
	{
		$this->unbindParent();
		parent::install();
		$this->installCrm();
	}

	protected function unbindParent()
	{
		$parent = new TradingEntity\Sale\AdminExtension($this->environment);
		$parent->unbind();
	}

	protected function installCrm()
	{
		foreach (Market\Data\Site::getVariants() as $siteId)
		{
			if (!Market\Data\Site::isCrm($siteId)) { continue; }

			list($documentRoot, $sitePath) = Market\Data\Site::getDocumentRoot($siteId);
			$publicDirectory = $this->getCrmPublicDirectory($documentRoot . $sitePath);

			if ($this->isCrmPublicAutoupdateDisabled($publicDirectory)) { continue; }

			$publicRelative = Market\Utils\IO\Path::absoluteToRelative(
				$publicDirectory->getPath(),
				$documentRoot
			);
			$publicRelative = '/' . $publicRelative;

			$this->copyCrmPublic($publicDirectory);
			$this->configureCrmRouter($siteId, $publicRelative);
			$this->addCrmMenu($siteId, $publicRelative);
		}
	}

	protected function getCrmPublicDirectory($documentRoot)
	{
		$rootRelative = '/' . str_replace('.', '', Market\Config::getModuleName());
		$repeatCount = 0;
		$repeatLimit = 10;
		$result = null;

		do
		{
			$relative = $rootRelative . ($repeatCount > 0 ? randString(3, '0123456789') : '') . '/marketplace';
			$path = Main\IO\Path::normalize($documentRoot . $relative);
			$directory = new Main\IO\Directory($path);

			if (!$directory->isExists())
			{
				$result = $directory;
				break;
			}

			$indexPath = $directory->getPath() . '/index.php';
			$indexFile = new Main\IO\File($indexPath);
			$indexContents = $indexFile->isExists() ? $indexFile->getContents() : '';
			$packageMarker = '@package ' . Market\Config::getModuleName();

			if (Market\Data\TextString::getPosition($indexContents, $packageMarker) !== false)
			{
				$result = $directory;
				break;
			}
		}
		while (++$repeatCount < $repeatLimit);

		if ($result === null)
		{
			throw new Main\SystemException('so many %s directories in %s. try repeat later', $rootRelative, $documentRoot);
		}

		return $result;
	}

	protected function isCrmPublicAutoupdateDisabled(Main\IO\Directory $directory)
	{
		if (!$directory->isExists()) { return false; }

		$indexPath = $directory->getPath() . '/index.php';
		$indexFile = new Main\IO\File($indexPath);

		if (!$indexFile->isExists()) { return true; }

		$indexContents = $indexFile->getContents();
		$marker = '@autoupdate ' . Market\Config::getModuleName();

		return (Market\Data\TextString::getPosition($indexContents, $marker) === false);
	}

	protected function copyCrmPublic(Main\IO\Directory $directory)
	{
		$from = Market\Config::getModulePath() . '/../install/public/crm/marketplace';
		$from = realpath($from);
		$to = $directory->getPath();

		CopyDirFiles($from, $to, true, true);
	}

	protected function configureCrmRouter($siteId, $relative)
	{
		Main\UrlRewriter::add($siteId, [
			'CONDITION' => '#^' . $relative . '/#',
			'RULE' => '',
			'ID' => '',
			'PATH' => $relative . '/index.php',
		]);
	}

	protected function addCrmMenu($siteId, $relative)
	{
		$optionName = 'left_menu_items_to_all_' . $siteId;
		$existsEncoded = (string)Main\Config\Option::get('intranet', $optionName, '', $siteId);
		$exists = $existsEncoded !== '' ? unserialize($existsEncoded, ['allowed_classes' => false]) : [];

		if (empty($exists)) { $exists = []; }

		if (!is_array($exists))
		{
			trigger_error(sprintf('cant parse crm menu, install manual menu link to %s for site %s', $relative, $siteId), E_USER_WARNING);
			return;
		}

		$matched = array_filter($exists, static function($item) { return $item['ID'] === static::MENU_ID; });

		if (!empty($matched)) { return; }

		$exists[] = [
			'TEXT' => self::getMessage('CRM_MENU_TITLE', null, Market\Config::getModuleName()),
			'LINK' => $relative,
			'ID' => static::MENU_ID,
		];

		Main\Config\Option::set('intranet', $optionName, serialize($exists), $siteId);
	}

	protected function getEventHandlers()
	{
		return array_merge(parent::getEventHandlers(), [
			[
				'module' => 'crm',
				'event' => 'onEntityDetailsTabsInitialized',
			],
		]);
	}
}
