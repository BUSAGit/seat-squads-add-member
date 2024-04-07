<?php

namespace Helious\SeatSquadAddMember\Http\Controllers;

use Seat\Api\Http\Controllers\Api\v2\ApiController;
use Helious\SeatSquadAddMember\Http\Validation\SquadMember;
use Seat\Web\Models\Squads\Squad;

class SquadsController extends ApiController
{

    /**
     * Add a member to a squad
     * @param $squad_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addMember($squad_id)
    {
        $this->validate(request(), SquadMember::rules());

        $squad = Squad::find($squad_id);

        if (!$squad)
            return $this->error('Squad not found', 404);

        $squad->members()->attach(request('character_id'));

        return $this->success('Member added to squad');
    }

    /**
     * Remove a member from a squad
     * @param $squad_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeMember($squad_id)
    {
        $this->validate(request(), SquadMember::rules());

        $squad = Squad::find($squad_id);

        if (!$squad)
            return $this->error('Squad not found', 404);

        $squad->members()->detach(request('character_id'));

        return $this->success('Member removed from squad');
    }

}
