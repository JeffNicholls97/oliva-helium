<?php

namespace App\Console\Commands;

use App\Models\Accounts;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetMinerTopStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minertopstats:cron';

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
            $seven_day_res = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
            ])->retry(15, 1000)->get('https://api.helium.io/v1/hotspots/'. $account->address_key .'/rewards/sum?min_time=-7%20day');
            $fourteen_day_res = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
            ])->retry(15, 1000)->get('https://api.helium.io/v1/hotspots/'. $account->address_key .'/rewards/sum?min_time=-14%20day');
            $thirty_day_res = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
            ])->retry(15, 1000)->get('https://api.helium.io/v1/hotspots/'. $account->address_key .'/rewards/sum?min_time=-30%20day');
            $yearly_res = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36',
            ])->retry(15, 1000)->get('https://api.helium.io/v1/hotspots/'. $account->address_key .'/rewards/sum?min_time=-52%20week');

            $seven_day = $seven_day_res->json();
            $fourteen_day = $fourteen_day_res->json();
            $thirty_day = $thirty_day_res->json();
            $yearly_year = $yearly_res->json();

            $seven = $seven_day['data']['total'];
            $fourteen = $fourteen_day['data']['total'];
            $thirty = $thirty_day['data']['total'];
            $yearly = $yearly_year['data']['total'];

            $heliumQuery = Accounts::query()->where('id', $account->id)->first();
            $heliumQuery->seven_day_reward = $seven;
            $heliumQuery->fourteen_day_reward = $fourteen;
            $heliumQuery->thirty_day_reward = $thirty;
            $heliumQuery->yearly_reward = $yearly;
            $heliumQuery->save();

        }
    }
}
