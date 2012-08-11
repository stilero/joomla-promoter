<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

  JToolBarHelper::title( JText::_( 'Ping' ), 'generic.png' ); 
?>
<h2>Ping</h2> 
<p>code: <?php echo $this->response_code; ?></p>
<p>Message: <?php echo $this->response_message; ?></p>