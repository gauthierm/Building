<?php

require_once 'Building/views/BuildingBlockView.php';
require_once 'Building/BuildingBlockViewFactory.php';

/**
 * Special view that can display any type of block
 *
 * @package   Building
 * @copyright 2014 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class BuildingBlockCompositeView extends BuildingBlockView
{
	// {{{ protected properties

	/**
	 * @var array
	 */
	protected $views = array();

	// }}}

	// display content
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

		$view = $this->getViewForBlock($block);
		$view->display($block);
	}

	// }}}
	// {{{ protected function displayContent()

	protected function displayContent(BuildingBlock $block)
	{
	}

	// }}}

	// view setters
	// {{{ public function setAttachmentView()

	public function setAttachmentView(BuildingBlockAttachmentView $view)
	{
		$this->views['building-block-attachment'] = $view;
	}

	// }}}
	// {{{ public function setAudioView()

	public function setAudioView(BuildingBlockAudioView $view)
	{
		$this->views['building-block-audio'] = $view;
	}

	// }}}
	// {{{ public function setXHTMLView()

	public function setXHTMLView(BuildingBlockXHTMLView $view)
	{
		$this->views['building-block-xhtml'] = $view;
	}

	// }}}
	// {{{ public function setImageView()

	public function setImageView(BuildingBlockImageView $view)
	{
		$this->views['building-block-image'] = $view;
	}

	// }}}
	// {{{ public function setVideoView()

	public function setVideoView(BuildingBlockVideoView $view)
	{
		$this->views['building-block-video'] = $view;
	}

	// }}}

	// view getters
	// {{{ public function getAttachmentView()

	public function getAttachmentView()
	{
		return $this->getViewForType('building-block-attachment');
	}

	// }}}
	// {{{ public function getAudioView()

	public function getAudioView()
	{
		return $this->getViewForType('building-block-audio');
	}

	// }}}
	// {{{ public function getXHTMLView()

	public function getXHTMLView()
	{
		return $this->getViewForType('building-block-xhtml');
	}

	// }}}
	// {{{ public function getImageView()

	public function getImageView()
	{
		return $this->getViewForType('building-block-image');
	}

	// }}}
	// {{{ public function getVideoView()

	public function getVideoView()
	{
		return $this->getViewForType('building-block-video');
	}

	// }}}

	// helpers
	// {{{ protected function getViewForType()

	protected function getViewForType($type)
	{
		if (!isset($this->views[$type])) {
			$this->views[$type] = $this->createCompositeViewForType($type);
		}
		return $this->views[$type];
	}

	// }}}
	// {{{ protected function getViewForBlock()

	protected function getViewForBlock(BuildingBlock $block)
	{
		return $this->getViewForType(
			BuildingBlockViewFactory::getViewType($block)
		);
	}

	// }}}
	// {{{ protected function createCompositeViewForType()

	protected function createCompositeViewForType($type)
	{
		return SiteViewFactory::get($this->app, $type);
	}
}
