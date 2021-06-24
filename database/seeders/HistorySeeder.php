<?php

namespace Database\Seeders;

use App\Models\History;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        History::where('histories_type', 'Adjustment')->update([
            'account' => 'DEBIT'
        ]);

        History::where('histories_type', 'Delivery')->update([
            'account' => 'CREDIT'
        ]);

        History::where('histories_type', 'Initialisation')->update([
            'account' => 'DEBIT'
        ]);

        History::where('histories_type', 'JobCost')->update([
            'account' => 'CREDIT'
        ]);

        History::where('histories_type', 'Receive')->update([
            'account' => 'DEBIT'
        ]);

        History::where('histories_type', 'Release')->update([
            'account' => 'CREDIT'
        ]);

        History::where('histories_type', 'Result')->update([
            'account' => 'DEBIT'
        ]);
    }
}
