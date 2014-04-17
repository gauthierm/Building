<?php

require_once 'Building/views/BuildingBlockCompositeView.php';
require_once 'Swat/SwatToolLink.php';

/**
 * Block view that adds admin action links
 *
 * @package   Building
 * @copyright 2014 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class BuildingBlockAdminCompositeView extends BuildingBlockCompositeView
{
	// {{{ protected properties

	/**
	 * @var SwatToolLink
	 */
	protected $edit_link;

	/**
	 * @var SwatToolLink
	 */
	protected $delete_link;

	// }}}
	// {{{ public function __construct()

	public function __construct(SiteApplication $app)
	{
		parent::__construct($app);

		$this->edit_link = new SwatToolLink();
		$this->edit_link->setFromStock('edit');
		$this->edit_link->title = Building::_('Edit');
		$this->edit_link->classes[] = 'building-block-edit-link';

		$this->delete_link = new SwatToolLink();
		$this->delete_link->setFromStock('delete');
		$this->delete_link->title = Building::_('Delete');
		$this->delete_link->classes[] = 'building-block-delete-link';
	}

	// }}}
	// {{{ public function display()

	public function display($block)
	{
		ob_start();
		parent::display($block);
		$composite_view = ob_get_clean();

		if ($composite_view != '') {
			echo '<div class="building-block-admin-view">';
			echo $composite_view;
			$this->displayLinks($block);
			echo '</div>';
		}
	}

	// }}}
	// {{{ protected function define()

	protected function define()
	{
		$this->definePart('edit');
		$this->definePart('delete');
	}

	// }}}
	// {{{ protected function displayLinks()

	protected function displayLinks(BuildingBlock $block)
	{
		$parts = array();

		ob_start();
		$this->displayEditLink($block);
		$link = ob_get_clean();
		if ($link != '') {
			$parts[] = $link;
		}

		ob_start();
		$this->displayDeleteLink($block);
		$link = ob_get_clean();
		if ($link != '') {
			$parts[] = $link;
		}

		if (count($parts) > 0) {
			$span = new SwatHtmlTag('span');
			$span->class = 'building-block-admin-links';
			$span->open();

			foreach ($parts as $part) {
				echo $part;
			}

			$span->close();
		}
	}

	// }}}
	// {{{ protected function displayEditLink()

	protected function displayEditLink(BuildingBlock $block)
	{
		if ($this->getMode('edit') > SiteView::MODE_NONE) {
			$link = $this->getLink('edit');

			if ($link === false) {
				$this->edit_link->sensitive = false;
			} else {
				if ($link === true) {
					$type = BuildingBlockViewFactory::getViewType($block);
					switch ($type) {
					case 'building-block-audio':
						$link = sprintf('Block/EditAudio?id=%s', $block->id);
						break;

					case 'building-block-video':
						$link = sprintf('Block/EditVideo?id=%s', $block->id);
						break;

					case 'building-block-image':
						$link = sprintf('Block/EditImage?id=%s', $block->id);
						break;

					case 'building-block-attachment':
						$link = sprintf(
							'Block/EditAttachment?id=%s',
							$block->id
						);
						break;

					case 'building-block-xhtml':
					default:
						$link = sprintf('Block/EditXHTML?id=%s', $block->id);
						break;
					}
				}
				$this->edit_link->link = $link;
				$this->edit_link->sensitive = true;
			}

			$this->edit_link->display();
		}
	}

	// }}}
	// {{{ protected function displayDeleteLink()

	protected function displayDeleteLink(BuildingBlock $block)
	{
		if ($this->getMode('delete') > SiteView::MODE_NONE) {
			$link = $this->getLink('delete');

			if ($link === false) {
				$this->delete_link->sensitive = false;
			} else {
				if ($link === true) {
					$link = sprintf('Block/Delete?id=%s', $block->id);
				}
				$this->delete_link->link = $link;
				$this->delete_link->sensitive = true;
			}

			$this->delete_link->display();
		}
	}

	// }}}
}

?>
