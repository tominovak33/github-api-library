<?php

require ('functions.php');

function list_all_repo_names($repositories) {
    $repository_names = [];

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
        $repository_details['last_edit'] = get_repo_last_update($repository);

        $last_edits[] = $repository_details;
    }

    return $last_edits;
}

/*
 * Format the date limit in valid timestamp format
 */
function get_recently_edited_repositories($all_repositories, $date_limit) {

    $recently_edited_repositories = [];
    $date_limit = strtotime($date_limit);

    foreach ($all_repositories as $repository) {
        $repo_last_update = get_repo_last_update($repository, true);

        if ($repo_last_update > $date_limit ){
            $recently_edited_repositories[] = $repository;
        }
    }

    return $recently_edited_repositories;

}

function clone_repository($repository) {
    $repository_name = get_repo_name($repository);
    $repository_url = get_repo_html_url($repository);
    $timestamp = standard_timestamp();
    $backup_folder_path = './backups/'.$timestamp.'/'.$repository_name.'/';
    create_backup_folder($backup_folder_path);
    $command = "git clone " . $repository_url . ' ' . $backup_folder_path;
    $backup = shell_exec($command);
    echo "<pre>$backup</pre>";
}


function create_backup_folder ($full_folder_name) {

    if (!mkdir($full_folder_name, 0777, true)) {
        return('Failed to create folders');
    }
    return true;

}

function clone_repositories($repository_list) {
    foreach ($repository_list as $repository) {
        clone_repository($repository);
    }
}