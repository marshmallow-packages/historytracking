<?php

namespace Marshmallow\HistoryTracking\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Marshmallow\HistoryTracking\ColumnChange;
use Marshmallow\HistoryTracking\History;

trait Historyable
{
    /**
     * Listen to the updated callback from Laravel so
     * we can monitor the changes and store them.
     * @return void
     */
    public static function bootHistoryable()
    {
        static::updated(function (Model $model) {
            collect($model->getWantedChangedColumns($model))->each(function ($change) use ($model) {
                $model->saveChange($change);
            });
        });
    }

    /**
     * Store the changes that where made to our history table.
     *
     * @param  ColumnChange $change
     * @return void
     */
    protected function saveChange(ColumnChange $change)
    {
        $this->history()->create([
            'changed_column' => $change->column,
            'changed_value_from' => $change->from,
            'changed_value_to' => $change->to,
        ]);
    }

    /**
     * Get a collection of columns we want to see changes from
     * in our history table. This excludes the columns that are
     * provided by the default or model specific method ignoreHistoryColumns()
     *
     * @param  Model $model
     * @return collection Collection of columns we want to change
     */
    protected function getWantedChangedColumns(Model $model)
    {
        return collect(array_diff(
            Arr::except($model->getChanges(), $model->ignoreHistoryColumns()),
            $original = $model->getOriginal()
        ))
            ->map(function ($change, $column) use ($original) {
                return new ColumnChange($column, Arr::get($original, $column), $change);
            });
    }

    /**
     * This will return a polymorphic relationship
     *
     * @return Relation
     */
    public function history()
    {
        return $this->morphMany(History::class, 'historyable')
            ->latest();
    }

    /**
     * Get an array of columns we don't want to see changes from
     * in our history table.
     *
     * @return array
     */
    public function ignoreHistoryColumns()
    {
        return [
            'updated_at',
        ];
    }
}
