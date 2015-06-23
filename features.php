<?php

require ('functions.php');

function list_all_repo_names($username) {
    $repository_names = [];

    $returned_data = get_api_response('users/'.$username.'/repos');

    foreach ($returned_data as $repository) {
        $repository_names[] = get_repo_name($repository);

    }

    return $repository_names;
}

function list_all_repo_html_urls($username) {
    $repository_urls = [];

    $returned_data = get_api_response('users/'.$username.'/repos');

    foreach ($returned_data as $repository) {
        $repository_urls[] = get_repo_html_url($repository);

    }

    return $repository_urls;
}