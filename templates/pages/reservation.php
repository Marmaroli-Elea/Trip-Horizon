<?php
$voyage = Flight::get('voyage');
?>

<div class="part" style="align-items: left; justify-content: flex-start; margin-left:195px">
    <div>
        <h1>Réservation</h1>
        <h2>Valider votre <br><span class="highlight">Voyage</span>.</h2>
        <p>Finissez votre réservation en quelques clics simples.</p>
    </div>
</div>
<div class="colonne3">
    <div class="reservation-column">
        <div class="contour-box2">
            <div class="stat-colonne">
                <div class="col1">
                    <p style="color: #ff1b61; font-size: large;">ETAPE 1/3</p>
                    <p style="color: #000; font-size: x-large;">Votre avancée</p>
                </div>
                <div class="col2">
                    <p style="color: #ff1b61; font-size: 70px;">34%</p>
                </div>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 34%;"></div>
            </div>
        </div>
        <div class="contour-box2">
            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <p style="color: #00d454; font-weight: bold;">Réservation enregistrée avec succès !</p>
            <?php elseif (isset($_GET['success']) && $_GET['success'] == 0): ?>
                <p style="color: #ff1b61; font-weight: bold;">Erreur : <?php echo htmlspecialchars($_GET['error'] ?? 'Veuillez remplir tous les champs requis.', ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>

            <div class="participant-selector">
                <p style="color: #ff1b61; font-size: large; text-align: center; margin-bottom: 10px;">NOMBRE DE PARTICIPANTS</p>
                <div class="participant-options">
                    <button type="button" class="participant-btn selected" data-value="1">SOLO</button>
                    <button type="button" class="participant-btn" data-value="2">DUO</button>
                    <button type="button" class="participant-btn" data-value="3">TRIO</button>
                    <button type="button" class="participant-btn" data-value="4">PERSO</button>
                </div>
            </div>
            <form action="/reservation" method="POST" class="form-grid" id="reservation-form">
                <input type="hidden" name="voyage_id" value="<?= $voyage['id'] ?>" />
                <input type="hidden" id="nombre_personnes" name="nombre_personnes" value="1" />
                <input type="hidden" id="commentaires" name="commentaires" value="" />
                <div class="form-field full-width custom-count-field" style="display:none;">
                    <label for="nombre_personnes_custom">Nombre exact de participants</label>
                    <input type="number" id="nombre_personnes_custom" name="nombre_personnes_custom" min="4" max="20" value="4" />
                </div>
                <div class="form-field">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" required />
                </div>
                <div class="form-field">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" required />
                </div>
                <div class="form-field">
                    <label for="email">Adresse mail</label>
                    <input type="email" id="email" name="email" required />
                </div>
                <div class="form-field">
                    <label for="telephone">Numéro de téléphone</label>
                    <input type="tel" id="telephone" name="telephone" required />
                </div>
                <div class="form-field">
                    <label for="carte_bancaire">Carte bancaire</label>
                    <input  id="carte_bancaire" name="carte_bancaire" required />
                </div>
                <div class="form-field">
                    <label for="adresse_postale">Adresse postale</label>
                    <input type="text" id="adresse_postale" name="adresse_postale" required />
                </div>
                <div class="form-field">
                    <label for="date_debut">Date de début</label>
                    <input type="date" id="date_debut" name="date_debut" required />
                </div>
                <div class="form-field">
                    <label for="date_fin">Date de fin</label>
                    <input type="date" id="date_fin" name="date_fin" required />
                </div>
            </form>
            
            <div class="survey-box">
                <p style="color: #ff1b61; font-size: large; text-align: center; margin-bottom: 10px;">VOS PREFERENCES DE VOYAGE</p>
                <div class="question" data-question="1">
                    <p>1. Quelle vibe recherchez-vous pour ce voyage ?</p>
                    <div class="options">
                        <button type="button" class="survey-option" data-answer="Détente totale">Détente totale</button>
                        <button type="button" class="survey-option" data-answer="Aventure pure">Aventure pure</button>
                        <button type="button" class="survey-option" data-answer="Découverte complète">Découverte complète</button>
                        <button type="button" class="survey-option" data-answer="Expérience immersive">Expérience immersive</button>
                    </div>
                </div>
                <div class="question" data-question="2">
                    <p>2. Quel rythme vous correspond le mieux ?</p>
                    <div class="options">
                        <button type="button" class="survey-option" data-answer="Très chill, je veux prendre mon temps">Très chill, je veux prendre mon temps</button>
                        <button type="button" class="survey-option" data-answer="Actif mais tranquille">Actif mais tranquille</button>
                        <button type="button" class="survey-option" data-answer="Dynamique et spontané">Dynamique et spontané</button>
                        <button type="button" class="survey-option" data-answer="Contemplatif et calme">Contemplatif et calme</button>
                    </div>
                </div>
                <div class="question" data-question="3">
                    <p>3. Quel type d’activités vous attire le plus ?</p>
                    <div class="options">
                        <button type="button" class="survey-option" data-answer="Moments relax (balades, pauses, chill)">Moments relax</button>
                        <button type="button" class="survey-option" data-answer="Activités nature / plein air">Activités nature / plein air</button>
                        <button type="button" class="survey-option" data-answer="Exploration culturelle / lieux emblématiques">Exploration culturelle</button>
                        <button type="button" class="survey-option" data-answer="Expériences uniques / ambiance locale">Expériences uniques</button>
                    </div>
                </div>
                <div class="question" data-question="4">
                    <p>4. Quel style d’hébergement préférez-vous ?</p>
                    <div class="options">
                        <button type="button" class="survey-option" data-answer="Confort simple et cosy">Confort simple et cosy</button>
                        <button type="button" class="survey-option" data-answer="Hébergement chaleureux et authentique">Chaleureux et authentique</button>
                        <button type="button" class="survey-option" data-answer="Moderne et pratique">Moderne et pratique</button>
                        <button type="button" class="survey-option" data-answer="Surprise totale, je m’adapte">Surprise totale</button>
                    </div>
                </div>
                <div class="question" data-question="5">
                    <p>5. Quel est votre objectif principal pour ce voyage ?</p>
                    <div class="options">
                        <button type="button" class="survey-option" data-answer="Me reposer et déconnecter">Me reposer et déconnecter</button>
                        <button type="button" class="survey-option" data-answer="Vivre une aventure différente">Vivre une aventure différente</button>
                        <button type="button" class="survey-option" data-answer="Découvrir un nouvel environnement">Découvrir un nouvel environnement</button>
                        <button type="button" class="survey-option" data-answer="Créer des souvenirs uniques">Créer des souvenirs uniques</button>
                    </div>
                </div>
                <div class="question" data-question="6">
                    <p>6. Quel mood vous décrit le mieux aujourd’hui ?</p>
                    <div class="options">
                        <button type="button" class="survey-option" data-answer="Chill">Chill</button>
                        <button type="button" class="survey-option" data-answer="Curieux">Curieux</button>
                        <button type="button" class="survey-option" data-answer="Énergique">Énergique</button>
                        <button type="button" class="survey-option" data-answer="Rêveur">Rêveur</button>
                    </div>
                </div>
                <div class="question" data-question="7">
                    <p>7. Quel niveau de spontanéité vous convient ?</p>
                    <div class="options">
                        <button type="button" class="survey-option" data-answer="Je veux tout découvrir sur place">Découvrir sur place</button>
                        <button type="button" class="survey-option" data-answer="J’aime avoir quelques repères">Quelques repères</button>
                        <button type="button" class="survey-option" data-answer="J’adore l’inattendu">J’adore l’inattendu</button>
                        <button type="button" class="survey-option" data-answer="Je suis ouvert à tout">Ouvert à tout</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="summary-box">
        <h3 style="color: #f8e9d1;">Récapitulatif de votre réservation</h3>
        <hr>
        <div class="summary-item">
            <p><span class="label">Voyage :</span></p>
            <p><span class="value" id="summary-voyage"><?= htmlspecialchars($voyage['titre']) ?></span></p>
        </div>
        <div class="summary-item">
            <p><span class="label">Prix :</span></p>
<p><span class="value" id="summary-prix"><?= number_format($voyage['prix_base'], 0, ',', ' ') ?> €</span></p>
        </div>
        <div class="summary-item">
            <p><span class="label">Participants :</span></p>
            <p><span class="value" id="summary-participants">1 personne</span></p>
        </div>
        <div class="summary-item">
            <p><span class="label">Nom :</span></p>
            <p><span class="value" id="summary-nom">-</span> <span class="value" id="summary-prenom">-</span></p>
        </div>
        <div class="summary-submit">
            <button type="submit" class="btn-cta" form="reservation-form">Confirmer ma réservation</button>
        </div>
    </div>

<script>
    let selectedVoyagePrix = <?= $voyage['prix_base'] ?>;
    function updateSummaryPrice() {
        const participants = parseInt(peopleField.value);
        const total = selectedVoyagePrix * participants;

        summaryPrix.textContent = total.toLocaleString('fr-FR') + " €";
    }

    const peopleField = document.getElementById('nombre_personnes');
    const customFieldBox = document.querySelector('.custom-count-field');
    const customFieldInput = document.getElementById('nombre_personnes_custom');
    const commentairesField = document.getElementById('commentaires');
    const nomField = document.getElementById('nom');
    const prenomField = document.getElementById('prenom');

    // Éléments du résumé
    const summaryParticipants = document.getElementById('summary-participants');
    const summaryNom = document.getElementById('summary-nom');
    const summaryPrenom = document.getElementById('summary-prenom');
    const summaryPrix = document.getElementById('summary-prix');

    document.querySelectorAll('.participant-btn').forEach(button => {
        button.addEventListener('click', () => {
            const value = button.dataset.value;
            document.querySelectorAll('.participant-btn').forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');

            if (value === '4') {
                customFieldBox.style.display = 'block';
                peopleField.value = customFieldInput.value;
            } else {
                customFieldBox.style.display = 'none';
                peopleField.value = value;
            }
            updateCommentaires();
            updateSummary();
        });
    });

    customFieldInput.addEventListener('input', () => {
        if (document.querySelector('.participant-btn.selected').dataset.value === '4') {
            peopleField.value = customFieldInput.value;
        }
        updateCommentaires();
        updateSummary();
    });

    // Mise à jour du résumé pour nom et prénom
    nomField.addEventListener('input', updateSummary);
    prenomField.addEventListener('input', updateSummary);

    const surveyAnswers = {};

    document.querySelectorAll('.survey-option').forEach(option => {
        option.addEventListener('click', () => {
            const question = option.closest('.question').dataset.question;
            const answer = option.dataset.answer;

            surveyAnswers[question] = answer;
            option.closest('.options').querySelectorAll('.survey-option').forEach(btn => btn.classList.remove('selected'));
            option.classList.add('selected');

            updateCommentaires();
        });
    });

    // Validation du formulaire avant soumission
    document.getElementById('reservation-form').addEventListener('submit', function(e) {
        const answeredQuestions = Object.keys(surveyAnswers).length;
        if (answeredQuestions < 7) {
            e.preventDefault();
            alert('Veuillez répondre à toutes les questions du questionnaire avant de valider votre réservation.');
            return false;
        }
    });

    function updateCommentaires() {
        const parts = [];
        parts.push('Participants: ' + peopleField.value);

        Object.keys(surveyAnswers).sort().forEach(question => {
            parts.push('Q' + question + ': ' + surveyAnswers[question]);
        });

        commentairesField.value = parts.join(' | ');
    }

    function updateSummary() {
        // Participants
        const participants = parseInt(peopleField.value);
        summaryParticipants.textContent = participants === 1 ? '1 personne' : participants + ' personnes';

        // Nom et prénom
        summaryNom.textContent = nomField.value || '-';
        summaryPrenom.textContent = prenomField.value || '-';
        updateSummaryPrice();
    }

    updateCommentaires();
    updateSummary();
</script>
</div>
