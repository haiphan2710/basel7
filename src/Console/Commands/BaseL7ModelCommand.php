<?php

namespace HaiPhan\BaseL7\Console\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\ModelMakeCommand;

class BaseL7ModelCommand extends ModelMakeCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'basel7:model';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'BaseL7 Model';

    /**
     * Stub Path of files generates
     *
     * @var string
     */
    protected $stubPath = '../Stubs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent basel7-model class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('pivot')) {
            return $this->stubPath .'/pivot.basel7.stub';
        }

        if ($this->hasOption('auth')) {
            return $this->stubPath .'/auth.basel7.stub';
        }

        return  $this->stubPath .'/model.basel7.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }
}
