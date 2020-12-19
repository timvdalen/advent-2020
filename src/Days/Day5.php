<?php
namespace Advent\Days;

class Day5 extends Day {
	/**
	 * Part one of this day's solution
	 * @return string
	 */
	function part1() {
		return $this->inputByLine()->map(function ($instruction) {
			[$row, $col] = $this->findSeat($instruction);
			return $row * 8 + $col;
		})->max();
	}

	/**
	 * Part two of this day's solution
	 * @return string
	 */
	function part2() {
		$seats = $this->inputByLine()->map(function ($instruction) {
			[$row, $col] = $this->findSeat($instruction);
			return $row * 8 + $col;
		})->sort()->values()->toArray();

		for ($i = 1; $i < count($seats) - 1; $i += 1) {
			if ($seats[$i - 1] !== $seats[$i] - 1) {
				return $seats[$i] - 1;
			}
			if ($seats[$i + 1] !== $seats[$i] + 1) {
				return $seats[$i] + 1;
			}
		}
		return '(none)';
	}

	private function findSeat($instruction) {
		$maxRow = 127;
		$minRow = 0;

		$ri = substr($instruction, 0, 7);
		for ($i = 0; $i < 7; $i += 1) {
			if ($ri[$i] == 'F') {
				$maxRow = (($maxRow - $minRow + 1) / 2) - 1 + $minRow;
			} elseif ($ri[$i] == 'B') {
				$minRow = $minRow + ($maxRow - $minRow + 1) / 2;
			}
		}

		$maxCol = 7;
		$minCol = 0;
		$ci = substr($instruction, 7, 3);
		for ($i = 0; $i < 3; $i += 1) {
			if ($ci[$i] == 'L') {
				$maxCol = (($maxCol - $minCol + 1) / 2) - 1 + $minCol;
			} elseif ($ci[$i] == 'R') {
				$minCol = $minCol + ($maxCol - $minCol + 1) / 2;
			}
		}

		return [$minRow, $minCol];
	}
}
