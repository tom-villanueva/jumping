<?php

namespace App\Core;

use Carbon\Carbon;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 * @package App\Core
 */
class BaseModel extends Model
{

    /**
     * Return the default allowed filters for all models.
     *
     * @return array
     */
    public function allowedFilters()
    {
        return [
            AllowedFilter::exact('id'),
            AllowedFilter::exact('created_at'),
            AllowedFilter::exact('updated_at'),
            AllowedFilter::exact('deleted_at'),
            AllowedFilter::scope('created_before'),
            AllowedFilter::scope('created_after'),
            AllowedFilter::scope('created_between'),
            AllowedFilter::trashed(),
        ];
    }

    /**
     * Return the default allowed sorts for all models.
     *
     * @return array
     */
    public function allowedSorts()
    {
        return [
            'id',
            'created_at',
            'updated_at'
        ];
    }

    /**
     * Return the default allowed includes for all models.
     *
     * @return array
     */
    public function allowedIncludes()
    {
        return [
            'audits',
            'audits.user'
        ];
    }

    /**
     * Scope a query to only include records created before a given date.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCreatedBefore($query, $date)
    {
        return $query->where('created_at', '<=', Carbon::parse($date));
    }

    /**
     * Scope a query to only include records created after a given date.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCreatedAfter($query, $date)
    {
        return $query->where('created_at', '>=', Carbon::parse($date));
    }

    /**
     * Scope a query to only include records created between given dates.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $date1
     * @param  string  $date2
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCreatedBetween($query, $date1, $date2)
    {
        return $query->whereBetween('created_at', [$date1, $date2]);
    }
}
