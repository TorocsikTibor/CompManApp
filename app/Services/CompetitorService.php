<?php

namespace App\Services;

use App\Models\Competition;
use App\Models\Competitor;
use App\Models\CompetitorRound;
use App\Models\Round;

class CompetitorService
{
    public function create(string $name, string $birthday, string $nationality): void
    {
        $competitor = new Competitor;
        $competitor->name = $name;
        $competitor->birthday = $birthday;
        $competitor->nationality = $nationality;
        $competitor->save();
    }

    public function deleteFromCompetition(int $competitorId, int $competitionId): void
    {
        $competition = Competition::find($competitionId)->id;
        $rounds = Round::where('competition_id', $competition)->pluck('id')->toArray();
        foreach ($rounds as $round) {
            $competitor = CompetitorRound::where('competitor_id', $competitorId)->where('round_id', $round);
            $competitor->delete();
        }
    }
}
