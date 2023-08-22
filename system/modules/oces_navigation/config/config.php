<?php

/**
 * Bright Cloud Studio's OCES Navigation
 *
 * Copyright (C) 2023 Bright Cloud Studio
 *
 * @package    bright-cloud-studio/oces-navigation
 * @link       https://www.brightcloudstudio.com/
 * @license    http://opensource.org/licenses/lgpl-3.0.html
**/

$GLOBALS['TL_LANG']['MOD']['oces-navigation'][0] = "Navigation Options";

$GLOBALS['BE_MOD']['oces-navigation']['navigation_option'] = array(
	'tables' => array('tl_navigation_option'),
	'icon'   => 'system/modules/oces_navigation/assets/icons/page_tag_navigation.png',
	'exportLocations' => array('Bcs\Backend\NavigationOptionBackend', 'exportNavigationOptions')
);

/* Front end modules */
$GLOBALS['FE_MOD']['oces-navigation']['page_tag_navigation_module'] 		= 'Bcs\Module\PageTagNavigationModule';
$GLOBALS['FE_MOD']['oces-navigation']['page_tag_navigation_target_module'] 	= 'Bcs\Module\PageTagNavigationTargetModule';

/* Models */
$GLOBALS['TL_MODELS']['tl_navigation_option'] = 'Bcs\Model\NavigationOption';

