<?php
namespace Advent\Days;

class Day4 extends Day {
	const REQUIRED_FIELDS = [
		'byr',
		'iyr',
		'eyr',
		'hgt',
		'hcl',
		'ecl',
		'pid'
	];

	/**
	 * Part one of this day's solution
	 * @return string
	 */
	function part1() {
		$passports = collect(explode("\n\n", $this->getInput()))->map(function ($group) {
			return str_replace("\n", " ", $group);
		})->map(function ($passport) {
			return collect(explode(" ", $passport))->reduce(function ($acc, $field) {
				$parsed = explode(":", $field);
				$acc[$parsed[0]] = $parsed[1];
				return $acc;
			}, []);
		});

		$valid = $passports->filter(function ($passport) {
			$fields = array_keys($passport);
			return array_intersect(self::REQUIRED_FIELDS, $fields) === self::REQUIRED_FIELDS;
		});

		return $valid->count();
	}

	/**
	 * Part two of this day's solution
	 * @return string
	 */
	function part2() {
		$passports = collect(explode("\n\n", $this->getInput()))->map(function ($group) {
			return str_replace("\n", " ", $group);
		})->map(function ($passport) {
			return collect(explode(" ", $passport))->reduce(function ($acc, $field) {
				$parsed = explode(":", $field);
				$acc[$parsed[0]] = $parsed[1];
				return $acc;
			}, []);
		});

		$valid = $passports->filter(function ($passport) {
			$fields = array_keys($passport);
			return array_intersect(self::REQUIRED_FIELDS, $fields) === self::REQUIRED_FIELDS;
		})->filter(function ($passport) {
			$validByr = function ($val) {
				return strlen($val) === 4 && $val >= 1920 && $val <= 2002;
			};
			$validIyr = function ($val) {
				return strlen($val) === 4 && $val >= 2010 && $val <= 2020;
			};
			$validEyr = function ($val) {
				return strlen($val) === 4 && $val >= 2020 && $val <= 2030;
			};
			$validHgt = function ($val) {
				$unit = substr($val, -2);
				$amt = substr($val, 0, -2);
				if ($unit == 'cm') {
					return $amt >= 150 && $amt <= 193;
				}
				if ($unit == 'in') {
					return $amt >= 59 && $amt <= 76;
				}

				return false;
			};
			$validHcl = function ($val) {
				return preg_match("/^#[a-f0-9]{6}$/", $val);
			};
			$validEcl = function ($val) {
				return in_array($val, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth']);
			};
			$validPid = function ($val) {
				return preg_match("/^[0-9]{9}$/", $val);
			};

			return $validByr($passport['byr'])
				&& $validIyr($passport['iyr'])
				&& $validEyr($passport['eyr'])
				&& $validHgt($passport['hgt'])
				&& $validHcl($passport['hcl'])
				&& $validEcl($passport['ecl'])
				&& $validPid($passport['pid']);
		});

		return $valid->count();
	}
}