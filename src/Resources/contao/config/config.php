<?php

/**
 * Bright Cloud Studio's OCES Navigation
 * Copyright (C) 2025 Bright Cloud Studio
 * @package    bright-cloud-studio/oces-navigation
 * @link       https://www.brightcloudstudio.com/
**/

$GLOBALS['TL_LANG']['MOD']['oces-navigation'][0] = "Navigation Options";

$GLOBALS['BE_MOD']['oces-navigation']['navigation_option'] = array(
	'tables' => array('tl_navigation_option'),
	'icon'   => 'system/modules/oces_navigation/assets/icons/page_tag_navigation.png',
	'exportLocations' => array('Bcs\Backend\NavigationOptionBackend', 'exportNavigationOptions')
);

/* Front end modules */
$GLOBALS['FE_MOD']['oces-navigation']['navigation_option_module'] 		= 'Bcs\Module\NavigationOptionModule';

/* Models */
$GLOBALS['TL_MODELS']['tl_navigation_option'] = 'Bcs\Model\NavigationOption';
