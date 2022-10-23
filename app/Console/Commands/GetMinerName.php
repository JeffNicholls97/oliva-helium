<?php

namespace App\Console\Commands;

use App\Models\Accounts;
use App\Models\Setting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetMinerName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minername:cron';

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
        $accounts = Accounts::all();

        foreach ($accounts as $account){
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
            ])->get('https://api.helium.io/v1/hotspots/'. $account->address_key .'');
            $heliumStats = $response->collect();

            $minerName = $heliumStats['data']['name'];
            $minerCity = $heliumStats['data']['geocode']['long_city'];
            $minerScale = $heliumStats['data']['reward_scale'];
            $minerStatus = $heliumStats['data']['status']['online'];

            $heliumQuery = Accounts::query()->where('id', $account->id)->first();
            $heliumQuery->miner_name = $minerName;
            $heliumQuery->miner_city = $minerCity;
            $heliumQuery->miner_scale = $minerScale;
            $heliumQuery->miner_status = $minerStatus;
            $heliumQuery->save();

        }
    }
}
