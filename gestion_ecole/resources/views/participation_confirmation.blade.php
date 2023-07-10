<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de participation</title>
</head>
<body>
    <h1>Confirmation de participation</h1>
    <p>Votre participation à l'événement suivant a été confirmée :</p>
    <ul>
        <li>Événement : {{ $evenement->libelle }}</li>
        <li>Date : {{ $evenement->event_date }}</li>
    </ul>
</body>
</html>
