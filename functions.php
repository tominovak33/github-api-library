<?php

function get_api_response($url) {
    $api_url = DOMAIN . $url;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $api_url);
    //curl_setopt($curl, CURLOPT_USERPWD, USER.':'.PASSWORD);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    $returned_data = curl_exec($curl);
    curl_close($curl);

    return json_decode($returned_data);
}

function get_all_repositories($username) {
    return get_api_response('users/' . $username . '/repos');
}

function get_repository($username, $repository_name) {
    return get_api_response('repos/'. $username . $repository_name);
}

function get_repo_name($repo) {
    return $repo->full_name;
}

function get_repo_html_url($repo) {
    return $repo->html_url;
}

function get_repo_api_url($repo) {
    return $repo->url;
}

function get_repo_last_edit($repo) {
    return $repo->updated_at;
}