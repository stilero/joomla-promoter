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

 
class PromoterViewPing  extends JView {
    
    protected $pingModel;
    protected $respCode;
    protected $respMess;
    
    const RESP_SUCCESS  = '200';
    const RESP_NOTFOUND  = '404';
    
	public function display($tpl = null) 
	{
		
                $this->pingModel = $this->getModel();

                $projID = JRequest::getInt('project');
                $serverID = JRequest::getInt('server');
                if($projID != '' && $serverID != ''){
                    $response = $this->_ping($projID, $serverID);
                    $this->_handlePingResponse($projID, $serverID, $response);
                }
		
		$this->assign('json', $this->json());	
			
		parent::display('json');
	}
	
	protected function _ping($projID, $serverID){
            $Ping = new pingClass();
            $project = $this->pingModel->getProject($projID);
            $Ping->setBlog(
                    $project['title'],
                    $project['url'],
                    $project['url']
            );
            $server = $this->pingModel->getServer($serverID);
            $Ping->addPingServer($server['url']);
            return $Ping->ping();
        }
        
        protected function _handlePingResponse($projID, $serverID, $response){
            
                $this->respCode = $response[0][0];
                $this->respMess = $response[0][1];            
            
            $this->pingModel->store($serverID, $projID, $this->respCode, $this->respMess);
            $params = & JComponentHelper::getParams('com_promoter');
            $unpubStatusesString = $params->get('status_unpublish');
            $unpubStatuses = explode(',', $unpubStatusesString);
            if(in_array($this->respCode, $unpubStatuses)){
                $isWorking = FALSE;
                $unpublish = TRUE;
                $this->pingModel->working($isWorking, $serverID, $unpublish);
            }
        }
        
        protected function json(){
            $response = array(
                'code' => $this->respCode,
                'message' => $this->respMess
            );
            
            return json_encode($response);
        }
}
?>