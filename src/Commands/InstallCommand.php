<?php

namespace LaravelDaily\PermissionsUI\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use LaravelDaily\PermissionsUI\Commands\Concerns\CanValidateInput;

class InstallCommand extends Command
{
    use CanValidateInput;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission-ui:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install permission UI';

    public function handle()
    {
        shell_exec('php artisan vendor:publish --provider="LaravelDaily\PermissionsUI\PermissionsUIServiceProvider" --tag="seeds"');

        $this->replaceInFile(
            "public function run()" . PHP_EOL . "    {",
            "public function run()" . PHP_EOL . "    {" . PHP_EOL . "        RoleAndPermissionSeeder::class;",
            database_path('seeders/DatabaseSeeder.php')
        );

        $this->call('migrate:fresh', ['--seeder' => 'RoleAndPermissionSeeder']);

        $this->createUser();

        $this->components->info('All done! You can now login at ' . route('login'));
    }

    private function createUser(): void
    {
        $this->components->info('Let\'s create a user.');

        $user = User::create($this->getUserData());

        $user->assignRole('admin');

        $this->components->info('User created!');
    }

    protected function getUserData(): array
    {
        return [
            'name' => $this->validateInput(fn () => $this->ask('Name'), 'name', ['required']),
            'email' => $this->validateInput(fn () => $this->ask('Email address'), 'email', ['required', 'email', 'unique:users']),
            'password' => Hash::make($this->validateInput(fn () => $this->secret('Password'), 'password', ['required', Rules\Password::defaults()])),
        ];
    }

    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}