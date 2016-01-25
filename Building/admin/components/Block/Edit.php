<?php

require_once 'Admin/pages/AdminObjectEdit.php';
require_once 'Building/dataobjects/BuildingBlock.php';

/**
 * @package   Building
 * @copyright 2014-2016 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
abstract class BuildingBlockEdit extends AdminObjectEdit
{
	// {{{ protected function getObjectClass()

	protected function getObjectClass()
	{
		return 'BuildingBlock';
	}

	// }}}

	// process phase
	// {{{ protected function getSavedMessagePrimaryContent()

	protected function getSavedMessagePrimaryContent()
	{
		return Building::_('Content has been saved.');
	}

	// }}}
}

?>
