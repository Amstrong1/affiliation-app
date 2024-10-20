<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request, $model)
    {
        // Valider les paramètres de la requête
        $request->validate([
            'query' => 'required|string',
            'columns' => 'sometimes|array'
        ]);

        // Obtenir la requête de recherche
        $query = $request->input('query');
        
        // Optionnellement, obtenir les colonnes
        $columns = $request->input('columns');
        
        // Associer le modèle en fonction du paramètre $model
        $modelClass = 'App\\Models\\' . ucfirst($model);
        
        if (!class_exists($modelClass)) {
            return response()->json(['error' => 'Modèle non trouvé'], 404);
        }

        // Exécuter la recherche dans le modèle
        $results = searchInModel(new $modelClass, $query, $columns);

        // Retourner les résultats en JSON
        return response()->json($results);
    }
}
