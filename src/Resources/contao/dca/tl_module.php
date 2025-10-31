<?php

/**
 * Bright Cloud Studio's OCES Navigation
 * Copyright (C) 2023 Bright Cloud Studio
 * @package    bright-cloud-studio/oces-navigation
 * @link       https://www.brightcloudstudio.com/
**/

/* Add a palette to tl_module */
$GLOBALS['TL_DCA']['tl_module']['palettes']['page_tag_navigation_module'] 				= '{title_legend},name,headline,type;{template_legend:hide},customTpl;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['page_tag_navigation_target_module'] 		= '{title_legend},name,headline,type;{template_legend:hide},customTpl;{expert_legend:hide},guests,cssID,space';
