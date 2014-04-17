<?php

require_once 'Building/admin/components/Block/Edit.php';

/**
 * @package   Building
 * @copyright 2014 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class BuildingBlockEditXHTML extends BuildingBlockEdit
{
	// {{{ protected function getUiXml()

	protected function getUiXml()
	{
		return 'Building/admin/components/Block/edit-xhtml.xml';
	}

	// }}}
	// {{{ protected function getObjectUiValueNames()

	protected function getObjectUiValueNames()
	{
		return array('bodytext');
	}

	// }}}
}

?>
