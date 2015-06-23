<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 23/06/15
 * Time: 20:21
 */

require ('config/constants.php');
require ('features.php');

$all_repositories = get_all_repositories('tominovak33');
$recently_edited = get_recently_edited_repositories($all_repositories, '2015-05-20');

clone_repositories($recently_edited);