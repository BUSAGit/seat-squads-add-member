<?php

namespace Helious\SeatSquadAddMember\Http\Validation;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class NewSquadMember.
 *
 * @package Seat\Api\Http\Validation
 */
class SquadMember extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'character_id' => 'required|integer',
        ];
    }
}