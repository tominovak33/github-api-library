<?php

require ('functions.php');

function list_all_repo_names($username) {
    $repository_names = [];

    $repositories = get_all_repositories('users/'.$username.'/repos');

    foreach ($repositories as $repository) {
        $repository_names[] = get_repo_name($repository);

    }

    return $repository_names;
}

function list_all_repo_html_urls($username) {
    $repository_urls = [];

    $repositories = get_all_repositories('users/'.$username.'/repos');

    foreach ($repositories as $repository) {
        $repository_urls[] = get_repo_html_url($repository);

    }

    return $repository_urls;
}