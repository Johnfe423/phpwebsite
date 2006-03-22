<?php
  /**
   * @author Matthew McNaney <mcnaney at gmail dot com>
   * @version $Id$
   */

function users_unregister($module, &$content){
    PHPWS_Core::initModClass('users', 'Permission.php');

    $result = Users_Permission::removePermissions($module);

    if (PEAR::isError($result)) {
        $content[] = _('Permissions table not removed successfully.');        
        return FALSE;
    } elseif ($result) {
        $content[] = _('Permissions table removed successfully.');
        return TRUE;
    }
    
    return TRUE;
}


?>