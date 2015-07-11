<?php

require ('dev_cache.php');
require ('config/constants.php');
require ('features.php');

//$api_response = get_all_org_repositories('org-name-here');
$api_response = get_all_repositories('tominovak33');

$combined_response = combine_responses($api_response);

write_clone_urls_to_file($combined_response);
