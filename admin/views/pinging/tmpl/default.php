<?php
/**
* @version  1.0
* @author Daniel Eliasson - joomla at stilero.com
* @copyright  (C) 2012-jul-10 Stilero Webdesign http://www.stilero.com
* @category Views Templates
* @license    GPLv2
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
define('PROMO_ASSETS_PATH',  JURI::root().'administrator/components/com_promoter/assets/js');
//define('PROMO_ASSETS_PATH',  JURI::root().'/administrator/components/com_promoter/assets/js');
?>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/mootools/1.4.5/mootools-yui-compressed.js" type="text/javascript"></script>
        <script type="text/javascript">
                var servers = <?php echo $this->servers; ?>;
                var serverNames = <?php echo $this->server_names; ?>;
                var project = <?php echo $this->project; ?>;
        </script>
        <script src="<?php echo PROMO_ASSETS_PATH.'/pinger.js' ?>" type="text/javascript"></script>
    </head>
    <body bgcolor="#FFFFFF">
        <div id="output"></div>
    </body>
</html>
