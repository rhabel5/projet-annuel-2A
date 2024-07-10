<?php

namespace App\Console\Commands;

use App\Models\Prestataire;
use App\Models\Prestation;
use Illuminate\Console\Command;

class PayementPrestataire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:payement-prestataire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $prestation = Prestation::where('date_fin');
    }
}
