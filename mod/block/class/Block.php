<?php

/**
 * Command class for block
 *
 * @author Matthew McNaney <matt at tux dot appstate dot edu>
 * @version $Id$
 */

PHPWS_Core::initModClass('block', 'Block_Item.php');

class Block {

    function show()
    {
        $key = Key::getCurrent();
        if (empty($key)) {
            return;
        }
        Block::showBlocks($key);

        if (isset($_SESSION['Clipped_Blocks'])) {
            Block::viewClippedBlocks($key);
        }
  
    }

    function viewClippedBlocks($key)
    {
        if (!isset($_SESSION['Clipped_Blocks'])) {
            return FALSE;
        }

        $block_list = &$_SESSION['Clipped_Blocks'];
        if (empty($block_list)) {
            return NULL;
        }

        foreach ($block_list as $block_id => $block) {
            if (isset($GLOBALS['Current_Blocks'][$block_id])) {
                continue;
            }

            $block->setPinKey($key);
            $content[] = $block->view(TRUE);
        }

        if (empty($content)) {
            return;
        }

        $complete = implode('', $content);
        Layout::add($complete, 'block', 'Block_List');
    }

    function showBlocks($key)
    {
        $key->setTable('block_pinned');
        $key->setColumnName('block_id');
        $result = $key->getMatches();

        if (empty($result)) {
            return;
        }

        foreach ($result as $block_id) {
            $block = & new Block_Item($block_id);
            $block->setPinKey($key);
            Layout::add($block->view(), 'block', $block->getContentVar());
            $GLOBALS['Current_Blocks'][$block_id] = TRUE;
        }

    }

}

?>