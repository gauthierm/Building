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
	// {{{ protected properties

	/**
	 * @var array
	 * @see BuildingBlockView::addCSSClassName()
	 * @see BuildingBlockView::removeCSSClassName()
	 */
	protected $css_classes = array();

	// }}}
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
	// {{{ public function setCSSClassNames()

	public function setCSSClassNames(array $class_names)
	{
		$this->css_classes = array_unique($class_names);
	}

	// }}}
	// {{{ public function addCSSClassName()

	public function addCSSClassName($class_name)
	{
		$this->css_classes = array_unique(
			array_merge(
				array($class_name),
				$this->css_classes
			)
		);
	}

	// }}}
	// {{{ public function removeCSSClassName()

	public function removeCSSClassName($class_name)
	{
		$this->css_classes = array_diff(
			$this->css_classes,
			array($class_name)
		);
	}

	// }}}
	// {{{ abstract protected function displayContent()

	abstract protected function displayContent(BuildingBlock $block);

	// }}}
	// {{{ protected function getCSSClassNames()

	protected function getCSSClassNames()
	{
		return array_unique(
			array_merge(
				array('building-block-view'),
				$this->css_classes
			)
		);
	}

	// }}}
}

?>
