<?php
include_once "../vendor/autoload.php";

use Siderunner\SiderunnerImplentation\WriteToThousand;

// The idea behind the siderunner is to run a process that will potentially run forever or until some condition is met.
// In this case, we will run the process for 1000 times and then kill it.

// The detach method will run the process in a separate process.
// This is useful if you want to run the process in the background and not block the current process.
WriteToThousand::detach();
