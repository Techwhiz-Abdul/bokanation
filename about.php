<?php include 'includes/header.php'; ?>
<?php 
    $aboutImage = null;

$aboutImageQuery = $conn->query("SELECT image FROM gallery
    WHERE status = 'active' ORDER BY display_order ASC, created_at DESC LIMIT 1");

if ($aboutImageQuery && $aboutImageQuery->num_rows > 0) {
    $aboutImage = $aboutImageQuery->fetch_assoc()['image'];
}
?>

<main class="about-page">
    <!-- PAGE INTRO -->
    <section class="page-intro">
        <div class="section-number">
            <span>01</span>
            <span>ABOUT BOKA NATION</span>
        </div>

        <h1>A contemporary<br>expression of Nigerian style.</h1>
    </section>

    <!-- ABOUT STORY -->
    <section class="about-story">
        <div class="about-image">
            <?php if ($aboutImage): ?>

            <img src="uploads/gallery/<?= htmlspecialchars($aboutImage); ?>"
                alt="<?= htmlspecialchars($settings['brand_name'] ?? 'Boka Nation'); ?> menswear">

                <?php endif; ?>
        </div>

        <div class="about-text">
            <p class="about-label">
                THE BRAND
            </p>

            <h2>Rooted in tradition.<br>Defined by detail.</h2>
            <p>
                Boka Nation is a Nigerian menswear brand creating
                distinctive native wear for the modern man.
            </p>

            <p>
                Our work brings together traditional Nigerian
                influences and contemporary design, with a strong
                focus on fit, fabric and finishing.
            </p>

            <p>
                From individual pieces to complete looks, every
                garment is approached with the intention of making
                the wearer feel confident and well put together.
            </p>
        </div>
    </section>

    <!-- BRAND APPROACH -->
    <section class="brand-approach">
        <div class="section-number">
            <span>02</span>
            <span>OUR APPROACH</span>
        </div>

        <div class="approach-content">
            <h2>The details<br>matter.</h2>
            <div class="approach-text">
                <p>
                    Good menswear is not only about what you see.
                    It is also about the way a piece fits, moves
                    and feels.
                </p>

                <p>
                    Our approach pays attention to the elements
                    that make a garment feel considered—from the
                    choice of fabric to the finishing touches.
                </p>
            </div>
        </div>
    </section>

    <!-- BRAND VALUES -->
    <section class="brand-values">
        <div class="value-item">
            <span>01</span>
            <h3>Craftsmanship</h3>
            <p>Attention to construction, finishing and detail.</p>
        </div>

        <div class="value-item">
            <span>02</span>
            <h3>Individuality</h3>
            <p>Pieces that allow personal style to take centre stage.</p>
        </div>

        <div class="value-item">
            <span>03</span>
            <h3>Consistency</h3>
            <p>A commitment to maintaining quality across every piece.</p>
        </div>
    </section>

    <!-- ABOUT CTA -->
    <section class="about-cta">
        <p>READY TO EXPLORE?</p>

        <h2>Discover the<br>collections.</h2>
        <a href="collections.php" class="hero-button">
            Explore Collections
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </section>
</main>

<?php include 'includes/footer.php'; ?>