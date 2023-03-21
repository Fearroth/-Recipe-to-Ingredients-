<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj przepis</title>
</head>
<body>
    @if($errors->any())
        <div class="alert">
            @foreach($errors->all() as $error)        
            {{$error}}
            @endforeach
        </div>
    @endif
    <h1>Dodaj przepis</h1>
    <form action="{{ route('recipes.store') }}" method="post">
        @csrf
        <label for="title">Tytuł:</label>
        <input type="text" name="title" id="title" required>
        <br>
        <label for="author">Autor:</label>
        <input type="text" name="author" id="author" required>
        <br>
        <label for="ingredients">Składniki:</label>
        <textarea name="ingredients" id="ingredients" required></textarea>
        <br>
        <label for="instructions">Instrukcje:</label>
        <textarea name="instructions" id="instructions" required></textarea>
        <br>
        <input type="submit" value="Dodaj przepis">
    </form>
</body>
</html>