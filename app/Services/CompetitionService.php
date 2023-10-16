<?php

namespace App\Services;

use App\Models\Competition;


class CompetitionService
{
    public function delete(int $id): void
    {
        Competition::destroy($id);
    }

    public function createOrUpdate(?int $id, string $name, string $date): void
    {
        if (isset($id)) {
            $competition = Competition::find($id);
        } else {
            $competition = new Competition;
        }

        $competition->name = $name;
        $competition->date = $date;
        $competition->save();
    }

}
