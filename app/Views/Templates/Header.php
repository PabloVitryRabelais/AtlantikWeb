<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>eRabelais</title>
</head>
<body>
    <div class="p-2 bg-dark text-white text-center">
        <a class= "btn btn-dark" href="<?php echo site_url('Atlantik') ?>"><h1>Atlantik</h1></a>
    </div>
    <nav class="navbar navbar-expand-sm bg-light">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class= "btn btn-dark" href="<?php echo site_url('creercompte') ?>">creer un compte</a>
                </li>
                &nbsp;&nbsp;
                <li class="nav-item">
                    <a class= "btn btn-dark" href="<?php echo site_url('liaisonsparsecteur') ?>">liaisons/seteur</a>
                </li>
                &nbsp;&nbsp;
                <li class="nav-item">
                    <a class= "btn btn-dark" href="<?php echo site_url('visutraversees') ?>">Traversées</a>
                </li>
            </ul>
        </div>
    </nav>