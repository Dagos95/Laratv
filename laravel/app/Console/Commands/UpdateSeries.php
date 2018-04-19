<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Serie;

class UpdateSeries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:series';  // Permette di creare il comando per la prompt

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
        
        $series = Serie::orderBy('updated_at', 'asc')
            ->take(10)
            ->get();
        
        foreach ($series as $serie)
        {
            $this->info($serie->title);
            
            try
            {
                $serie->fetchData();
                $serie->updated_at = Carbon::now();
                $serie->save();
            }
            catch(\Exception $e)
            {
                $this->error($e->getMessage());
            }
        }
    }
    
}
