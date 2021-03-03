<?php

// This class for call any function from football-data.org's RESTful API.

//author Rangga Wisnu Aji Marditha <ranggajack99@gmail.com>
//date create 02.03.2021 

class GetFootball
{

    public $config;
    public $baseUri;
    public $reqPrefs = array();

    public function __construct()
    {
        $this->config = parse_ini_file('config.ini', true);

        if ($this->config['authToken'] == 'YOUR_AUTH_TOKEN' || !isset($this->config['authToken'])) {
            exit('Get your API-Key first and edit config.ini');
        }

        $this->baseUri = $this->config['baseUri'];

        $this->reqPrefs['http']['method'] = 'GET';
        $this->reqPrefs['http']['header'] = 'X-Auth-Token: ' . $this->config['authToken'];
    }

    public function findCompetitionById($id)
    {
        $resource = 'competitions/' . $id;
        $response = file_get_contents(
            $this->baseUri . $resource,
            false,
            stream_context_create($this->reqPrefs)
        );

        return json_decode($response);
    }

    public function showAllCompetition()
    {
        $resource = 'competitions';
        $response = file_get_contents(
            $this->baseUri . $resource,
            false,
            stream_context_create($this->reqPrefs)
        );

        return json_decode($response);
    }


    public function findStandingsByCompetition($id)
    {
        $resource = 'competitions/' . $id . '/standings';
        $response = file_get_contents(
            $this->baseUri . $resource,
            false,
            stream_context_create($this->reqPrefs)
        );

        return json_decode($response);
    }


    public function findTeamById($id)
    {
        $resource = 'teams/' . $id;
        $response = file_get_contents(
            $this->baseUri . $resource,
            false,
            stream_context_create($this->reqPrefs)
        );

        return json_decode($response);
    }

    public function searchTeam($keyword)
    {
        $resource = 'teams/?name=' . $keyword;
        $response = file_get_contents(
            $this->baseUri . $resource,
            false,
            stream_context_create($this->reqPrefs)
        );

        return json_decode($response);
    }
}
