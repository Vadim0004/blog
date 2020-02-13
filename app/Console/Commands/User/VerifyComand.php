<?php

namespace App\Console\Commands\User;


use App\Entity\User\User;
use App\UseCases\Auth\RegisterService;
use Illuminate\Console\Command;

class VerifyComand extends Command
{
    private $service;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:verify {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command verify user';

    public function __construct(RegisterService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $email = $this->argument('email');

        if (!$user = User::where('email', $email)->first()) {
            $this->error('Undefined User with this email' . $email);

            return false;
        }

        try {
            $this->service->verify($user->id);
        } catch (\DomainException $exception) {
            $this->error($exception->getMessage());

            return false;
        }

        $this->info('Success!');
        return true;
    }
}
