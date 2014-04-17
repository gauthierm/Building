<?php

require_once 'Site/dataobjects/SiteImageSet.php';
require_once 'Building/admin/components/Block/Edit.php';

/**
 * @package   Building
 * @copyright 2014 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class BuildingBlockEditImage extends BuildingBlockEdit
{
	// {{{ protected properties

	/**
	 * @var SiteImageSet
	 */
	protected $image_set;

	// }}}
	// {{{ protected function getUiXml()

	protected function getUiXml()
	{
		return 'Building/admin/components/Block/edit-image.xml';
	}

	// }}}
	// {{{ protected function getImageSetShortname()

	protected function getImageSetShortname()
	{
		return 'block';
	}

	// }}}
	// {{{ protected function getImageSet()

	protected function getImageSet()
	{
		if (!$this->image_set instanceof SiteImageSet) {
			if ($this->getObject()->image instanceof SiteImage) {
				$this->image_set = $this->getObject()->image->image_set;
			} else {
				$class_name = SwatDBClassMap::get('SiteImageSet');
				$this->image_set = new $class_name();
				$this->image_set->setDatabase($this->app->db);
				$shortname = $this->getImageSetShortname();
				if (!$this->image_set->loadByShortname($shortname)) {
					throw new AdminNotFoundException(
						sprintf(
							'Image set with shortname “%s” not found.',
							$shortname
						)
					);
				}
			}
		}

		return $this->image_set;
	}

	// }}}
	// {{{ protected function getNewImageInstance()

	protected function getNewImageInstance()
	{
		$class_name = SwatDBClassMap::get('SiteImage');
		$image = new $class_name();
		$image->setDatabase($this->app->db);
		$image->image_set = $this->getImageSet();
		return $image;
	}

	// }}}

	// init phase
	// {{{ protected function initInternal()

	protected function initInternal()
	{
		parent::initInternal();

		if ($this->isNew()) {
			$this->ui->getWidget('image_upload')->required = true;
		}
	}

	// }}}
	// {{{ protected function initObject()

	protected function initObject()
	{
		parent::initObject();

		$block = $this->getObject();
		if (!$this->isNew() && !$block->image instanceof SiteImage) {
			throw new AdminNotFoundException(
				'Can only edit image content.'
			);
		}
	}

	// }}}

	// process phase
	// {{{ protected function updateObject()

	protected function updateObject()
	{
		parent::updateObject();

		$this->processImage();

		if ($this->getObject()->image instanceof SiteImage) {
			$this->assignUiValuesToObject(
				$this->getObject()->image,
				array(
					'title',
					'description'
				)
			);
		}
	}

	// }}}
	// {{{ protected function processImage()

	protected function processImage()
	{
		$upload = $this->ui->getWidget('image_upload');
		if ($upload->isUploaded()) {
			$block = $this->getObject();

			$image = $this->getNewImageInstance();
			$image->setFileBase('../images');
			$image->process($upload->getTempFileName());

			// Delete the old image. Prevents broswer/CDN caching.
			if (!$this->isNew()) {
				$block->image->setFileBase('../images');
				$block->image->delete();
			}

			$block->image = $image;
		}
	}

	// }}}
	// {{{ protected function saveObject()

	protected function saveObject()
	{
		parent::saveObject();

		if ($this->getObject()->image instanceof SiteImage) {
			$this->getObject()->image->save();
		}
	}

	// }}}

	// build phase
	// {{{ protected function loadObject()

	protected function loadObject()
	{
		parent::loadObject();

		$image = $this->block->image;
		$preview = $this->ui->getWidget('image_preview');

		$preview->visible = true;
		$preview->image = $image->getUri('thumb', '../');
		$preview->width = $image->getWidth('thumb');
		$preview->height = $image->getHeight('thumb');
		$preview->preview_image = $image->getUri('original', '../');
		$preview->preview_width = $image->getWidth('original');
		$preview->preview_height = $image->getHeight('original');
	}

	// }}}
}

?>
