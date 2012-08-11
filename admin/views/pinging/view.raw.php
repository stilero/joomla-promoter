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
    
    
    public function display($tpl = null) 
    {
            $this->pingModel =& JModel::getInstance("ping","PromoterModel");

            $projID = JRequest::getInt('project');
            if($projID == ''){
                return;
            }
            $this->assign('servers', $this->jsServerIds());	
            $this->assign('server_names', $this->jsServerNames());	
            $this->assign('project', $projID);	

            parent::display($tpl);
    }
    
    public function jsServerIds(){
        $servers = $this->pingModel->getServers();
        $serverIDs = '';
        $jsServers = '';
        foreach ($servers as $server) {
            $serverIDs[] = $server['id'];
        }
        $jsServers = '['.implode(',',$serverIDs).']';
        return $jsServers;
    }
    
    public function jsServerNames(){
        $servers = $this->pingModel->getServers();
        $serverNames = '';
        $jsServers = '';
        foreach ($servers as $server) {
            $serverNames[] = '"'.$server['title'].'"';
        }
        $jsServers = '['.implode(',',$serverNames).']';
        return $jsServers;
    }
	
}
?>