<?php
/*To delete the uploaded diary entry
 * 
 */
define('include_diary_entry_class', TRUE);
include_once 'diary_entry.php';
$del_entry= new del_file();
$del_entry->delete($_GET['id']);
echo $_GET['id'];
?>
