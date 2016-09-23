<?php

require_once 'SwatDB/SwatDBDataObject.php';
require_once 'Site/dataobjects/SiteAttachment.php';
require_once 'Site/dataobjects/SiteImage.php';
require_once 'Site/dataobjects/SiteMedia.php';

/**
 * Base object for CMS
 *
 * @package   Building
 * @copyright 2014-2016 silverorange
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class BuildingBlock extends SwatDBDataObject
{
	// {{{ public properties

	/**
	 * @var integer
	 */
	public $id;

	/**
	 * @var string
	 */
	public $bodytext;

	/**
	 * @var integer
	 */
	public $displayorder;

	/**
	 * @var SwatDate
	 */
	public $createdate;

	/**
	 * @var SwatDate
	 */
	public $modified_date;

	// }}}
	// {{{ protected function init()

	protected function init()
	{
		parent::init();

		$this->table = 'Block';

		$this->registerDateProperty('createdate');
		$this->registerDateProperty('modified_date');

		$this->registerInternalProperty(
			'attachment',
			SwatDBClassMap::get('SiteAttachment')
		);

		$this->registerInternalProperty(
			'image',
			SwatDBClassMap::get('SiteImage')
		);

		$this->registerInternalProperty(
			'media',
			SwatDBClassMap::get('SiteMedia')
		);

		$this->id_field = 'integer:id';
	}

	// }}}
}

?>
