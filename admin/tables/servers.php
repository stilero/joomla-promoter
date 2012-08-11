<?php
/**
* @version		$Id:servers.php  1 2012-08-08 08:48:37Z Stilero Webdesign $
* @package		Promoter
* @subpackage 	Tables
* @copyright	Copyright (C) 2012, Daniel Eliasson. All rights reserved.
* @license #http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
* Jimtawl TableServers class
*
* @package		Promoter
* @subpackage	Tables
*/
class TableServers extends JTable
{
	
   /** @var int id- Primary Key  **/
   public $id = null;

   /** @var varchar title  **/
   public $title = null;

   /** @var tinyint unsigned published  **/
   public $published = null;

   /** @var datetime created  **/
   public $created = null;

   /** @var varchar url  **/
   public $url = null;

   /** @var datetime last_response  **/
   public $last_response = null;

   /** @var tinyint working  **/
   public $working = null;

   /** @var tinyint extended_ping  **/
   public $extended_ping = null;




	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 * @since 1.0
	 */
	public function __construct(& $db) 
	{
		parent::__construct('#__promoter_servers', 'id', $db);
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
		if (trim($this->title) == '') {
			$this->setError(JText::_('Your Servers must contain a title.')); 
			return false;
		}
		**/		

		return true;
	}
}
