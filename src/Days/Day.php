<?php
namespace Advent\Days;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

abstract class Day {
	/** @var int */
	protected $dayNumber;

	/**
	 * Day constructor.
	 */
	public function __construct() {
		$this->dayNumber = intval(substr(get_class($this), -1, 1));
	}

	/**
	 * Part one of this day's solution
	 * @return string
	 */
	abstract function part1();
	/**
	 * Part two of this day's solution
	 * @return string
	 */
	abstract function part2();

	function getInput() {
		return get_input($this->dayNumber);
	}

	/**
	 * @return Collection
	 */
	function inputByLine() {
		return get_input_line_by_line($this->dayNumber);
	}
}
