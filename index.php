<?php
/* CONFIGURATION */
date_default_timezone_set('Europe/Paris');

/* REQUIRE DEPENDENCIES */
require_once 'inc/lib/flight/Flight.php';

/* DATABASE CONNECTION */
Flight::register('db', 'PDO', array(
    'mysql:host=localhost;dbname=trip_horizon;charset=utf8', // adapte ton nom de base
    'root',   
    'rootpass'       
));

/* DECLARE ROUTES */

//PUBLIC

// Page Accueil
Flight::route('/', function () {
    include 'templates/parts/begin.php';
    include 'templates/pages/home.php';
    include 'templates/parts/end.php';
});

// Page Notre ADN
Flight::route('/notre-adn', function () {
    include 'templates/parts/begin.php';
    include 'templates/pages/notre-adn.php';
    include 'templates/parts/end.php';
});

// Page Nos voyages
Flight::route('/nos-voyages', function () {
    include 'templates/parts/begin.php';
    include 'templates/pages/nos-voyages.php';
    include 'templates/parts/end.php';
});

// Page Evasion Marine
Flight::route('/evasion-marine', function () {
    include 'templates/parts/begin.php';
    include 'templates/pages/evasionmarine.php';
    include 'templates/parts/end.php';
});

// Page Pic Sauvage
Flight::route('/rocheux', function () {
    include 'templates/parts/begin.php';
    include 'templates/pages/rocheux.php';
    include 'templates/parts/end.php';
});

// Page Vent Glacé
Flight::route('/polaire', function () {
    include 'templates/parts/begin.php';
    include 'templates/pages/polaire.php';
    include 'templates/parts/end.php';
});

//Page Virée Urbaine
Flight::route('/ville', function () {
    include 'templates/parts/begin.php';
    include 'templates/pages/ville.php';
    include 'templates/parts/end.php';
});

//Page Réservation - GET handler
Flight::route('/reservation/@id', function ($id) {
    require_once 'inc/db.php';

    $req = $pdo->prepare("SELECT * FROM voyage WHERE id = ?");
    $req->execute([$id]);
    $voyage = $req->fetch();

    if (!$voyage) {
        die("Voyage introuvable.");
    }

    Flight::set('voyage', $voyage);

    

    include 'templates/parts/begin.php';
    include 'templates/pages/reservation.php';
    include 'templates/parts/end.php';
});

//Page Réservation - POST handler
Flight::route('POST /reservation', function () {
    require_once 'inc/db.php';

    $request = Flight::request();
    $nom = trim($request->data->nom);
    $prenom = trim($request->data->prenom);
    $nom_client = trim($nom . ' ' . $prenom);

    $email = filter_var(trim($request->data->email), FILTER_SANITIZE_EMAIL);
    $telephone = preg_replace('/[^0-9+\-\.\s]/', '', trim($request->data->telephone));
    $carte = preg_replace('/[^0-9 ]/', '', trim($request->data->carte_bancaire));
    $adresse = htmlspecialchars(trim($request->data->adresse_postale), ENT_QUOTES, 'UTF-8');

    $nombre_personnes = intval($request->data->nombre_personnes ?: 1);
    $nombre_personnes = max(1, min(20, $nombre_personnes));
    $commentaires = htmlspecialchars(trim($request->data->commentaires), ENT_QUOTES, 'UTF-8');
    $voyage_id = intval($request->data->voyage_id ?: 1);

    $date_debut = trim($request->data->date_debut);
    $date_fin = trim($request->data->date_fin);

    // Validation
    $valid = true;
    if (!$nom_client || !$email || !$telephone || !$carte || !$adresse || !$date_debut || !$date_fin) {
        $valid = false;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid = false;
    }
    if (!preg_match('/^[0-9+\-\.\s]{6,25}$/', $telephone)) {
        $valid = false;
    }
    if (!preg_match('/^[0-9]{12,19}$/', str_replace(' ', '', $carte))) {
        $valid = false;
    }
    if (!DateTime::createFromFormat('Y-m-d', $date_debut)) {
        $valid = false;
    }
    if (!DateTime::createFromFormat('Y-m-d', $date_fin)) {
        $valid = false;
    }
    if ($valid && strtotime($date_fin) < strtotime($date_debut)) {
        $valid = false;
    }

    if ($valid) {
        try {
            $stmt = $pdo->prepare("INSERT INTO reservation (voyage_id, nom_client, email_client, telephone_client, carte_bancaire, `adresse postale`, nombre_personnes, date_depart, date_retour, prix_total, statut, commentaires) VALUES (:voyage, :nom, :email, :telephone, :carte, :adresse, :nombre, :date_depart, :date_retour, :prix_total, :statut, :commentaires)");
            $stmt->execute([
                ':voyage' => $voyage_id,
                ':nom' => $nom_client,
                ':email' => $email,
                ':telephone' => $telephone,
                ':carte' => $carte,
                ':adresse' => $adresse,
                ':nombre' => $nombre_personnes,
                ':date_depart' => $date_debut,
                ':date_retour' => $date_fin,
                ':prix_total' => 0.00, // Valeur par défaut, à calculer selon les besoins
                ':statut' => 'en_attente',
                ':commentaires' => $commentaires,
            ]);
            Flight::redirect('/reservation/' . $voyage_id . '?success=1');
        } catch (PDOException $e) {
            Flight::redirect('/reservation/' . $voyage_id . '?success=0&error=' . urlencode('Erreur base de données: ' . $e->getMessage()));
        }
    } else {
        $error = 'Données invalides : ';
        if (empty($nom_client)) {
            $error .= 'nom/prénom requis. ';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= 'email invalide. ';
        }
        if (!preg_match('/^[0-9+\-\.\s]{6,25}$/', $telephone)) {
            $error .= 'Téléphone invalide. ';
        }
        if (!preg_match('/^[0-9]{12,19}$/', str_replace(' ', '', $carte))) {
            $error .= 'Carte bancaire invalide. ';
        }
        if (empty($adresse)) {
            $error .= 'Adresse postale requise. ';
        }
        if (empty($date_debut) || !DateTime::createFromFormat('Y-m-d', $date_debut)) {
            $error .= 'Date de départ invalide. ';
        }
        if (empty($date_fin) || !DateTime::createFromFormat('Y-m-d', $date_fin)) {
            $error .= 'Date de retour invalide. ';
        }
        if (!empty($date_debut) && !empty($date_fin) && strtotime($date_fin) < strtotime($date_debut)) {
            $error .= 'La date de retour doit être postérieure à la date de départ. ';
        }
        Flight::redirect('/reservation/' . $voyage_id . '?success=0&error=' . urlencode(trim($error)));
    }
});



//Page Contact
Flight::route('/contact', function () {

    include 'templates/parts/begin.php';
    include 'templates/pages/contact.php';
    include 'templates/parts/end.php';
});

//Page Newletter
Flight::route('/newsletter', function () {
    include 'templates/parts/begin.php';
    include 'templates/pages/newsletter.php';
    include 'templates/parts/end.php';
});

//Page Mentions légales
Flight::route('/mentions-legales', function () {
    include 'templates/parts/begin.php';
    include 'templates/pages/mentions.php';
    include 'templates/parts/end.php';
});

//Page CGV
Flight::route('/cgv', function () {
    include 'templates/parts/begin.php';
    include 'templates/pages/cgv.php';
    include 'templates/parts/end.php';
});

/* START FLIGHT SERVER */
Flight::start();