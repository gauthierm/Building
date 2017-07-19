<?php

require_once 'Building/views/BuildingBlockView.php';

/**
 * @package   Building
 * @copyright 2014-2016 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class BuildingBlockXHTMLView extends BuildingBlockView
{
	// {{{ protected properties

	/**
	 * @var integer
	 *
	 * @see BuildingBlockXHTMLView::setBodySummaryLength()
	 */
	protected $body_summary_length = 100;

	// }}}
	// {{{ public function setBodySummaryLength()

	public function setBodySummaryLength($length)
	{
		$this->body_summary_length = (integer)$length;
	}

	// }}}
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
		if ($block->bodytext != '') {
			if ($this->getMode('body') === SiteView::MODE_ALL) {
				$div = new SwatHtmlTag('div');
				$div->class = 'building-block-bodytext';
				$div->setContent($block->bodytext, 'text/xml');
				$div->display();
			} elseif ($this->getMode('body') === SiteView::MODE_SUMMARY) {
				$bodytext = SwatString::condense(
					$block->bodytext,
					$this->body_summary_length
				);
				$div = new SwatHtmlTag('div');
				$div->class = 'building-block-bodytext';
				$div->setContent($bodytext, 'text/xml');
				$div->display();
			}
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
