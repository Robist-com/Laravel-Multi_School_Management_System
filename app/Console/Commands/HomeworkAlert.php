<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class HomeworkAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'homework-status:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this will disabled the homework when the time is expired';

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
        $date1 = now()->format('Y-m-d');
        $time1 = now()->format('H:i:00');
        // DB::table('homeworks')->whereRaw('end_date = now() ')->update(['status' => 'expired'])
        // ->everyMinute();

      $update =  DB::table('homeworks')
        ->whereDate('end_date', '=', $date1)
        ->whereTime('end_date', '=',  $time1)
        ->update(['status' => 'expired'])->everyMinute();
        echo " Homework status Updated successfully";

        dd( $update);
    }
}
