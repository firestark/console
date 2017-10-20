<?php

namespace console;

use closure;
use Illuminate\Console\Application as console;


class app extends console
{
	public function command ( string $signature, closure $command )
	{
		$command = new closureCommand ( $signature, $command );

		$this->add ( $command );
	}
}