<?php

/**
 * @package   Building
 * @copyright 2016 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class BuildingBlockVideoEdit extends BuildingBlockEdit
{
	// {{{ protected properties

	/**
	 * @var SiteVideoMedia
	 */
	protected $media;

	// }}}
	// {{{ protected function getUiXml()

	protected function getUiXml()
	{
		return 'Building/admin/components/Block/video-edit.xml';
	}

	// }}}
	// {{{ protected function getMedia()

	protected function getMedia()
	{
		if (!$this->media instanceof SiteVideoMedia) {
			if ($this->getObject()->media instanceof SiteVideoMedia) {
				$this->media = $this->getObject()->media;
			} else {
				$media_id = $this->app->initVar('media');
				if ($media_id === null) {
					$form = $this->ui->getWidget('edit_form');
					$media_id = $form->getHiddenField('media');
				}

				$class_name = SwatDBClassMap::get('SiteVideoMedia');
				$this->media = new $class_name();
				$this->media->setDatabase($this->app->db);
				if (!$this->media->load($media_id)) {
					throw new AdminNotFoundException(
						sprintf(
							'Media with id “%s” not found.',
							$media_id
						)
					);
				}
			}
		}

		return $this->media;
	}

	// }}}

	// init phase
	// {{{ protected function initObject()

	protected function initObject()
	{
		parent::initObject();

		$block = $this->getObject();
		if (!$this->isNew() && !$block->media instanceof SiteVideoMedia) {
			throw new AdminNotFoundException(
				'Can only edit video content.'
			);
		}
	}

	// }}}

	// process phase
	// {{{ protected function updateObject()

	protected function updateObject()
	{
		parent::updateObject();

		$media = $this->getMedia();
		$this->getObject()->media = $media->id;

		$this->assignUiValuesToObject(
			$this->getObject()->media,
			array(
				'title',
				'description'
			)
		);
	}

	// }}}
	// {{{ protected function saveObject()

	protected function saveObject()
	{
		parent::saveObject();

		$this->getObject()->media->save();
	}

	// }}}

	// build phase
	// {{{ protected function buildInternal()

	protected function buildInternal()
	{
		parent::buildInternal();

		$media = $this->getMedia();
		$media->setFileBase('media');

		$this->ui->getWidget('edit_form')->addHiddenField('media', $media->id);

		$player = $media->getMediaPlayer($this->app);
		ob_start();
		$player->display();
		$this->ui->getWidget('player')->content = ob_get_clean();
		$this->layout->addHtmlHeadEntrySet($player->getHtmlHeadEntrySet());
	}

	// }}}
	// {{{ protected function loadObject()

	protected function loadObject()
	{
		parent::loadObject();

		$this->assignObjectValuesToUi(
			$this->getObject()->media,
			array(
				'title',
				'description'
			)
		);
	}

	// }}}
	// {{{ protected function buildNavBar()

	protected function buildNavBar()
	{
		parent::buildNavBar();

		$this->navbar->popEntry();

		if ($this->isNew()) {
			$this->navbar->createEntry(Building::_('New Video Content'));
		} else {
			$this->navbar->createEntry(Building::_('Edit Video Content'));
		}
	}

	// }}}
}

?>
