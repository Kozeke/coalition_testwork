<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueTaskInUniqueProject implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        dd($value);
//        Rule::unique('tasks')->where(function ($query) use ($taskId, $project_id) {
//            return $query->where('id', $taskId)
//                ->where('project_id', $project_id);
//        });
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
