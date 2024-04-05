<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ResourceMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:restfull {name : nombre modelo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear un nuevo modelo, repositorio, controllers REST y rutas';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    private $files;

    private $filesToCreate = [
        'model',
        'repository',
        'get',
        'getById',
        'store',
        'update',
        'delete',
        'routes',
        'storeRequest',
        'updateRequest'
    ];

    private $stubs = [
        'model' => '/stubs/restful.model.stub',
        'repository' => '/stubs/restful.repository.stub',
        'get' => '/stubs/restful.getController.stub',
        'getById' => '/stubs/restful.getByIdController.stub',
        'store' => '/stubs/restful.storeController.stub',
        'update' => '/stubs/restful.updateController.stub',
        'delete' => '/stubs/restful.deleteController.stub',
        'routes' => '/stubs/restful.routes.stub',
        'storeRequest' => '/stubs/restful.storeRequest.stub',
        'updateRequest' => '/stubs/restful.updateRequest.stub'
    ];

    private $basePaths = [
        'model' => 'Models/',
        'repository' => 'Repositories/',
        'get' => 'Http/Controllers/',
        'getById' => 'Http/Controllers/',
        'store' => 'Http/Controllers/',
        'update' => 'Http/Controllers/',
        'delete' => 'Http/Controllers/',
        'routes' => 'routes/',
        'storeRequest' => 'Http/Requests/',
        'updateRequest' => 'Http/Requests/' 
    ];

    private $fileNames = [
        'repository' => '{{ name }}Repository',
        'get' => 'Get{{ name }}Controller',
        'getById' => 'Get{{ name }}ByIdController',
        'store' => 'Store{{ name }}Controller',
        'update' => 'Update{{ name }}Controller',
        'delete' => 'Delete{{ name }}Controller',
        'storeRequest' => 'Store{{ name }}Request',
        'updateRequest' => 'Update{{ name }}Request'
    ];

    protected function resolveStubPath($stub)
    {
        return $this->laravel->basePath('app/Console' . $stub);
    }

    protected function resolveStrReplace($type, $modelName) 
    {
        if($type == 'model') {
            return [
                '{{ name }}' => $modelName,
                '{{ tableName }}' => Str::plural(Str::snake($modelName))
            ];
        } elseif($type == 'get') {
            return [
                '{{ name }}' => $modelName,
                '{{ namePlural }}' => Str::plural($modelName),
            ];
        } elseif($type == 'routes') {
            return [
                '{{ name }}' => $modelName,
                '{{ namePlural }}' => Str::plural($modelName),
                '{{ namePluralLowerCase }}' => Str::plural(Str::lower(Str::kebab($modelName)))
            ];
        }

        return [
            '{{ name }}' => $modelName,
        ];
    }

    protected function resolveDestinationFilePath($type, $name)
    {
        $basePath = $this->basePaths[$type];
        $fileName = "";

        if($type == 'model') {
            $fileName = $name;
        } elseif($type == 'routes') {
            $lcName = Str::lower(Str::snake($name));
            $fileName = $lcName;
            return $this->laravel->basePath("$basePath/$fileName.php");
        } else {
            $filePath = "$name/"; 
            $fileName = $filePath . str_replace('{{ name }}', $name, $this->fileNames[$type]);
        }

        return app_path("$basePath/$fileName.php");
    }

    protected function createDir($type, $name) {
        $basePath = $this->basePaths[$type] . '/' . $name . '/';

        if($type == 'routes') {
            if(!$this->files->exists($this->laravel->basePath($basePath))) {
                $this->files->makeDirectory($this->laravel->basePath($basePath));
                $this->info("Creando directorio para $type");
            }
            return;
        }

        if(!$this->files->exists(app_path($basePath))) {
            $this->files->makeDirectory(app_path($basePath));
            $this->info("Creando directorio para $type");
        }
    }

    private function checkFileExists($filePath) {
        $exists = $this->files->exists($filePath);

        return $exists;
    }

    private function createFileFromStub($stub, $replace, $filePath) {
        if($this->checkFileExists($filePath)) {
            $this->error($filePath . ' ya existe!');

            return false;
        }

        $replaceStub = $this->files->get($stub);

        $replacedStub = str_replace(
            array_keys($replace), array_values($replace), $replaceStub
        );

        $this->files->put($filePath, $replacedStub);

        $this->info($filePath . ' creado');

        return true;
    }

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = trim($this->argument('name'));
        $name = Str::ucfirst($name);

        foreach($this->filesToCreate as $file) {
            $stub = $this->resolveStubPath($this->stubs[$file]);
            
            $replace = $this->resolveStrReplace($file, $name);
            
            if(!in_array($file, ['model', 'routes'])) {
                $this->createDir($file, $name);
            }

            $destinationFilePath = $this->resolveDestinationFilePath($file, $name);
            
            $file = $this->createFileFromStub($stub, $replace, $destinationFilePath);
        }
        
        $this->info('Generando REST para ' . $name);
    }
}
