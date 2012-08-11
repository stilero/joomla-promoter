  <?php
 defined('_JEXEC') or die('Restricted access');
/**
* @version		$Id:pings.php  1 2012-08-08 08:48:37Z Stilero Webdesign $
* @package		Promoter
* @subpackage 	Models
* @copyright	Copyright (C) 2012, Daniel Eliasson. All rights reserved.
* @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/
 defined('_JEXEC') or die('Restricted access');
/**
 * PromoterModelPings 
 * @author Daniel Eliasson
 */
 
 
class PromoterModelPing  extends JModel { 
    
    protected $_db;
    protected $_serverTable;
    protected $_projectTable;
    protected $_pingTable;
    
/**
 * Constructor
 */
	
	public function __construct()
	{
		parent::__construct();
                $this->_db = & JFactory::getDBO();
                $this->_serverTable = $this->_db->nameQuote('#__promoter_servers');
                $this->_projectTable = $this->_db->nameQuote('#__promoter_projects');
                $this->_pingTable = $this->_db->nameQuote('#__promoter_pings');
                

	}

        public function getServers(){
                $colPublished = $this->_db->nameQuote('published');
                $query = 'SELECT *'.
                        ' FROM '.$this->_serverTable.
                        ' WHERE '.$colPublished.' = 1';
                $this->_db->setQuery( $query);
                return $this->_db->loadAssocList();
        }
        
        public function getProject($id){
            if(!isset($id)){
                return;
            }
            $colId = $this->_db->nameQuote('id');
            $valId = $this->_db->Quote($id);
            $query = 'SELECT *'.
                    ' FROM '.$this->_projectTable.
                    ' WHERE '.$colId.' = '.$valId;
            $this->_db->setQuery( $query);
            return $this->_db->loadAssoc();
        }
        
        public function getServer($id){
            if(!isset($id)){
                return;
            }
            $colId = $this->_db->nameQuote('id');
            $valId = $this->_db->Quote($id);
            $query = 'SELECT *'.
                    ' FROM '.$this->_serverTable.
                    ' WHERE '.$colId.' = '.$valId;
            $this->_db->setQuery( $query);
            return $this->_db->loadAssoc();
        }
	
        
        
	/**
	 * Method to store the Item
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	public function store($servID, $projID, $respCode='404', $respMess='Not found')
	{
            $colID = $this->_db->nameQuote('id');
            $colServID = $this->_db->nameQuote('servers_id');
            $colProjID = $this->_db->nameQuote('projects_id');
            $colRespCode = $this->_db->nameQuote('response_code');
            $colRespMess = $this->_db->nameQuote('response_message');
            $colCreated = $this->_db->nameQuote('created');
            
            $valServID = $this->_db->Quote($servID);
            $valProjID = $this->_db->Quote($projID);
            $valRespCode = $this->_db->Quote($respCode);
            $valRespMess = $this->_db->Quote($respMess);
            $date =& JFactory::getDate();
            $valCreated = $this->_db->Quote($date->toFormat());
            
            $db = & JFactory::getDBO();     
            $query = 'INSERT INTO '.$this->_pingTable.' ( '.
                    $colID.', '.
                    $colServID.', '.
                    $colProjID.', '.
                    $colRespCode.', '.
                    $colCreated.', '.
                    $colRespMess.
                    ' ) VALUES ( '.
                    'NULL, '.
                    $valServID.', '.
                    $valProjID.', '.
                    $valRespCode.', '.
                    $valCreated.', '.
                    $valRespMess.
                    ' )';
            $db->setQuery( $query);
            $db->query();
	
        }	
        
        public function working($isWorking, $serverID, $unpublish = false){
            $colID = $this->_db->nameQuote('id');
            $colWorking = $this->_db->nameQuote('working');
            $colPublish = $this->_db->nameQuote('published');
            
            $valServID = $this->_db->Quote($serverID);
            $isWorking = $isWorking ? '1' : '0';
            $valWorking = $this->_db->Quote($isWorking);
            $publish = $unpublish ? '0' : '1';
            $valPublish = $this->_db->Quote($publish);
            
            $db = & JFactory::getDBO();     
            $query = 'UPDATE '.$this->_serverTable.
                    ' SET '.
                    $colWorking.' = '.$valWorking.', '.
                    $colPublish.' = '.$valPublish.
                    ' WHERE '.$colID.' = '.$valServID;
            $db->setQuery( $query);
            $db->query();
        }

	/**
	* Method to build the Order Clause
	*
	* @access private
	* @return string orderby	
	*/
	
	protected function _buildContentOrderBy() 
	{
		$app = &JFactory::getApplication('');
		$context			= $this->option.'.'.strtolower($this->getName()).'.list.';
		$filter_order = $app ->getUserStateFromRequest($context . 'filter_order', 'filter_order', $this->getDefaultFilter(), 'cmd');
		$filter_order_Dir = $app ->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', '', 'word');
		$this->_query->order($filter_order . ' ' . $filter_order_Dir );
	}
	
	/**
	* Method to build the Where Clause 
	*
	* @access private
	* @return string orderby	
	*/
	
	protected function _buildContentWhere() 
	{
		
		$app = &JFactory::getApplication('');
		$context			= $this->option.'.'.strtolower($this->getName()).'.list.';
		
		$filter_order = $app ->getUserStateFromRequest($context . 'filter_order', 'filter_order', $this->getDefaultFilter(), 'cmd');
		$filter_order_Dir = $app ->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', 'desc', 'word');
		$search = $app ->getUserStateFromRequest($context . 'search', 'search', '', 'string');
					
		if ($search) {
			$this->_query->where('LOWER(a.response_message) LIKE ' . $this->_db->Quote('%' . $search . '%'));			
		}
		
	}
	
}
?>