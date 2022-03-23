<?php

namespace FieldControl\Repositories;

use Spatie\ArrayToXml\ArrayToXml;

class MaterialRepository extends BaseRepository
{
    public function all(array $filters = [], $offset = null): ?Object
    {

        $options = [];

        foreach ($filters as $k => $v) {
            $filters[$k] = $k.'['.$v.']';
        }

        if(count($filters)) {
            $options['filters'] = implode('; ', $filters);
        }

        return $this->client->get('materials?limit=100', $options);

    }
    
}