<?php

namespace Helious\SeatSquadAddMember\Http\Controllers\Api\v2;

use Seat\Api\Http\Controllers\Api\v2\ApiController;
use Helious\SeatSquadAddMember\Http\Validation\SquadMember;
use Seat\Web\Models\Squads\Squad;

class SquadsController extends ApiController
{

    /**
     * @OA\Post(
     *      path="/v2/squads/{squad_id}/add-member",
     *      tags={"Squads"},
     *      summary="Get a list of squads",
     *      description="Returns list of squads",
     *      security={
     *          {"ApiKeyAuth": {}}
     *      },
     *      @OA\Response(response=200, description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Member added to squad")
     *          )
     *     ),
     *     @OA\Response(response=404, description="Bad request",
     *     @OA\Response(response=4041 description="Unauthorized",
     * )
     * 
     * @param $squad_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addMember($squad_id)
    {
        $this->validate(request(), SquadMember::rules());

        $squad = Squad::find($squad_id);

        if (!$squad)
            return $this->error('Squad not found', 400);

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
            return $this->error('Squad not found', 400);

        $squad->members()->detach(request('character_id'));

        return $this->success('Member removed from squad');
    }

}
