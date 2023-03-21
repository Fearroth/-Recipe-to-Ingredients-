<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->title }}</title>
</head>
<body>
    <a href="{{ route('recipes.index') }}">Strona główna</a>
    <h1>{{ $recipe->title }}</h1>
    <a href="{{ route('recipes.edit', $recipe) }}">Edytuj przepis</a>
    <p>Autor: {{ $recipe->author }}</p>
    <h2>Składniki:</h2>
    <pre>{{ $recipe->ingredients }}</pre>
    <h2>Instrukcje:</h2>
    <pre>{{ $recipe->instructions }}</pre>
    
    
    
    <form action="{{ route('recipes.destroy', $recipe) }}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Usuń przepis">
    </form>
</body>
</html>
