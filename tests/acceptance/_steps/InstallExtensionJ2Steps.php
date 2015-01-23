<?php
/**
 * @package     redCORE
 * @subpackage  Step Class
 * @copyright   Copyright (C) 2008 - 2015 redCOMPONENT.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace AcceptanceTester;
/**
 * Class InstallExtensionJ2Steps
 *
 * @package  AcceptanceTester
 *
 * @since    1.4
 *
 * @link     http://codeception.com/docs/07-AdvancedUsage#StepObjects
 */
class InstallExtensionJ2Steps extends \AcceptanceTester
{
	/**
	 * Function to Install redCORE, inside Joomla 2.5
	 *
	 * @return void
	 */
	public function installExtension()
	{
		$I = $this;
		$this->acceptanceTester = $I;
		$I->amOnPage(\ExtensionManagerPage::$URL);
		$config = $I->getConfig();
		$I->wantTo('Install redCORE framework before installing the extension');
		$I->fillField(\ExtensionManagerPage::$extensionDirectoryPath, $config['folder']);
		$I->click(\ExtensionManagerPage::$installButton);
		$I->waitForText('Installing component was successful.');
		$I->waitForText(\ExtensionManagerPage::$installSuccessMessage, 60);
	}

	/**
	 * Function to Install Demo Data for the Extension
	 *
	 * @return void
	 */
	public function installSampleData()
	{
		$I = $this;
		$I->click(\ExtensionManagerPage::$installDemoContent);
		$I->waitForText(\ExtensionManagerPage::$demoDataInstallSuccessMessage, 30);
	}
}