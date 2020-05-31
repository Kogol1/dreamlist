<?php

namespace App\Console\Commands;

use App\Dream;
use http\Client\Curl\User;
use Illuminate\Console\Command;

class DreamConvert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kogol:convert-dreams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $user = User::find(1);
        $dream = Dream::all();
        $user->dreams()->sync($dream);
    }
}
