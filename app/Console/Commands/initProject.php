<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class initProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initial configs for project';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('migrate', []);
        $this->call('passport:install', ['--force' => 1]);

        $name = $this->ask('What is your name?');
        $email = $this->ask('What is your email?');
        $password = $this->secret('Create a password?');
        $passwordconfirm = $this->secret('Confirm password?');
        if($password != $passwordconfirm){
            $this->error('You type differents passwords!');
            return;
        }
        $initUser= DB::table('users')->insert([
            'name' => $name,
            'email' => $email ,
            'password' => Hash::make($password),
            'superuser' => 1,
        ]);
        if($initUser){
            $findDefault= DB::table('users')->where("email","api@api.com")->first();
            if($findDefault) {
                if ($this->confirm('
We found the standard user api@api.com in its database. We encourage you to delete it for security reasons. Do you want to delete it now?')) {
                    $findDefault= DB::table('users')->where("email","api@api.com")->delete();

                }
            }
            $this->info('All Right! You create a new default user now!');
        }
    }
}
