<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;

class GetHeliumPriceHourly extends Command
{
    public $heliumPrice;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'heliumprice:cron';

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
        \Log::info("Cron is working fine!");

        $coinResponse = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->get('https://api.coingecko.com/api/v3/simple/price?ids=helium&vs_currencies=gbp');

        if ($coinResponse->status() == 200) {
            $coinvalue = $coinResponse->collect();
            $this->heliumPrice = $coinvalue['helium']['gbp'];
        }

        $heliumCol = Setting::query()->where('id', 1)->first();
        $heliumCol->helium_price_gbp = $this->heliumPrice;
        $heliumCol->save();
    }
}
