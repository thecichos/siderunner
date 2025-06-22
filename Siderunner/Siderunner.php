<?php

namespace Siderunner;

use Exception;

abstract class Siderunner
{

	/**
	 * Retrieves the initialization file path.
	 *
	 * This method will throw an exception if the initialization file path could not be retrieved.
	 *
	 * @return string The path to the initialization file.
	 * @throws Exception
	 */
	public static function getInitFile(): string {
		throw new Exception("Not implemented");
	}

	/**
	 * Detaches the initialization file from the current process.
	 *
	 * This method will run the initialization file in a separate process.
	 *
	 * This method will not return until the initialization file has been detached.
	 *
	 * This method will throw an exception if the initialization file could not be detached.
	 *
	 * @return void
	 * @throws Exception
	 */
	protected static function init_detach(): void
	{

		$strInitPath = call_user_func(get_called_class().'::getInitFile');

		echo exec('php '.$strInitPath.' 1>/dev/null 2>/dev/null &');
	}

	public bool $running = false;

	public function __construct() {}

	/**
	 * Runs the Siderunner loop.
	 *
	 * This method will run the Siderunner loop until the kill condition has been met.
	 *
	 * This method will throw an exception if the Siderunner loop could not be run.
	 *
	 * @return void
	 * @throws Exception
	 */
	public function loop(): void
	{

		if($this->killConditionMet()) $this->kill();

		if ($this->running) {
			$this->loop();
		}
	}

	/**
	 * Kills the current Siderunner.
	 *
	 * This method will be called after the kill condition has been met.
	 *
	 * This method will throw an exception if the kill condition could not be met.
	 *
	 * @return void
	 *
	 */
	final public function kill(): void {
		$this->running = false;
		$this->save();
	}

	/**
	 * Saves the current state of the Siderunner.
	 *
	 * This method will be called after the kill condition has been met.
	 *
	 * This method will throw an exception if the state could not be saved.
	 *
	 * @return void
	 */
	abstract public function save();

	/**
	 * Evaluates and determines whether the kill condition has been met.
	 *
	 * @return bool Returns true if the kill condition is met, otherwise false.
	 */
	abstract public function killConditionMet() : bool;


	/**
	 *
	 * Executes the main runtime logic of the current instance by invoking the loop method.
	 *
	 * @return void
	 * @throws Exception
	 */
	final public function run(): void
	{
		$this->running = true;
		$this->loop();
	}
}