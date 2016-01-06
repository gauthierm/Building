<?php

namespace Silverorange\Autoloader;

$package = new Package('silverorange/building');

$package->addRule(new Rule('views', 'Building', 'View'));
$package->addRule(
	new Rule(
		'dataobjects',
		'Building',
		array('Block', 'Wrapper')
	)
);
$package->addRule(new Rule('', 'Building'));

Autoloader::addPackage($package);

?>
