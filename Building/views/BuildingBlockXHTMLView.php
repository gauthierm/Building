<?php

require_once 'Building/views/BuildingBlockView.php';

/**
 * @package   Building
 * @copyright 2014 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class BuildingBlockXHTMLView extends BuildingBlockView
{
	// {{{ protected function define()

	protected function define()
	{
		$this->definePart('body');
	}

	// }}}
	// {{{ protected function displayContent()

	protected function displayContent(BuildingBlock $block)
	{
		$this->displayBody($block);
	}

	// }}}
	// {{{ protected function displayBody()

	protected function displayBody(BuildingBlock $block)
	{
		if ($this->getMode('body') > SiteView::MODE_NONE &&
			$block->bodytext != '') {

			$div = new SwatHtmlTag('div');
			$div->class = 'building-block-bodytext';
			$div->setContent($block->bodytext, 'text/xml');
			$div->display();
		}
	}

	// }}}
	// {{{ protected function getCSSClassNames()

	protected function getCSSClassNames()
	{
		return array_merge(
			parent::getCSSClassNames(),
			array('building-block-xhtml-view')
		);
	}

	// }}}
}

?>
