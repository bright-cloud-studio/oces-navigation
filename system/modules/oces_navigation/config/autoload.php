<?php

/**
 * Bright Cloud Studio's Page Tag Navigation
 *
 * Copyright (C) 2022 Bright Cloud Studio
 *
 * @package    bright-cloud-studio/page-tag-navigation
 * @link       https://www.brightcloudstudio.com/
 * @license    http://opensource.org/licenses/lgpl-3.0.html
**/


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'Bcs\Model\NavigationOption' 					=> 'system/modules/oces_navigation/library/Bcs/Model/NavigationOption.php',
	'Bcs\Backend\NavigationOptionBackend' 			=> 'system/modules/oces_navigation/library/Bcs/Backend/NavigationOptionBackend.php',
	'Bcs\Module\NavigationOptionModule' 			=> 'system/modules/oces_navigation/library/Bcs/Module/NavigationOptionModule.php'
));

/* Register the templates */
TemplateLoader::addFiles(array
(
	'mod_oces_navigation' 				=> 'system/modules/oces_navigation/templates/modules',
	'item_dropdown_parent' 				=> 'system/modules/oces_navigation/templates/items',
	'item_dropdown_child' 				=> 'system/modules/oces_navigation/templates/items',
));
