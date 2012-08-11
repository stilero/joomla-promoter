<?php
/**
* @version		$Id:pings.php  1 2012-08-08 08:48:37Z Stilero Webdesign $
* @package		Promoter
* @subpackage 	Tables
* @copyright	Copyright (C) 2012, Daniel Eliasson. All rights reserved.
* @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
* Jimtawl TablePings class
*
* @package		Promoter
* @subpackage	Tables
*/
class TablePings extends JTable
{
	
   /** @var int id- Primary Key  **/
   public $id = null;

   /** @var promoterprojects projects_id  **/
   public $projects_id = null;

   /** @var promoterservers servers_id  **/
   public $servers_id = null;
   
   /** @var varchar response_message  **/
   public $response_message = null;

   /** @var int unsigned response_code  **/
   public $response_code = null;

   /** @var datetime created  **/
   public $created = null;



	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	public function __construct(& $db) 
	{
		parent::__construct('#__promoter_pings', 'id', $db);
	}

	/**
	* Overloaded bind function
	*
	* @acces public
	* @param array $hash named array
	* @return null|string	null is operation was satisfactory, otherwise returns an error
	* @see JTable:bind
	* @since 1.5
	*/
	public function bind($array, $ignore = '')
	{ 
		
		return parent::bind($array, $ignore);		
	}

	/**
	 * Overloaded check method to ensure data integrity
	 *
	 * @access public
	 * @return boolean True on success
	 * @since 1.0
	 */
	public function check()
	{		
		if (!$this->created) {
			$date = JFactory::getDate();
			$this->created = $date->toFormat("%Y-%m-%d %H:%M:%S");
		}

		/** check for valid name */
		/**
		if (trim($this->response_message) == '') {
			$this->setError(JText::_('Your Pings must contain a response_message.')); 
			return false;
		}
		**/		

		return true;
	}
}
