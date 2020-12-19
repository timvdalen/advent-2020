<?php

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\GuzzleException;

if(!function_exists('get_input')) {
	/**
	 * Gets the input for a given day
	 * @param $day int
	 * @return string
	 * @throws GuzzleException
	 */
	function get_input($day) {
		$jar = CookieJar::fromArray(['session' => env('AOC_COOKIE')],'.adventofcode.com');
		$client = new Client();
		$resp = $client->request('GET', "https://adventofcode.com/2020/day/$day/input", [
			'cookies' => $jar
		]);
		return (string)$resp->getBody();
	}
}
