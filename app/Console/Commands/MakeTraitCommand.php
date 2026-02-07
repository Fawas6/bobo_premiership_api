<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeTraitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new trait';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        // Handle nested directories (e.g., Players/PlayerTrait)
        $directory = dirname($name);
        $traitName = basename($name);

        $path = app_path("Traits/{$name}.php");
        $dirPath = dirname($path);

        // Create nested directories if they don't exist
        if (!File::exists($dirPath)) {
            File::makeDirectory($dirPath, 0755, true);
        }

        // Check if trait already exists
        if (File::exists($path)) {
            $this->error("Trait {$name} already exists!");
            return 1;
        }

        // Determine namespace
        $namespace = $directory !== '.'
            ? "App\\Traits\\" . str_replace('/', '\\', $directory)
            : "App\\Traits";

        // Create trait file
        $stub = "<?php

namespace {$namespace};

trait {$traitName}
{
    //
}
";

        File::put($path, $stub);
        $this->info("Trait {$name} created successfully!");

        return 0;
    }
}
