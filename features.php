<?php

require ('functions.php');

function list_all_repo_names($username) {
    $repository_names = [];

    $repositories = get_all_repositories($username);

    foreach ($repositories as $repository) {
        $repository_names[] = get_repo_name($repository);

    }

    return $repository_names;
}

function list_all_repo_html_urls($username) {
    $repository_urls = [];

    $repositories = get_all_repositories($username);

    foreach ($repositories as $repository) {
        $repository_urls[] = get_repo_html_url($repository);

    }

    return $repository_urls;
}

function get_last_edit_of_all_repositories($username) {
    $last_edits = [];

    $repositories = get_all_repositories($username);

    foreach ($repositories as $repository) {
        $repository_details['repository_name'] = get_repo_name($repository);
        $repository_details['last_edit'] = get_repo_last_edit($repository);

        $last_edits[] = $repository_details;
    }

    return $last_edits;
}

