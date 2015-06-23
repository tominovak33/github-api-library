<?php

require ('dev_cache.php');
require ('config/constants.php');
require ('features.php');

/*
 * Debugging / Development code only below
 */


$all_repositories = get_all_repositories('tominovak33');
//echo($all_repositories);
//die;

$result = get_recently_edited_repositories($all_repositories, '2015-05-20');

clone_repositories($result);

die;


$repo_urls = list_all_repo_html_urls('tominovak33');

var_dump($repo_urls);