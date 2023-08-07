<?php

namespace App\Console\Commands;

use App\Models\balance_sale;
use Illuminate\Console\Command;

class CreateDailyRecord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:dailyrecord';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new daily platform balance record with zero values';

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
        balance_sale::create([
            'ooredoo' => 0,
            'jawwal' => 0,
            'jawwalpay' => 0,
            'electricity' => 0,
            'ooredoobills' => 0,
            'firstpay' => 0,
            'bop' => 0,
            'bankquds' => 0,
        ]);

        $this->info('Daily record created successfully.');
    }
}
