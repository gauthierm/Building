<?php

require_once 'Admin/pages/AdminOrder.php';

/**
 * @package   Building
 * @copyright 2014 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
abstract class BuildingBlockOrder extends AdminOrder
{
	// process phase
	// {{{ protected function saveIndex()

	protected function saveIndex($id, $index)
	{
		SwatDB::updateColumn(
			$this->app->db,
			'Block',
			'integer:displayorder',
			$index,
			'integer:id',
			array($id)
		);
	}

	// }}}

	// build phase
	// {{{ abstract protected function getBlocks()

	abstract protected function getBlocks();

	// }}}
	// {{{ protected function loadData()

	protected function loadData()
	{
		$blocks = $this->getBlocks();

		$order_widget = $this->ui->getWidget('order');
		$view = $this->getView();
		foreach ($blocks as $block) {
			ob_start();
			$view->display($block);
			$order_widget->addOption($block->id, ob_get_clean(), 'text/xml');
		}

		// auto ordering doesn't make sense for blocks
		$options_list = $this->ui->getWidget('options');
		$options_list->visible = false;
		$options_list->value = 'custom';
	}

	// }}}
	// {{{ protected function getView()

	protected function getView()
	{
		$view = SiteViewFactory::get($this->app, 'building-block');

		// configure views for display in list
		$view->getImageView()->setImageDimensionShortname('thumb');
		$view->getXHTMLView()->setPartMode('body', SiteView::MODE_SUMMARY);

		// don't link attachments
		$view->getAttachmentView()->setPartMode(
			'content',
			SiteView::MODE_ALL,
			false
		);

		return $view;
	}

	// }}}
}

?>
