<?php

require_once 'Site/dataobjects/SiteVideoMedia.php';
require_once 'Site/SiteJwPlayerMediaDisplay.php';
require_once 'Building/views/BuildingBlockMediaView.php';

/**
 * @package   Building
 * @copyright 2014 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class BuildingBlockVideoView extends BuildingBlockMediaView
{
	// {{{ protected function define()

	protected function define()
	{
		$this->definePart('video');
		$this->definePart('title');
		$this->definePart('description');
	}

	// }}}
	// {{{ protected function displayContent()

	protected function displayContent(BuildingBlock $block)
	{
		if (!$block->media instanceof SiteVideoMedia) {
			throw new InvalidArgumentException(
				sprintf(
					'The view %s can only display blocks with videos.',
					get_class($this)
				)
			);
		}

		$this->displayVideo($block);
		$this->displayDetails($block);
	}

	// }}}
	// {{{ protected function displayDetails()

	protected function displayDetails(BuildingBlock $block)
	{
		$parts = array();

		ob_start();
		$this->displayTitle($block);
		$title = ob_get_clean();
		if ($title != '') {
			$parts[] = $title;
		}

		ob_start();
		$this->displayDescription($block);
		$description = ob_get_clean();
		if ($description != '') {
			$parts[] = $description;
		}

		if (count($parts) > 0) {
			$span = new SwatHtmlTag('span');
			$span->class = 'building-block-video-details';
			$span->open();

			foreach ($parts as $part) {
				echo $part;
			}

			$span->close();
		}
	}

	// }}}
	// {{{ protected function displayVideo()

	protected function displayVideo(BuildingBlock $block)
	{
		if ($this->getMode('video') > SiteView::MODE_NONE) {
			if (!$this->media_player instanceof SiteJwPlayerMediaDisplay) {
				throw new Exception(
					'Media player needs to be set on view before video '.
					'can be displayed. See '.
					'BuildingBlockVideoView::setMediaPlayer().'
				);
			}

			$this->media_player->id = sprintf(
				'building_block_%s_video_%s',
				$block->id,
				$block->media->id
			);


			if (!in_array('building-block-video-player', $this->media_player->classes)) {
				$this->media_player->classes[] = 'building-block-video-player';
			}

			$this->media_player->setMedia($block->media);
			$this->media_player->display();
		}
	}

	// }}}
	// {{{ protected function displayTitle()

	protected function displayTitle(BuildingBlock $block)
	{
		$title = $block->media->getTitle();
		if ($this->getMode('title') > SiteView::MODE_NONE && $title != '') {
			$span = new SwatHtmlTag('span');
			$span->class = 'building-block-video-title';
			$span->setContent($title);
			$span->display();
		}
	}

	// }}}
	// {{{ protected function displayDescription()

	protected function displayDescription(BuildingBlock $block)
	{
		if ($this->getMode('description') > SiteView::MODE_NONE &&
			$block->media->description != '') {
			$span = new SwatHtmlTag('span');
			$span->class = 'building-block-video-description';
			$span->setContent($block->media->description, 'text/xml');
			$span->display();
		}
	}

	// }}}
	// {{{ protected function getCSSClassNames()

	protected function getCSSClassNames()
	{
		return array_merge(
			parent::getCSSClassNames(),
			array('building-block-video-view')
		);
	}

	// }}}
}

?>
