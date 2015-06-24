<?php

require ('dev_cache.php');
require ('config/constants.php');
require ('features.php');

/*
 * Debugging / Development code only below
 */


$api_response = get_all_org_repositories('whiteoctober');

$next = get_next_api_page_url($api_response['headers']);
echo "<pre>";
var_dump($next);
die;
$all_repositories = $api_response['body'];



$names = list_all_repo_names($all_repositories);
//echo "<pre>";
//var_dump($names);
die;

//$result = get_recently_edited_repositories($all_repositories, '2015-05-20');


die;


$repo_urls = list_all_repo_html_urls('tominovak33');

var_dump($repo_urls);