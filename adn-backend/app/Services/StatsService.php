<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class StatsService
{
    public function getStats(): array
    {
        $countMutations = Cache::get('count_mutations', 0);
        $countNoMutation = Cache::get('count_no_mutation', 0);

        $total = $countMutations + $countNoMutation;
        $ratio = $total > 0 ? $countMutations / $total : 0;

        return [
            'count_mutations' => $countMutations,
            'count_no_mutation' => $countNoMutation,
            'ratio' => round($ratio, 4),
        ];
    }
}
