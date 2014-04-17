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

	// build phase
	// {{{ protected function buildNavBar()

	protected function buildNavBar()
	{
		parent::buildNavBar();

		$this->navbar->popEntry();

		if ($this->isNew()) {
			$this->navbar->createEntry(Building::_('New Text Content'));
		} else {
			$this->navbar->createEntry(Building::_('Edit Text Content'));
		}
	}

	// }}}
}

?>
