<?php

require_once 'Building/dataobjects/BuildingBlock.php';

/**
 * @package   Building
 * @copyright 2014 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
abstract class BuildingBlockView
{
	public function display($block)
	{
		if (!$block instanceof BuildingBlock) {
			throw new InvalidArgumentException(
				'BuildingBlockView can only display BuildingBlocks.'
			);
		}
	}
}

?>
