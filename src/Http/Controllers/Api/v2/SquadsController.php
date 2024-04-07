<?php

namespace Helious\SeatSquadAddMember\Http\Controllers\Api\v2;

use Helious\SeatSquadAddMember\Http\Validation\SquadMember;
use Seat\Web\Models\Squads\Squad;

class SquadsController extends ApiController
{

    /**
     * Add a member from a squad
     * @param $squad_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addMember($squad_id, SquadMember $request)
    {
        $squad = Squad::find($squad_id);
        $fields = $request->all();
        $character_id = $fields['character_id'];

        if (!$squad) return response()->json('Squad not found', 400);

        try{
            $squad->members()->attach($character_id);
            return response()->json('Member added to squad');
        } catch (\Exception $e) {
            return response()->json('Member already in squad', 400);
        }

    }

    /**
     * Remove a member from a squad
     * @param $squad_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeMember($squad_id, SquadMember $request)
    {
        $squad = Squad::find($squad_id);
        $fields = $request->all();
        $character_id = $fields['character_id'];

        if (!$squad) return response()->json('Squad not found', 400);

        try {
            $squad->members()->find($character_id);
            return response()->json('Member removed from squad');
        } catch (\Exception $e) {
            return response()->json('Member not in squad', 400);
        }

    }

}
