<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    /**
     * Formats a given carbon.
     *
     * @param Carbon|null $date
     * @return string|null
     */
    public function formatDate(?Carbon $date): ?string
    {
        return $date !== null ? $date->format('Y-m-d G:i:s') : null;
    }
}
