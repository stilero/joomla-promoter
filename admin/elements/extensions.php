<?php
defined('_JEXEC') or die;

require_once (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_promoter'.DS.'helpers'.DS.'promoter.php' );

class JElementExtensions extends JElement
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	var	$_name = 'Extensions';

	function fetchElement($name, $value, &$node, $control_name)
	{
	
		$extensions = PromoterHelper::getExtensions();
		$options = array();
		foreach ($extensions as $extension) {   
		
			$option = new stdClass();
			$option->text = JText::_(ucfirst((string) $extension->name));
			$option->value = (string) $extension->name;
			$options[] = $option;
			
		}		
		
		return JHTML::_('select.genericlist', $options, ''.$control_name.'['.$name.']', 'class="inputbox"', 'value', 'text', $value, $control_name.$name );
	}
}