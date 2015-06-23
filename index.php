<?php

require ('config/constants.php');
require ('features.php');

/*
 * Debugging / Development code only below
 */
$repo_names = list_all_repo_names('tominovak33');

echo "<pre>";
var_dump($repo_names);

$repo_urls = list_all_repo_html_urls('tominovak33');

var_dump($repo_urls);