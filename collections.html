<?php
include 'includes/header.php';
$collections = getCollections($conn);

?>


<main class="collections-page">
    <!-- PAGE INTRO -->
    <section class="page-intro collections-intro">
        <div class="section-number">
            <span>01</span>
            <span>COLLECTIONS</span>
        </div>
        <h1>Pieces made<br>to be remembered.</h1>
        <p>Explore selected Boka Nation pieces, from contemporary native wear to footwear and accessories.</p>
    </section>

    <!-- COLLECTIONS -->
    <section class="collections-list">
        <?php if ($collections && $collections->num_rows > 0): ?>
            <?php $index = 1; ?>
            <?php while ($collection = $collections->fetch_assoc()): ?>
                <article class="collection-feature <?= $index % 2 === 0 ? 'collection-reverse' : ''; ?>">
                    <!-- IMAGE -->
                    <div class="collection-feature-image">
                        <?php if (!empty($collection['cover_image'])): ?>
                            <img src="uploads/collections/<?= htmlspecialchars($collection['cover_image']); ?>"
                                alt="<?= htmlspecialchars($collection['name']); ?>">
                        <?php else: ?>
                            <div class="collection-image-placeholder">
                                <span>No image available</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- CONTENT -->
                    <div class="collection-feature-content">
                        <span class="collection-index">
                            <?= str_pad($index, 2, '0', STR_PAD_LEFT); ?>
                        </span>
                        <p class="collection-category">
                            BOKA NATION
                        </p>

                        <h2><?= htmlspecialchars($collection['name']); ?></h2>
                        <?php if (!empty($collection['description'])): ?>
                            <p class="collection-description">
                                <?= nl2br(htmlspecialchars($collection['description'])); ?>
                            </p>
                        <?php endif; ?>
                        <a href="gallery.php" class="text-link">
                            View Lookbook
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
                <?php $index++; ?>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="collections-empty">
                <h2>Collections Coming Soon</h2>
                <p>Boka Nation's latest collections will be showcased here soon.</p>
            </div>
        <?php endif; ?>
    </section>

    <!-- COLLECTION CTA -->
    <section class="collections-cta">

        <p>FIND YOUR STYLE</p>

        <h2>Have something<br>specific in mind?</h2>
        <a href="contact.php" class="hero-button">
            Get in Touch
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

