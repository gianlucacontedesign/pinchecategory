<?php
require_once __DIR__ . '/config/config.php';

$categoryModel = new Category();
$productModel = new Product();
$cart = new Cart();

// Obtener productos destacados y nuevos
$featuredProducts = $productModel->getAll([
    'active_only' => true,
    'featured_only' => true,
    'limit' => 8
]);

$newProducts = $productModel->getAll([
    'active_only' => true,
    'new_only' => true,
    'limit' => 8
]);

// Obtener categorías principales
$categories = $categoryModel->getParentCategories();

$pageTitle = SITE_NAME . ' - Insumos Profesionales para Tatuajes';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($pageTitle); ?></title>
    <meta name="description" content="Pinche Supplies - Insumos profesionales para tatuajes. Los mejores productos al mejor precio con envíos a todo el país.">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/style.css">
    <link rel="stylesheet" href="assets/css/carousel-optimizado.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <!-- Hero Carousel - Estilo Rosa Monkey -->
    <section class="hero-carousel">
        <div class="carousel-container">
            <!-- Slide 1 -->
            <div class="carousel-slide active">
                <div class="carousel-content">
                    <div class="container">
                        <div class="carousel-text">
                            <h1 class="carousel-title">Insumos Profesionales para Tatuajes</h1>
                            <p class="carousel-subtitle">Calidad, confianza y experiencia en cada producto</p>
                            <div class="carousel-actions">
                                <a href="<?php echo SITE_URL; ?>/category.php" class="btn btn-primary btn-lg">
                                    Ver Productos
                                </a>
                                <a href="<?php echo SITE_URL; ?>/about.php" class="btn btn-outline-white btn-lg">
                                    Conocer Más
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-bg">
    <img src="assets/images/carrousel/pinche1.webp" alt="Imagen carrousel 1">
    <div class="gradient-overlay"></div>
</div>
            </div>
            
            <!-- Slide 2 -->
            <div class="carousel-slide">
                <div class="carousel-content">
                    <div class="container">
                        <div class="carousel-text">
                            <h1 class="carousel-title">Hasta 6 Cuotas Sin Interés</h1>
                            <p class="carousel-subtitle">Comprá ahora y pagá en cuotas con todas las tarjetas</p>
                            <div class="carousel-actions">
                                <a href="<?php echo SITE_URL; ?>/category.php" class="btn btn-primary btn-lg">
                                    Aprovechar Oferta
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-bg">
    <img src="assets/images/carrousel/pinche2.webp" alt="Imagen carrousel 2">
    <div class="gradient-overlay"></div>
</div>
            </div>
            
            <!-- Slide 3 -->
            <div class="carousel-slide">
                <div class="carousel-content">
                    <div class="container">
                        <div class="carousel-text">
                            <h1 class="carousel-title">Envíos a Todo el País</h1>
                            <p class="carousel-subtitle">Recibí tus productos en la puerta de tu casa</p>
                            <div class="carousel-actions">
                                <a href="<?php echo SITE_URL; ?>/shipping.php" class="btn btn-primary btn-lg">
                                    Ver Zonas de Envío
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-bg">
    <img src="assets/images/carrousel/pinche3.webp" alt="Imagen carrousel 3">
    <div class="gradient-overlay"></div>
</div>
            </div>
        </div>
        
        <!-- Carousel Controls -->
        <button class="carousel-control prev" onclick="changeSlide(-1)">❮</button>
        <button class="carousel-control next" onclick="changeSlide(1)">❯</button>
        
        <!-- Carousel Indicators -->
        <div class="carousel-indicators">
            <button class="indicator active" onclick="goToSlide(0)"></button>
            <button class="indicator" onclick="goToSlide(1)"></button>
            <button class="indicator" onclick="goToSlide(2)"></button>
        </div>
    </section>
    
    <!-- Categorías con Imágenes -->
    <?php if (!empty($categories)): ?>
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Categorías Principales</h2>
                <p class="section-subtitle">Encontrá todo lo que necesitás organizado por categorías</p>
            </div>
            <div class="categories-grid">
                <?php foreach ($categories as $category): ?>
                <a href="<?php echo SITE_URL; ?>/category.php?slug=<?php echo e($category['slug']); ?>" class="category-card-modern">
                    <div class="category-image-wrapper" style="background-image: url('<?php echo ASSETS_URL; ?>/images/categories/<?php echo e($category['name']); ?>.webp'); background-size: cover; background-position: center;">
                        <div class="category-overlay">
                            <h3 class="category-name"><?php echo e($category['name']); ?></h3>
                            <?php if ($category['description']): ?>
                            <p class="category-desc"><?php echo e(substr($category['description'], 0, 60)); ?>...</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    
    <!-- Productos Destacados -->
    <?php if (!empty($featuredProducts)): ?>
    <section class="section section-gray">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Productos Destacados</h2>
                <p class="section-subtitle">Los productos más populares y preferidos por nuestros clientes</p>
            </div>
            <div class="products-grid">
                <?php foreach ($featuredProducts as $product): ?>
                    <?php include 'includes/product-card.php'; ?>
                <?php endforeach; ?>
            </div>
            <div class="section-footer">
                <a href="<?php echo SITE_URL; ?>/category.php" class="btn btn-outline-primary btn-lg">
                    Ver Todos los Productos
                </a>
            </div>
        </div>
    </section>
    <?php endif; ?>
    
    <!-- Beneficios -->
    <section class="section">
        <div class="container">
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">🚚</div>
                    <h3 class="benefit-title">Envíos a Todo el País</h3>
                    <p class="benefit-text">Llegamos a todo el territorio nacional</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">💳</div>
                    <h3 class="benefit-title">Hasta 6 Cuotas</h3>
                    <p class="benefit-text">Sin interés con todas las tarjetas</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">🔒</div>
                    <h3 class="benefit-title">Compra Segura</h3>
                    <p class="benefit-text">Tus datos están protegidos</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">📱</div>
                    <h3 class="benefit-title">Atención Personalizada</h3>
                    <p class="benefit-text">Estamos para ayudarte por WhatsApp</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Novedades -->
    <?php if (!empty($newProducts)): ?>
    <section class="section section-gray">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Novedades</h2>
                <p class="section-subtitle">Los últimos productos que llegaron a nuestro catálogo</p>
            </div>
            <div class="products-grid">
                <?php foreach ($newProducts as $product): ?>
                    <?php include 'includes/product-card.php'; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
    
    <!-- Call to Action -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">¿Necesitás Ayuda o Asesoramiento?</h2>
                <p class="cta-text">Nuestro equipo está disponible para ayudarte en lo que necesites</p>
                <div class="cta-actions">
                    <a href="https://wa.me/<?php echo str_replace(['+', ' ', '-'], '', getSetting('site_phone', '')); ?>" 
                       class="btn btn-white btn-lg" target="_blank">
                        📱 Contactar por WhatsApp
                    </a>
                    <a href="tel:<?php echo e(getSetting('site_phone', '')); ?>" class="btn btn-outline-white btn-lg">
                        📞 Llamar Ahora
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="<?php echo ASSETS_URL; ?>/js/carousel.js"></script>
    <?php include 'includes/scripts.php'; ?>
</body>
</html>