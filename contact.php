<?php
        include './includes/header.php'
    ?>
    <main>
        <h1>Contact</h1>
        <div class="container">
            <div class="row-section">
                <section class="contact-form">
                    <div class="contact-form-header">
                        <div class="contact-form-titles">
                            <h3 class="card-title">
                                Contactez nous !
                            </h3>
                            <p>remplissez le formulaire de contact ci-dessous</p>
                        </div>
                    </div>
                    <form action="">
                        <div class="contact-form-body">
                            <div class="contact-form-inputs">
                                <div class="contact-form-inputs-container">
                                    <label for="firstname">Prénom</label>
                                    <input type="text" name="firstname" placeholder="Prénom">
                                </div>
                                <div class="contact-form-inputs-container">
                                    <label for="lastname">Nom</label>
                                    <input type="text" name="lastname" placeholder="Nom">
                                </div>
                            </div>
                            <div class="contact-form-inputs">
                                <div class="contact-form-inputs-container">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" placeholder="E-mail">
                                </div>
                                <div class="contact-form-inputs-container">
                                    <label for="Téléphone">Téléphone</label>
                                    <input type="text" name="Téléphone" placeholder="Téléphone">
                                </div>
                            </div>
                            <div class="contact-form-inputs">
                                <div class="contact-form-inputs-container">
                                    <label for="object">Objet</label>
                                    <input type="text" name="object" placeholder="Objet">
                                </div>
                            </div>

                            <div class="contact-form-textarea">
                                <label for="request">Request</label>
                                <textarea name="request" id="request" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </form>
                </section>
                <section class="contact-info">
                    <div class="contact-info-header">
                        <div class="contact-info-titles">
                            <h3 class="card-title">
                                Informations de contact
                            </h3>
                            <p>Retrouvez toutes les informations nécessaires pour nous joindre</p>
                        </div>
                    </div>
                    <div class="contact-info-container">
                        <div class="contact-info-body">
                            <div class="contact-informations">
                                <p><b>Téléphone: </b>bl bl bl bl bl</p>
                                <p><b>E-mail: </b>une super adresse email</p>
                                <p><b>Adresse: </b>une super adresse</p>
                            </div>
                            <div class="contact-location">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2893.8637856445685!2d-1.4735480841658928!3d43.50517707000725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5140e52167421f%3A0x363e8553b5656d92!2sAfpa!5e0!3m2!1sen!2sfr!4v1642764812627!5m2!1sen!2sfr"
                                    width="600" height="300" style="border:0;" allowfullscreen=""
                                    loading="lazy"></iframe>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <?php
        include './includes/footer.php'
    ?>