<?php

namespace App\Filters;

use App\Models\Property;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{

    public const PROPERTIES = 'properties';


    protected function getCallbacks(): array
    {
        return [
            self::PROPERTIES => [$this, 'properties'],
            ];
    }

    public function properties(Builder $builder, $properties)
    {
        $propertyIdsMap = Property::select('id', 'name')
            ->whereIn('name', array_keys($properties))
            ->pluck('id', 'name')->toArray();

        foreach($properties as $propertyName => $propertyValues) {
            $builder->whereHas('attachedProperties',
                function (Builder $q) use ($propertyIdsMap, $propertyName, $propertyValues) {
                $q->where(function (Builder $subquery) use ($propertyIdsMap, $propertyName, $propertyValues) {
                    $subquery->where('property_id', $propertyIdsMap[$propertyName])
                        ->whereIn('property_value', $propertyValues);
                });
            });
        }
    }
}
