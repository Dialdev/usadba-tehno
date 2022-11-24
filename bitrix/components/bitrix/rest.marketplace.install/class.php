<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Context;
use Bitrix\Main\Loader;
USE Bitrix\Rest\Marketplace\Client;
use Bitrix\Rest\AppTable;

Loc::loadMessages(__FILE__);

class RestMarketplaceInstallComponent extends CBitrixComponent
{
	/** @var ErrorCollection $errors */
	protected $errors;

	protected function checkRequiredParams() : bool
	{
		$this->errors = new ErrorCollection();
		if (!Loader::includeModule('rest'))
		{
			return false;
		}

		return true;
	}

	protected function listKeysSignedParameters() : array
	{
		return [
			'APP_CODE',
			'VER',
			'CHECK_HASH',
			'INSTALL_HASH',
			'IFRAME',
		];
	}

	protected function canInstall($app = null)
	{
		return CRestUtil::canInstallApplication($app);
	}

	protected function getFormData()
	{
		$result = [];
		$res = AppTable::getList(
			[
				'filter' => [
					'=CODE' => $this->arParams['APP']
				],
			]
		);
		$app = $res->fetch();

		if (
			(
				$app['ID'] > 0
				&& $app['ACTIVE'] === AppTable::ACTIVE
				&& $app['INSTALLED'] === AppTable::INSTALLED
			)
			||
			(
				$this->arParams['VER'] > 0
				&& isset($this->arParams['CHECK_HASH'], $this->arParams['INSTALL_HASH'])
			)
		)
		{
			$appExternal = Client::getApp(
				$this->arParams['APP_CODE'],
				$this->arParams['VER'],
				$this->arParams['CHECK_HASH'],
				$this->arParams['INSTALL_HASH']
			);
		}
		else
		{
			$appExternal = Client::getAppPublic(
				$this->arParams['APP_CODE'],
				$this->arParams['VER'],
				$this->arParams['CHECK_HASH'],
				$this->arParams['INSTALL_HASH']
			);
		}

		if ($appExternal)
		{
			$appData = $appExternal['ITEMS'];

			if ($app)
			{
				$appData['ID'] = $app['ID'];
				$appData['INSTALLED'] = $app['INSTALLED'];
				$appData['ACTIVE'] = $app['ACTIVE'];
				$appData['STATUS'] = $app['STATUS'];
				$appData['DATE_FINISH'] = $app['DATE_FINISH'];
				$appData['IS_TRIALED'] = $app['IS_TRIALED'];
			}

			$result['APP'] = $appData;
		}

		if (!$this->canInstall($result['APP']))
		{
			ShowError(Loc::getMessage('REST_MP_INSTALL_ACCESS_DENIED'));
			return false;
		}

		$scopeList = CRestUtil::getScopeList();
		Loc::loadMessages($_SERVER['DOCUMENT_ROOT'].BX_ROOT.'/modules/rest/scope.php');
		$result['SCOPE_DENIED'] = [];
		if (is_array($result['APP']['RIGHTS']))
		{
			foreach ($result['APP']['RIGHTS'] as $key => $scope)
			{
				$result['APP']['RIGHTS'][$key] = [
					'TITLE' => Loc::getMessage('REST_SCOPE_'.mb_strtoupper($key)) ?: $scope,
					'DESCRIPTION' => Loc::getMessage('REST_SCOPE_'.mb_strtoupper($key).'_DESCRIPTION')
				];
				if (!in_array($key, $scopeList, true))
				{
					$result['SCOPE_DENIED'][$key] = 1;
				}
			}
		}

		if (
			Loader::IncludeModule('bitrix24')
			&& !in_array(\CBitrix24::getLicensePrefix(), array('ru', 'ua', 'kz', 'by'))
		)
		{
			$result['TERMS_OF_SERVICE_LINK'] = Loc::getMessage('REST_MARKETPLACE_TERMS_OF_SERVICE_LINK');
		}

		$result['IS_HTTPS'] = Context::getCurrent()->getRequest()->isHttps();

		return $result;
	}

	protected function prepareResult() : bool
	{
		$result = $this->getFormData();
		if (!$result)
		{
			return false;
		}

		$this->arResult = $result;
		return true;
	}

	protected function printErrors() : void
	{
		foreach ($this->errors as $error)
		{
			ShowError($error);
		}
	}

	public function executeComponent()
	{
		if (!$this->checkRequiredParams())
		{
			$this->printErrors();
			return;
		}

		if (!$this->prepareResult())
		{
			$this->printErrors();
			return;
		}

		$this->includeComponentTemplate();
	}
}