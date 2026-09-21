
<?php

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/functions.php';

$settings = getSettings($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="<?= htmlspecialchars(
        $settings['about_text'] ?? 'Boka Nation — Contemporary Nigerian menswear, footwear and accessories.'
    ); ?>">

    <title><?= htmlspecialchars($settings['brand_name'] ?? 'Boka Nation'); ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="fontawesome/css/solid.css">
    <link rel="stylesheet" href="fontawesome/css/brands.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="/BOKA/assets/css/style.css?v=2">
    <link rel="stylesheet" href="/BOKA/assets/css/reveal.css">

</head>

<body>
    <script src="/BOKA/js/reveal.js" defer></script>

<?php include __DIR__ . '/navbar.php'; ?>

