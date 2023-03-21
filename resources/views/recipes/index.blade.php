<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista przepisów</title>
</head>

<body>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h1>Lista przepisów</h1>
    <a href="{{ route('recipes.create') }}">Dodaj przepis</a>
    <ul>
        @foreach($recipes as $recipe)
            <li>
                <a href="{{ route('recipes.show', $recipe) }}">{{ $recipe->title }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>