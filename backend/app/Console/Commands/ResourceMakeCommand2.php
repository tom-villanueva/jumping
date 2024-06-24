<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ResourceMakeCommand2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:restful2 {name : The name of the model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a model, repository, RESTful controllers, requests, tests, and routes';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    private $filesystem;

    private $stubs = [
        'model' => 'restful.model.stub',
        'repository' => 'restful.repository.stub',
        'Get' => 'restful.getController.stub',
        'GetById' => 'restful.getByIdController.stub',
        'Store' => 'restful.storeController.stub',
        'Update' => 'restful.updateController.stub',
        'Delete' => 'restful.deleteController.stub',
        'routes' => 'restful.routes.stub',
        'request' => 'restful.request.stub',
        'ModelTest' => 'restful.modelTest.stub',
        'StoreTest' => 'restful.storeTest.stub',
        'UpdateTest' => 'restful.updateTest.stub',
        'GetTest' => 'restful.getTest.stub',
        'DeleteTest' => 'restful.deleteTest.stub',
        'factory' => 'restful.factory.stub'
    ];

    private $directories = [
        'model' => 'app/Models/',
        'repository' => 'app/Repositories',
        'Get' => 'app/Http/Controllers',
        'GetById' => 'app/Http/Controllers',
        'Store' => 'app/Http/Controllers',
        'Update' => 'app/Http/Controllers',
        'Delete' => 'app/Http/Controllers',
        'routes' => 'routes',
        'request' => 'app/Http/Requests',
        'ModelTest' => 'tests/Unit/Models',
        'StoreTest' => 'tests/Feature/Controllers',
        'UpdateTest' => 'tests/Feature/Controllers',
        'GetTest' => 'tests/Feature/Controllers',
        'DeleteTest' => 'tests/Feature/Controllers',
        'factory' => 'database/factories'
    ];

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $this->createModel($name);
        $this->createFactory($name);
        $this->createRepository($name);
        $this->createControllers($name);
        $this->createRequests($name);
        $this->createTests($name);
        $this->createRoutes($name);

        $this->info("RESTful resources for $name generated successfully.");
    }

    private function createModel($name)
    {
        $this->generateFile('model', $name, [
            '{{ className }}' => $name,
            '{{ name }}' => $name,
            '{{ tableName }}' => Str::plural(Str::snake($name)),
        ]);
    }

    private function createFactory($name)
    {
        $this->generateFile('factory', $name, [
            '{{ className }}' => "{$name}Factory",
        ]);
    }

    private function createRepository($name)
    {
        $this->generateFile('repository', $name, [
            '{{ className }}' => "{$name}Repository",
            '{{ name }}' => $name,
        ]);
    }

    private function createControllers($name)
    {
        $controllerTypes = ['Get', 'GetById', 'Store', 'Update', 'Delete'];
        foreach ($controllerTypes as $type) {
            $this->generateFile($type, $name, [
                '{{ className }}' => "{$type}{$name}Controller",
                '{{ name }}' => $name,
            ]);
        }
    }

    private function createRequests($name)
    {
        $requestTypes = ['Store', 'Update'];
        foreach ($requestTypes as $type) {
            $this->generateFile('request', $name, [
                '{{ className }}' => "{$type}{$name}Request",
                '{{ name }}' => $name,
            ]);
        }
    }

    private function createTests($name)
    {
        $testTypes = ['ModelTest', 'GetTest', 'StoreTest', 'UpdateTest', 'DeleteTest'];
        $types = [
            'ModelTest' => $name, 
            'GetTest' => 'Get', 
            'StoreTest' => 'Store', 
            'UpdateTest' => 'Update', 
            'DeleteTest' => 'Delete'
        ];
        $replacements = [];

        foreach ($testTypes as $type) {
            $classNameType = $types[$type];

            if($type == "ModelTest") {
                $replacements = [
                    '{{ className }}' => "{$classNameType}Test",
                    '{{ name }}' => $name,
                    '{{ nameLowerCase }}' => Str::plural(Str::snake($name)),
                ];
            } else {
                $replacements = [
                    '{{ className }}' => "{$classNameType}{$name}ControllerTest",
                    '{{ name }}' => $name,
                    '{{ nameLowerCase }}' => Str::lower(Str::snake($name)),
                    '{{ namePluralLowerCase }}' => Str::plural(Str::lower(Str::snake($name)))
                ];
            }
            $this->generateFile($type, $name, $replacements);
        }
    }

    private function createRoutes($name)
    {
        $this->generateFile('routes', $name, [
            '{{ name }}' => $name,
            '{{ namePluralLowerCase }}' => Str::plural(Str::lower(Str::kebab($name)))
        ]);
    }

    private function generateFile($type, $name, array $replacements)
    {
        $stubPath = $this->getStubPath($type);
        $content = $this->filesystem->get($stubPath);
        $content = str_replace(array_keys($replacements), array_values($replacements), $content);

        $filePath = $this->getFilePath($type, $name, $replacements['{{ className }}'] ?? $name);
        $this->makeDirectory(dirname($filePath));
        $this->filesystem->put($filePath, $content);

        $this->info("Created: $filePath");
    }

    private function getStubPath($type)
    {
        return base_path('app/Console/stubs/' . $this->stubs[$type]);
    }

    private function getFilePath($type, $name, $className)
    {
        $createDir = !in_array($type, ['model', 'routes', 'ModelTest', 'factory']);
        $directory = $createDir ? $this->directories[$type] . "/{$name}" : $this->directories[$type];
        $fileName = $className . '.php';

        return base_path("$directory/$fileName");
    }

    private function makeDirectory($path)
    {
        if (!$this->filesystem->isDirectory($path)) {
            $this->filesystem->makeDirectory($path);//, 0755, true);
        }
    }
}