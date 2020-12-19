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
		$cache_key = __DIR__ . "/../cache/$day";
		if (file_exists($cache_key)) {
			return file_get_contents($cache_key);
		}

		$jar = CookieJar::fromArray(['session' => env('AOC_COOKIE')],'.adventofcode.com');
		$client = new Client();
		$resp = $client->request('GET', "https://adventofcode.com/2020/day/$day/input", [
			'cookies' => $jar
		]);
		$input = (string)$resp->getBody();
		file_put_contents($cache_key, $input);
		return $input;
	}
}
