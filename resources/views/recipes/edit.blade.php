<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj przepis: {{ $recipe->title }}</title>
</head>
<body>
    <h1>Edytuj przepis: {{ $recipe->title }}</h1>
    <form action="{{ route('recipes.update', $recipe) }}" method="post">
        @csrf
        @method('PUT')
        <label for="title">Tytuł:</label>
        <input type="text" name="title" id="title" value="{{ $recipe->title }}" required>
        <br>
        <label for="author">Autor:</label>
        <input type="text" name="author" id="author" value="{{ $recipe->author }}" required>
        <br>
        <label for="ingredients">Składniki:</label>
        <textarea name="ingredients" id="ingredients" required>{{ $recipe->ingredients }}</textarea>
        <br>
        <label for="instructions">Instrukcje:</label>
        <textarea name="instructions" id="instructions" required>{{ $recipe->instructions }}</textarea>
        <br>
        <input type="submit" value="Zaktualizuj przepis">
    </form>
</body>
</html>