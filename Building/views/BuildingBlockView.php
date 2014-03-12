<?php

require_once 'Swat/SwatHtmlTag.php';
require_once 'Site/views/SiteView.php';
require_once 'Building/dataobjects/BuildingBlock.php';

/**
 * @package   Building
 * @copyright 2014 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
abstract class BuildingBlockView extends SiteView
{
	// {{{ public function display()

	public function display($block)
	{
		if (!$block instanceof BuildingBlock) {
			throw new InvalidArgumentException(
				sprintf(
					'The view %s can only display BuildingBlock objects.',
					get_class($this)
				)
			);
		}

		$container = new SwatHtmlTag('div');
		$container->id = 'block_'.$block->id;
		$container->class = implode(' ', $this->getCSSClassNames());
		$container->open();

		$this->displayContent($block);

		$container->close();
	}

	// }}}
	// {{{ abstract protected function displayContent()

	abstract protected function displayContent(BuildingBlock $block);

	// }}}
	// {{{ protected function getCSSClassNames()

	protected function getCSSClassNames()
	{
		return array('building-block-view');
	}

	// }}}
}

?>
