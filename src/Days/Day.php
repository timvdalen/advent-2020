<?php
namespace Advent\Days;

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
	 * Part one of this day's solution
	 * @return string
	 */
	abstract function part2();

	function getInput() {
		return get_input($this->dayNumber);
	}
}
