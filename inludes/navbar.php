<header class="site-header">
    <div class="navbar">
        <!-- Brand -->
        <a href="index.php" class="brand-logo">
            <?php if (!empty($settings['logo'])): ?>
                <img src="uploads/logo/<?= htmlspecialchars($settings['logo']); ?>"
                    alt="<?= htmlspecialchars($settings['brand_name'] ?? 'Boka Nation'); ?>">
            <?php else: ?>
                <span>BOKA</span>
                <span>NATION</span>
            <?php endif; ?>
        </a>

        <!-- Navigation -->
        <nav class="nav-menu" id="navMenu">
            <a href="index.php"
               class="<?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>">
                Home
            </a>

            <a href="about.php"
               class="<?= basename($_SERVER['PHP_SELF']) === 'about.php' ? 'active' : '' ?>">
                About
            </a>

            <a href="collections.php"
               class="<?= basename($_SERVER['PHP_SELF']) === 'collections.php' ? 'active' : '' ?>">
                Collections
            </a>

            <a href="gallery.php"
               class="<?= basename($_SERVER['PHP_SELF']) === 'gallery.php' ? 'active' : '' ?>">
                Lookbook
            </a>

            <a href="services.php"
               class="<?= basename($_SERVER['PHP_SELF']) === 'services.php' ? 'active' : '' ?>">
                Services
            </a>

            <a href="contact.php"
               class="<?= basename($_SERVER['PHP_SELF']) === 'contact.php' ? 'active' : '' ?>">
                Contact
            </a>


            <!-- Mobile close button -->
            <button class="menu-button menu-close"
                id="menuClose" aria-label="Close menu">
                <i class="fa-solid fa-times"></i>
            </button>
        </nav>

        <!-- Social actions -->
        <div class="nav-actions">
            <?php if (!empty($settings['instagram'])): ?>
                <a href="<?= htmlspecialchars($settings['instagram']); ?>"
                    target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            <?php endif; ?>
            <?php if (!empty($settings['whatsapp'])): ?>
                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $settings['whatsapp']); ?>"
                    target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
            <?php endif; ?>
        </div>

        <!-- Mobile menu button -->
        <button class="menu-button menu-toggle" id="menuToggle" aria-label="Open menu">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
</header>


