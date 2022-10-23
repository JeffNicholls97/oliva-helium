<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetTotalMiners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'totalminers:cron';

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
        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->get('https://api.helium.io/v1/accounts/14Ve5BGUKRGxiXkqm329KRs3JepWpuBCBqfwbNZdGMipjavoyq6');

        $responseAccount = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
        ])->get('https://api.helium.io/v1/accounts/14Ve5BGUKRGxiXkqm329KRs3JepWpuBCBqfwbNZdGMipjavoyq6');

        if ($response->status() == 200 && $responseAccount->status() == 200) {
            $heliumAccount = $response->collect();
            $heliumAccountTotal = $responseAccount->collect();

            $hotspotCount = $heliumAccount['data']['hotspot_count'];
            $hotspotAccount = $heliumAccount['data']['balance'];

            $heliumCol = Setting::query()->where('id', 1)->first();
            $heliumCol->total_miners = $hotspotCount;
            $heliumCol->total_account_hnt = $hotspotAccount;
            $heliumCol->save();
        }
    }
}
