<?php
/**
* @version		$Id:pings.php 1 2012-08-08 08:48:37Z Stilero Webdesign $
* @package		Promoter
* @subpackage 	Tables
* @copyright	Copyright (C) 2012, Daniel Eliasson. All rights reserved.
* @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');
require_once JPATH_COMPONENT_ADMINISTRATOR.DS.'lib'.DS.'pingClass.php';

 
class PromoterViewPinging  extends JView {
    
    protected $pingModel;
    protected $respCode;
    protected $respMess;
    
    const RESP_SUCCESS  = '200';
    const RESP_NOTFOUND  = '404';
    
	public function display($tpl = null) 
	{
                $this->pingModel = $this->getModel();

                $projID = JRequest::getInt('project');
                if($projID == ''){
                    return;
                }
		$servers = $this->pingModel->getServers();
		$this->assign('servers', $servers);	
			
		parent::display($tpl);
	}
	
}
?>