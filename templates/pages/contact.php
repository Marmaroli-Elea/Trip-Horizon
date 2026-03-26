<div class="part">
    <div>
        <h1>Contact</h1>
        <h2 class="title-with-underline" style="text-align: center; margin-bottom: 60px;">Contacter <span class="highlight">Nous</span>.</h2>
        <p>N'hésitez pas à nous contacter pour toute question ou demande d'information.</p>
    </div>
</div>
<div class="colonne3">
    <div class="reservation-column">
        <div class="contour-box2">
            <form action="/contact" method="post" class="form-grid" id="contact-form">
                <div class="form-field">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" required />
                </div>
                <div class="form-field">
                    <label for="email">Adresse mail</label>
                    <input type="email" id="email" name="email" required />
                </div>
                <div class="form-field full-width">
                    <label for="sujet">Sujet</label>
                    <input type="text" id="sujet" name="sujet" required />
                </div>
                <div class="form-field full-width">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <div class="form-field full-width">
                    <button type="submit" class="btn-cta" form="contact-form">Envoyer mon message</button>
                </div>
            </form>
        </div>
    </div>
    <div class="summary-box">
        <h2 style="color: #f8e9d1; font-size: x-large; text-align: center; text-decoration: underline;">Nos coordonnées</h2>
        <p style="color: #f8e9d1; margin-top: 10px;">Adresse</p>
        <p style="color: #ffffff; margin-top: 0px;">123 Rue de l'Aventure, 75000 Paris, France</p>
        <p style="color: #f8e9d1; margin-top: 10px;">Téléphone</p>
        <p style="color: #ffffff; margin-top: 0px;">+33 1 23 45 67 89</p>
        <p style="color: #f8e9d1; margin-top: 10px;">Email</p>
        <p style="color: #ffffff; margin-top: 0px;">contact@triphorizon.fr</p>
    </div>
</div>
<div class="faq-section">
    <h2 style="text-align:center; margin:60px 0; font-size: 70px; color: #2d2d74;">FAQ</h2>
    <div class="faq-item">
        <button class="faq-question">Quels types de voyages propose TripHorizon ?</button>
        <div class="faq-answer">
            <p>Nous proposons des voyages surprises adaptés à vos envies : détente, aventure, ville, montagne ou destinations polaires.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">Comment fonctionne la réservation ?</button>
        <div class="faq-answer">
            <p>Vous choisissez une thématique, remplissez le formulaire et nous nous occupons du reste. La destination reste secrète jusqu’au départ.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">Puis-je annuler mon voyage ?</button>
        <div class="faq-answer">
            <p>Oui, vous pouvez annuler jusqu’à 48h avant le départ selon nos conditions générales.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">Comment nous contacter ?</button>
        <div class="faq-answer">
            <p>Via le formulaire ci-dessus, par téléphone ou par email. Nous répondons sous 24h.</p>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
        const answer = button.nextElementSibling;

        button.classList.toggle('active');

        if (button.classList.contains('active')) {
            answer.style.maxHeight = answer.scrollHeight + "px";
        } else {
            answer.style.maxHeight = 0;
        }
    });
});
</script>