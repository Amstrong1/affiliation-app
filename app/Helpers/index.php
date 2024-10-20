<?php

use Illuminate\Database\Eloquent\Model;

function searchInModel(Model $model, $query, $columns) {
    // Convertir les colonnes en chaîne séparée par des virgules
    $columnsString = implode(',', $columns);

    return $model::whereRaw(
        "MATCH($columnsString) AGAINST(? IN NATURAL LANGUAGE MODE)",
        [$query]
    )->get();
}
