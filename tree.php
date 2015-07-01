<?php
define('REG_DIR', plugin_dir_path(__FILE__));
define('REG_URL', plugin_dir_url(__FILE__));

require_once(REG_DIR."/class/parser.php");
require_once(REG_DIR."/functions.php");

$par_id = get_all_parent_id();
echo "<div id='okved'></div>";
foreach($par_id as $id){
    echo get_tree($id);
}