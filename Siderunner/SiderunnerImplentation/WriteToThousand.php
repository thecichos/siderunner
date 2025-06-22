<?php

namespace Siderunner\SiderunnerImplentation;

use Siderunner\Siderunner;

class WriteToThousand extends Siderunner
{

	/**
	 * Retrieves the initialization file path.
	 *
	 * @return string The path to the initialization file.
	 */
	public static function getInitFile(): string {
		return __DIR__."/WriteToThousand_init.php";
	}

	/**
	 * Detaches the current instance by invoking the parent's detach initialization process.
	 *
	 * @return void
	 * @throws \Exception
	 */
	public static function detach(): void
	{
		parent::init_detach();
	}

	private int $intCounter = 0;

	public function loop(): void
	{
		$this->intCounter++;

		$this->save();

		parent::loop();
	}

	public function save()
	{
		file_put_contents("test.txt", $this->intCounter."\n", FILE_APPEND);
	}

	public function killConditionMet(): bool
	{
		return $this->intCounter >= 1000;
	}
}