<?php
namespace Advent\Days;

class Day2 extends Day {

	/**
	 * Part one of this day's solution
	 * @return string
	 */
	function part1() {
		$parsed = $this->inputByLine()->map(function ($row) {
			$split = explode(":", $row);
			[$policy, $char] = explode(" ", $split[0]);
			[$min, $max] = explode("-", $policy);
			$password = trim($split[1]);

			return [
				'min' => $min,
				'max' => $max,
				'char' => $char,
				'password' => $password
			];
		});

		return $parsed->filter(function ($password) {
			$count = substr_count($password['password'], $password['char']);
			return $count >= $password['min'] && $count <= $password['max'];
		})->count();
	}

	/**
	 * Part two of this day's solution
	 * @return string
	 */
	function part2() {
		$parsed = $this->inputByLine()->map(function ($row) {
			$split = explode(":", $row);
			[$policy, $char] = explode(" ", $split[0]);
			[$min, $max] = explode("-", $policy);
			$password = trim($split[1]);

			return [
				'min' => $min,
				'max' => $max,
				'char' => $char,
				'password' => $password
			];
		});

		return $parsed->filter(function ($password) {
			$first = substr($password['password'], $password['min'] - 1, 1);
			$second = substr($password['password'], $password['max'] - 1, 1);

			return $first === $password['char'] xor $second === $password['char'];
		})->count();
	}
}