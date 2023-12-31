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

 
namespace Bcs\Backend;

use Contao\DataContainer;
use Bcs\Model\NavigationOption;

class NavigationOptionBackend extends \Backend
{

	public function getItemTemplates()
	{
		return $this->getTemplateGroup('item_dropdown_child');
	}
	
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
      if (strlen(\Input::get('tid')))
      {
        $this->toggleVisibility(\Input::get('tid'), (\Input::get('state') == 1), (@func_get_arg(12) ?: null));
        $this->redirect($this->getReferer());
      }

      $href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

      if (!$row['published'])
      {
        $icon = 'invisible.gif';
      }

      return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.\Image::getHtml($icon, $label).'</a> ';
    }	
	

    public function toggleVisibility($intId, $blnVisible, DataContainer $dc=null)
    {
      // Trigger the save_callback
      if (is_array($GLOBALS['TL_DCA']['tl_navigation_option']['fields']['published']['save_callback']))
      {
        foreach ($GLOBALS['TL_DCA']['tl_navigation_option']['fields']['published']['save_callback'] as $callback)
        {
          if (is_array($callback))
          {
            $this->import($callback[0]);
            $blnVisible = $this->$callback[0]->$callback[1]($blnVisible, ($dc ?: $this));
          }
          elseif (is_callable($callback))
          {
            $blnVisible = $callback($blnVisible, ($dc ?: $this));
          }
        }
      }

		// Update the database
		$this->Database->prepare("UPDATE tl_navigation_option SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->log('A new version of record "tl_navigation_option.id='.$intId.'" has been created'.$this->getParentEntries('tl_navigation_option', $intId), __METHOD__, TL_GENERAL);
	}
	
	public function exportNavigationOptions()
	{
		$objLocation = Location::findAll();
		$strDelimiter = ',';
	
		if ($objLocation) {
			$strFilename = "locations_" .(date('Y-m-d_Hi')) ."csv";
			$tmpFile = fopen('php://memory', 'w');
			
			$count = 0;
			while($objLocation->next()) {
				$row = $objLocation->row();
				if ($count == 0) {
					$arrColumns = array();
					foreach ($row as $key => $value) {
						$arrColumns[] = $key;
					}
					fputcsv($tmpFile, $arrColumns, $strDelimiter);
				}
				$count ++;
				fputcsv($tmpFile, $row, $strDelimiter);
			}
			
			fseek($tmpFile, 0);
			
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment; filename="' . $strFilename . '";');
			fpassthru($tmpFile);
			exit();
		} else {
			return "Nothing to export";
		}
	}
	
	public function generateAlias($varValue, DataContainer $dc)
	{
		$autoAlias = false;
		
		// Generate an alias if there is none
		if ($varValue == '')
		{
			$autoAlias = true;
			$varValue = standardize(\StringUtil::restoreBasicEntities($dc->activeRecord->name));
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_child_category WHERE id=? OR alias=?")
								   ->execute($dc->id, $varValue);

		// Check whether the page alias exists
		if ($objAlias->numRows > 1)
		{
			if (!$autoAlias)
			{
				throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
			}

			$varValue .= '-' . $dc->id;
		}

		return $varValue;
	}
	
	
	public function getParentCategories() { 
		$cats = array();
		$this->import('Database');
		$result = $this->Database->prepare("SELECT * FROM tl_parent_category WHERE published=1")->execute();
		while($result->next())
		{
			$cats = $cats + array($result->id => $result->label);
		}
        
		return $cats;
	}
	
	public function getChildCategories(DataContainer $dc) { 
		$cats = array();
		
		// add a blank option to if you dont want anything
		$cats = $cats + array('' => 'Unlink Selections');
		
		$this->import('Database');
		$result = $this->Database->prepare("SELECT * FROM tl_child_category WHERE published=1")->execute();
		while($result->next())
		{
			// check all other pages, if this option is taken dont show it
			$exists = false;
			$result2 = $this->Database->prepare("SELECT * FROM tl_page WHERE published=1")->execute();
			while($result2->next())
			{
				if($result2->page_tag_navigation_target == $result->id && $result2->id != $dc->id)
					$exists = true;
			}
			if($exists != true)
				$cats = $cats + array($result->id => $result->label);
		}

		return $cats;
	}
	
}
