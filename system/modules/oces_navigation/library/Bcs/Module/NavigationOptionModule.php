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

  
namespace Bcs\Module;
 
use Bcs\Model\NavigationOption;
use Contao\PageModel;
 
class NavigationOptionModule extends \Contao\Module
{
 
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_oces_navigation';
 
	protected $arrStates = array();
 
	/**
	 * Initialize the object
	 *
	 * @param \ModuleModel $objModule
	 * @param string       $strColumn
	 */
	public function __construct($objModule, $strColumn='main')
	{
		parent::__construct($objModule, $strColumn);
		//$this->arrStates = Locations::getStates();
	}
	
    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new \BackendTemplate('be_wildcard');
 
            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['navigation_option'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&table=tl_module&act=edit&id=' . $this->id;
 
            return $objTemplate->parse();
        }
 
        return parent::generate();
    }

    /**
     * Generate the module
     */
    protected function compile()
    {
        // Add our custom js file
        $GLOBALS['TL_BODY'][] = '<script src="system/modules/oces_navigation/assets/js/mod_oces_navigation.js"></script>';


        
        // Sort our Listings based on the 'last_name' field
        $options = [
            'order' => 'id ASC'
        ];
        // Get all of the navigation options
        $objNavigationOptions = NavigationOption::findBy('published', '1', $options);

        // Store our options here
        $arrSelectOptions = array();

        $entry_id = 0;

        foreach ($objNavigationOptions as $option)
		{
		    $arrOption = array();
            // Set values for template
            
            $arrOption['id']                   = $entry_id;
            $arrOption['label']                = $option->label;

            $objPage = PageModel::findByPk($objRedirect->target_page);
            if ($objPage) {
                $arrOption['target_page'] = $objPage->getFrontendUrl();
            }
            
            
            $arrOption['target_anchor']        = $option->target_anchor;

            // Generate as "List"
            $strListTemplate = ($this->entry_customItemTpl != '' ? $this->entry_customItemTpl : 'item_select_option');
            $objListTemplate = new \FrontendTemplate($strListTemplate);
            $objListTemplate->setData($arrOption);
            $arrSelectOptions[$entry_id] = $objListTemplate->parse();

            
            $entry_id++;
		}

        $this->Template->select_options = $arrSelectOptions;





        

	}

} 
