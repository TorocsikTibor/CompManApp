<?php

namespace App\Services;

use App\Models\CompetitorRound;
use App\Models\Round;
use Illuminate\Support\Facades\DB;

class RoundService
{
    public function create(string $name, int $competitionId, array $competitors): void
    {
        DB::beginTransaction();
        try {
            $round = new Round;
            $round->name = $name;
            $round->competition_id = $competitionId;
            $round->save();

            foreach ($competitors as $competitor) {
                $competitorRound = new CompetitorRound;
                $competitorRound->competitor_id = $competitor;
                $competitorRound->round_id = $round->id;
                $competitorRound->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function update(int $roundId, string $name, array $competitors): void
    {
        DB::beginTransaction();
        try {
            $round = Round::find($roundId);
            $round->update(['name' => $name]);

            CompetitorRound::where('round_id', $roundId)->delete();

            foreach ($competitors as $competitor) {
                $competitorRound = new CompetitorRound;
                $competitorRound->competitor_id = $competitor;
                $competitorRound->round_id = $round->id;
                $competitorRound->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function delete(int $id):void
    {
        Round::destroy($id);
    }
}
