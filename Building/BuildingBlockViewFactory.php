<?php

require_once 'Site/dataobjects/SiteAudioMedia.php';
require_once 'Site/dataobjects/SiteVideoMedia.php';
require_once 'Site/dataobjects/SiteImage.php';
require_once 'Site/dataobjects/SiteAttachment.php';
require_once 'Site/SiteViewFactory.php';
require_once 'Building/Building.php';
require_once 'Building/dataobjects/BuildingBlock.php';

/**
 * Factory for creating block views
 *
 * @package   Building
 * @copyright 2014-2016 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class BuildingBlockViewFactory
{
	// {{{ public static function getBlockView()

	/**
	 * @param SiteApplication $app   the application in which to get the view.
	 * @param BuildingBlock   $block the block for which to get the view. The
	 *                               block determines the view type that is
	 *                               returned.
	 *
	 * @return BuildingBlockView a block view instance for displaying blocks
	 *                           of the specified type.
	 *
	 * @see SwatViewFactory::get()
	 * @see BuildingBlockViewFactory::getViewType()
	 */
	public static function getBlockView(SiteApplication $app,
		BuildingBlock $block)
	{
		return SiteViewFactory::get($app, self::getViewType($block));
	}

	// }}}
	// {{{ public static function getViewType()

	/**
	 * Gets the view type for a block
	 *
	 * @param BuildingBlock $block the block for which to get the view type.
	 *
	 * @return string the view type for the block.
	 */
	public static function getViewType(BuildingBlock $block)
	{
		$type = 'building-block-xhtml';

		if ($block->media instanceof SiteAudioMedia) {
			$type = 'building-block-audio';
		} elseif ($block->media instanceof SiteVideoMedia) {
			$type = 'building-block-video';
		} elseif ($block->image instanceof SiteImage) {
			$type = 'building-block-image';
		} elseif ($block->attachment instanceof SiteAttachment) {
			$type = 'building-block-attachment';
		}

		return $type;
	}

	// }}}
}

?>
