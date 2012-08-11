<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

  JToolBarHelper::title( JText::_( 'Pings' ), 'generic.png' );
  JToolBarHelper::publishList();
  JToolBarHelper::unpublishList();
  JToolBarHelper::deleteList();
  JToolBarHelper::editListX();
  JToolBarHelper::addNewX();
  JToolBarHelper::preferences('com_promoter', '550');  
?>

<form action="index.php?option=com_promoter&amp;view=pings" method="post" name="adminForm">
	<table>
		<tr>
			<td align="left" width="100%">
				<?php echo JText::_( 'Filter' ); ?>:
				<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
				<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
				<button onclick="document.getElementById('search').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
			</td>
			<td nowrap="nowrap">
  				
			</td>
		</tr>		
	</table>
<div id="editcell">
	<table class="adminlist">
		<thead>
			<tr>
				<th width="5">
					<?php echo JText::_( 'NUM' ); ?>
				</th>
				<th width="20">				
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
				</th>			
                                <th class="title" width="20">
					<?php echo JHTML::_('grid.sort', 'Id', 'a.id', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>
                                <th class="title">
					<?php echo JHTML::_('grid.sort', 'Server Name', 'b.title', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>
				<th class="title" width="40">
					<?php echo JHTML::_('grid.sort', 'Response Code', 'a.response_code', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>								
				<th class="title">
					<?php echo JHTML::_('grid.sort', 'Response Message', 'a.response_message', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>								
                                <th class="title">
					<?php echo JHTML::_('grid.sort', 'Created', 'a.created', $this->lists['order_Dir'], $this->lists['order'] ); ?>
				</th>												
			</tr>
		</thead>
		<tfoot>
		<tr>
			<td colspan="12">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>
	<tbody>
<?php
  $k = 0;
  if (count( $this->items ) > 0 ):
  
  for ($i=0, $n=count( $this->items ); $i < $n; $i++):
  
  	$row = &$this->items[$i];
 	$onclick = "";
  	
    if (JRequest::getVar('function', null)) {
    	$onclick= "onclick=\"window.parent.jSelectPings_id('".$row->id."', '".$this->escape($row->response_message)."', '','id')\" ";
    }  	
    
 	$link = JRoute::_( 'index.php?option=com_promoter&view=pings&task=edit&cid[]='. $row->id );
 	$row->id = $row->id; 	
 	$checked = JHTML::_('grid.id', $i, $row->id); 	
  	//$published = JHTML::_('grid.published', $row, $i ); 	
 	
  ?>
	<tr class="<?php echo "row$k"; ?>">
		
		<td align="center"><?php echo $this->pagination->getRowOffset($i); ?>.</td>
        
        <td><?php echo $checked  ?></td>	
        <td><?php echo $row->id ?></td>		
        <td>
            <a <?php echo $onclick; ?>href="<?php echo $link; ?>"><?php echo $row->title; ?></a>
        </td>
        <td>
            <a <?php echo $onclick; ?>href="<?php echo $link; ?>"><?php echo $row->response_code; ?></a>
        </td>
        <td>
            <a <?php echo $onclick; ?>href="<?php echo $link; ?>"><?php echo $row->response_message; ?></a>
        </td>
        <td><?php echo $row->created ?></td>
	</tr>
<?php
  $k = 1 - $k;
  endfor;
  else:
  ?>
	<tr>
		<td colspan="12">
			<?php echo JText::_( 'There are no items present' ); ?>
		</td>
	</tr>
	<?php
  endif;
  ?>
</tbody>
</table>
</div>
<input type="hidden" name="option" value="com_promoter" />
<input type="hidden" name="task" value="pings" />
<input type="hidden" name="view" value="pings" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>  	