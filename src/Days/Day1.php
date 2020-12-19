<?php
namespace Advent\Days;

class Day1 extends Day {
	/**
	 * Part one of this day's solution
	 * @return string
	 */
	function part1() {
		$numbers = $this->inputByLine()->map(function ($n) {
			return intval($n);
		});

		$numbers->each(function ($n) use ($numbers, &$results) {
			if ($results) {
				return;
			}
			$numbers->each(function ($m) use ($n, &$results) {
				if ($m + $n === 2020) {
					$results = [$m, $n];
					return;
				}
			});
		});

		return $results[0] * $results[1];
	}

	/**
	 * Part two of this day's solution
	 * @return string
	 */
	function part2() {
		$numbers = $this->inputByLine()->map(function ($n) {
			return intval($n);
		});

		$numbers->each(function ($n) use ($numbers, &$results) {
			if ($results) {
				return;
			}
			$numbers->each(function ($m) use ($n, $numbers, &$results) {
				if ($results) {
					return;
				}
				$numbers->each(function ($l) use ($n, $m, &$results) {
					if ($m + $n + $l === 2020) {
						$results = [$m, $n, $l];
						return;
					}
				});
			});
		});

		return $results[0] * $results[1] * $results[2];
	}
}
