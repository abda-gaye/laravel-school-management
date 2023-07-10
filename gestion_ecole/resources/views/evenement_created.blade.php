<!DOCTYPE html>
<html>
<head>
    <title>Nouvel événement créé</title>
</head>
<body>
    <h1>Nouvel événement créé</h1>
    <p>Un nouvel événement a été créé :</p>
    <ul>
        <li>Titre : {{ $evenement->libelle }}</li>
        <li>Date : {{ $evenement->event_date }}</li>
    </ul>
</body>
</html>
