<?php

function get_api_response($url) {
    $api_url = DOMAIN . $url;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $api_url);
    //curl_setopt($curl, CURLOPT_USERPWD, USER.':'.PASSWORD);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, GITHUB_USERAGENT);
    $returned_data = curl_exec($curl);
    curl_close($curl);

    return json_decode($returned_data);
}

function get_all_repositories($username) {
    /*
     * Dev only todo: remove this
     */
    return json_decode(ALL_REPOSITORIES);
    /*
     * End Dev
     */
    return get_api_response('users/' . $username . '/repos');
}

function get_repository($username, $repository_name) {
    return get_api_response('repos/'. $username . $repository_name);
}

function get_repo_name($repo) {
    return $repo->full_name;
}

function get_repo_short_name($repo) {
    return $repo->name;
}

function get_repo_html_url($repo) {
    return $repo->html_url;
}

function get_repo_api_url($repo) {
    return $repo->url;
}

function get_repo_last_update($repo, $unix_timestamp = false) {

    if ($unix_timestamp) {
        return strtotime($repo->pushed_at);
    }

    return $repo->pushed_at;
}

/*
 * Easy way to make sure that all my timestamps are the same format and if I ever need to change that format it can be quickly done in one place
 */
function standard_timestamp ($timestamp = false) {
    if ($timestamp) {
        return  date("Y-m-d" ,strtotime($timestamp));
    }
    return date("Y-m-d");
}