  <?php
 defined('_JEXEC') or die('Restricted access');
/**
* @version		$Id:servers.php  1 2012-08-08 08:48:37Z Stilero Webdesign $
* @package		Promoter
* @subpackage 	Models
* @copyright	Copyright (C) 2012, Daniel Eliasson. All rights reserved.
* @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/
 defined('_JEXEC') or die('Restricted access');
/**
 * PromoterModelServers 
 * @author Daniel Eliasson
 */
 
 
class PromoterModelServers  extends PromoterModel { 

	
	
	protected $_default_filter = 'a.title';   

/**
 * Constructor
 */
	
	public function __construct()
	{
		parent::__construct();

	}

	/**
	* Method to build the query
	*
	* @access private
	* @return string query	
	*/

	protected function _buildQuery()
	{
		return parent::_buildQuery();
	}
	
	/**
	 * Method to store the Item
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	public function store($data)
	{
		$row =& $this->getTable();
		/**
		 * Example: get text from editor 
		 * $Text  = JRequest::getVar( 'text', '', 'post', 'string', JREQUEST_ALLOWRAW );
		 */
		 
		// Bind the form fields to the table
		if (!$row->bind($data)) {
			$this->setError($row->getError());
			return false;
		}

		// Make sure the table is valid
		if (!$row->check()) {
			$this->setError($row->getError());
			return false;
		}
		
		/**
		 * Clean text for xhtml transitional compliance
		 * $row->text		= str_replace( '<br>', '<br />', $Text );
		 */
	
		// Store the table to the database
		if (!$row->store()) {
			$this->setError($row->getError());
			return false;
		}
		$this->setId($row->{$row->getKeyName()});
		return $row->{$row->getKeyName()};
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
		$filter_state = $app ->getUserStateFromRequest($context . 'filter_state', 'filter_state', '', 'word');		
		$filter_order = $app ->getUserStateFromRequest($context . 'filter_order', 'filter_order', $this->getDefaultFilter(), 'cmd');
		$filter_order_Dir = $app ->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', 'desc', 'word');
		$search = $app ->getUserStateFromRequest($context . 'search', 'search', '', 'string');
					
		if ($search) {
			$this->_query->where('LOWER(a.title) LIKE ' . $this->_db->Quote('%' . $search . '%'));			
		}		
		if ($filter_state) {
			if ($filter_state == 'P') {
				$this->_query->where("a.published = 1");
			} elseif ($filter_state == 'U') {
					$this->_query->where("a.published = 0");
			} else {
				$this->_query->where("a.published > -2");
			}
		}		
	}
	
}
?>