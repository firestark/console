<?php

namespace console;

use closure;
use Illuminate\Console\Application as console;
use Illuminate\Contracts\Container\Container as container;
use Illuminate\Contracts\Events\Dispatcher as dispatcher;
use Illuminate\Events\Dispatcher as events;


class app extends console
{
	public function __construct ( container $container, string $name = 'Firestark', 
		dispatcher $dispatcher = null, float $version = 1 )
	{
		$dispatcher = ( $dispatcher ) ?: new events;
		parent::__construct ( $container, $dispatcher, $version );
		$this->setName ( $name );
	}

	public function command ( string $signature, closure $command )
	{
		$command = new closureCommand ( $signature, $command );

		$this->add ( $command );
	}
}