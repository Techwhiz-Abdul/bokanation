<?php include 'includes/header.php'; ?>

<?php
    $contactImage = null;

    $contactImageQuery = $conn->query("SELECT image FROM gallery
        WHERE status = 'active' ORDER BY display_order ASC, created_at DESC LIMIT 1");

    if ($contactImageQuery && $contactImageQuery->num_rows > 0) {
        $contactImage = $contactImageQuery->fetch_assoc()['image'];
    }
?>

<main class="contact-page">
    <!-- PAGE INTRO -->
    <section class="page-intro contact-intro">
        <div class="section-number">
            <span>01</span>
            <span>CONTACT</span>
        </div>
        <h1>Let's start<br>a conversation.</h1>

        <p>Interested in a piece, a collection, or working with Boka Nation? Reach out through any of our available channels.</p>
    </section>

    <!-- CONTACT CONTENT -->
    <section class="contact-main">
        <div class="contact-main-image">
            <?php if ($contactImage): ?>
            <img src="uploads/gallery/<?= htmlspecialchars($contactImage); ?>"
                alt="<?= htmlspecialchars($settings['brand_name'] ?? 'Boka Nation'); ?> menswear">

                <?php endif; ?>
        </div>

        <div class="contact-main-content">
            <span class="contact-label">
                GET IN TOUCH
            </span>

            <h2>We'd love to<br>hear from you.</h2>
            <p class="contact-description">For enquiries, custom pieces, collections or general information, contact Boka Nation directly through your preferred channel.</p>

            <!-- CONTACT DETAILS -->
            <div class="contact-details">
               <a href="<?= !empty($settings['whatsapp']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['whatsapp']) : '#'; ?>" class="contact-detail" target="_blank" rel="noopener">

                    <div class="contact-detail-icon">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>

                    <div>
                        <span>WHATSAPP</span>
                        <strong><?= !empty($settings['whatsapp']) ? htmlspecialchars($settings['whatsapp']) : 'Start a conversation'; ?></strong>
                    </div>
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>


                <a href="<?= !empty($settings['instagram']) ? htmlspecialchars($settings['instagram']) : '#'; ?>" class="contact-detail" target="_blank" rel="noopener">

                    <div class="contact-detail-icon">
                        <i class="fa-brands fa-instagram"></i>
                    </div>

                    <div>
                        <span>INSTAGRAM</span>
                        <strong>Follow Boka Nation</strong>
                    </div>
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>

                <a href="<?= !empty($settings['phone']) ? 'tel:' . preg_replace('/[^0-9+]/', '', $settings['phone']) : '#'; ?>" class="contact-detail">

                    <div class="contact-detail-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>

                    <div>
                        <span>PHONE</span>
                        <strong><?= !empty($settings['phone']) ? htmlspecialchars($settings['phone']): 'Phone number'; ?></strong>
                    </div>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

                <div class="contact-detail">
                    <div class="contact-detail-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>

                    <div>
                        <span>LOCATION</span>
                       <strong><?= !empty($settings['address']) ? htmlspecialchars($settings['address']): 'Location'; ?></strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SOCIAL CTA -->
    <section class="contact-social">
        <div class="section-number">
            <span>02</span>
            <span>FOLLOW THE JOURNEY</span>
        </div>

        <h2>Stay connected<br>with Boka Nation.</h2>
        <p>Follow our social pages for new looks, collections, updates and more.</p>

        <div class="contact-social-links">

           <a href="<?= !empty($settings['instagram']) ? htmlspecialchars($settings['instagram']) : '#'; ?>" target="_blank" rel="noopener">
                <i class="fa-brands fa-instagram"></i>
                Instagram
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </a>

           <a href="<?= !empty($settings['facebook']) ? htmlspecialchars($settings['facebook']) : '#'; ?>" target="_blank" rel="noopener">
                <i class="fa-brands fa-facebook-f"></i>
                Facebook
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </a>

           <a href="<?= !empty($settings['tiktok']) ? htmlspecialchars($settings['tiktok']) : '#'; ?>"
             target="_blank" rel="noopener">
                <i class="fa-brands fa-tiktok"></i>
                TikTok
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </a>

        </div>
    </section>

    <!-- FINAL CTA -->
    <section class="contact-final">
        <p>BOKA NATION</p>
        <h2>Your next look<br>starts here.</h2>

       <a href="<?= !empty($settings['whatsapp'])? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['whatsapp']) : '#'; ?>"
        class="hero-button" target="_blank" rel="noopener">
            <i class="fa-brands fa-whatsapp"></i>
            Talk to Us
        </a>
    </section>
</main>

<?php include 'includes/footer.php'; ?>