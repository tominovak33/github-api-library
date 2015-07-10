<?php

require ('dev_cache.php');
require ('config/constants.php');
require ('features.php');

//$api_response = get_all_org_repositories('org-name-here');
$api_response = get_all_repositories('tominovak33');

$all_repositories = $api_response['body'];

$clone_urls = get_repository_clone_urls($all_repositories);
write_commands_to_file($clone_urls); //then run this file from the command line (maybe set up a cron? )

echo "<pre>";
var_dump($clone_urls);
