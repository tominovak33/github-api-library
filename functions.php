<?php

function get_api_response($url) {
    $api_url = DOMAIN . $url;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $api_url);
    curl_setopt($curl, CURLOPT_USERPWD, USER.':'.PASSWORD);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($curl, CURLOPT_VERBOSE, 1);
    curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, GITHUB_USERAGENT);
    $returned_data = curl_exec($curl);
    curl_close($curl);

    list($header, $body) = explode("\r\n\r\n", $returned_data, 2);

    $response = [];
    $response['headers'] = $header;
    $response['body'] = json_decode($body);

    return $response;
}

function get_all_repositories($username) {
    /*
     * Dev only todo: remove this
     */
    //return json_decode(ALL_REPOSITORIES);
    /*
     * End Dev
     */
    return get_api_response('users/' . $username . '/repos');
}

function get_repository($username, $repository_name) {
    return get_api_response('repos/'. $username . $repository_name);
}

function get_all_org_repositories($organisation) {
    return get_api_response('orgs/' . $organisation . '/repos?&per_page=100&page=1');
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

function get_repo_ssh_clone_url($repo) {
    return $repo->ssh_url;
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

/**
 * @param $current_headers
 * @param string $rel
 * @return mixed
 *
 * Get the links that github return in the headers, by default get the next one or set the second param to 'last' to get the previous one
 */
function get_api_header_link_url($current_headers, $rel='next') {
    //Get all headers into an array
    $headers = explode("\n", $current_headers);

    //Loop through all headers
    foreach ($headers as $header ) {
        //Explode headers on the first ':' so we get the name and the value. EG: "Host: api.github.com"
        list($header_name, $header_value) = explode(':', $header, 2);

        //Get the header where the name is link
        if ($header_name == 'Link') {
            //Get the 2 links (next and last)
            $links = explode(',', $header_value);
            //Loop through those links
            foreach ($links as $link) {
                //Split the links on the first ';' so we get the link value and the relation to the current page (next, last)
                list($location, $link_rel) = explode( ';' , $link, 2);
                    //If the relation is the one specified then return it
                    if (strpos($link_rel, $rel) !== false) {
                        $location = trim($location, ' '); //todo clean this up later
                        $location = trim($location, '>');
                        $location = trim($location, '<');
                        return $location;
                    }
            }
        }
    }

    return false;
}
