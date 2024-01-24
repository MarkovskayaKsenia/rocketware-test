<?php

namespace App\Filters;

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
        foreach($properties as $propertyName => $propertyValues) {
            $builder->whereIn($propertyName, $propertyValues);
        }
    }
}
