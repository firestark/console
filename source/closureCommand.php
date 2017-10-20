<?php

namespace console;

use closure;
use ReflectionFunction as reflection;
use Illuminate\Console\Command as command;
use Symfony\Component\Console\Input\InputInterface as input;
use Symfony\Component\Console\Output\OutputInterface as output;

class closureCommand extends command
{
    protected $callback = null;

    public function __construct ( string $signature, closure $callback )
    {
        $this->callback = $callback;
        $this->signature = $signature;

        parent::__construct ( );
    }

    protected function execute ( input $input, output $output )
    {
        $inputs = array_merge ( $input->getArguments ( ), $input->getOptions ( ) );

        $parameters = [ ];

        foreach ( ( new reflection ( $this->callback ) )->getParameters ( ) as $parameter ) 
            if ( isset ( $inputs [ $parameter->name ] ) )
                $parameters [ $parameter->name ] = $inputs [ $parameter->name ];

        return $this->laravel->call(
            $this->callback->bindTo ( $this, $this ), $parameters
        );
    }

    public function describe ( string $description )
    {
        $this->setDescription ( $description );

        return $this;
    }
}
