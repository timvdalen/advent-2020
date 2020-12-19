<?php
namespace Advent\Days;

class Day3 extends Day {
	/**
	 * Part one of this day's solution
	 * @return string
	 */
	function part1() {
		$map = explode("\n", $this->getInput());

		$trees_encountered = 0;
		$x = 0;

		for ($i = 1; $i < count($map); $i += 1) {
			// For every line, move three to the right and check if we collide with a tree
			$x += 3;
			if ($map[$i][$x % strlen($map[$i])] == '#') {
				$trees_encountered += 1;
			}
		}
		return $trees_encountered;
	}

	/**
	 * Part two of this day's solution
	 * @return string
	 */
	function part2() {
		return collect([
			[1, 1],
			[3, 1],
			[5, 1],
			[7, 1],
			[1, 2]
		])->map(function ($c) {
			return $this->trees_encountered($c[0], $c[1]);
		})->reduce(function ($acc, $curr) {
			return $acc * $curr;
		}, 1);
	}

	private function trees_encountered($x_movement = 1, $y_movement = 1) {
		$map = explode("\n", $this->getInput());

		$trees_encountered = 0;
		$x = 0;

		for ($i = $y_movement; $i < count($map); $i += $y_movement) {
			// For every $y_movement, move three to the right and check if we collide with a tree
			$x += $x_movement;
			if ($map[$i][$x % strlen($map[$i])] == '#') {
				$trees_encountered += 1;
			}
		}
		return $trees_encountered;
	}
}