<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        header {
            padding: 40px 0;
            text-align: center;
        }

        header span {
            text-transform: capitalize;
        }

        main a {
            color: black;
            padding: 10px 15px;
            background-color: dodgerblue;
            border: 1px solid black;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 25px;
        }

        main p {
            line-height: 25px;
        }
    </style>
</head>

<body>
    <header>
        <h1>E' stato {{ $changes_type }} il progetto: <span>{{ $project->name }}</span></h1>
    </header>
    <main>
        <p>
            Ciao,<br>
            è appena stato {{ $changes_type }} un progetto che potresti esserti perso!
        </p>
        <a href="{{ $url }}">Scopri di più</a>
    </main>
</body>

</html>
