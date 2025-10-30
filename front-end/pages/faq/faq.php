<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>ATK SKI - FAQ</title>
        <link rel="stylesheet" type="text/css" href="/front-end/pages/faq/styles/responsive.css">
        <link rel="stylesheet" type="text/css" href="/front-end/pages/faq/styles/style.css">
    </head>
    <body>

<!-- Loading Screen -->

        <?php include '../../components/loading-screen/loading-screen.php'; ?>

<!-- Header -->

        <?php include '../../components/header/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="faq-container">
            <h2 class="faq-title">FAQs</h2>
            <div class="faq-box">
                <!-- FAQ Item 1 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        <span>1. Bagaimana cara memesan produk di ATK SKI?</span>
                        <div class="icon-container">
                            <span class="icon-plus">+</span>
                            <span class="icon-minus">−</span>
                        </div>
                    </button>
                    <div class="faq-answer">
                        <p>Untuk memesan produk di ATK SKI, Anda dapat mengunjungi halaman Shop by Category, pilih produk yang diinginkan, tambahkan ke keranjang, dan lakukan checkout dengan mengisi informasi pengiriman dan pembayaran.</p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        <span>2. Kapan pesanan bisa diambil?</span>
                        <div class="icon-container">
                            <span class="icon-plus">+</span>
                            <span class="icon-minus">−</span>
                        </div>
                    </button>
                    <div class="faq-answer">
                        <p>Pesanan dapat diambil setelah Anda menerima notifikasi bahwa pesanan sudah siap. Biasanya pesanan siap dalam 1-3 hari kerja setelah pembayaran dikonfirmasi.</p>
                    </div>
                </div>

                <!-- FAQ Item 3 (Default Open) -->
                <div class="faq-item active">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        <span>3. Bagaimana cara mengetahui pesanan saya sudah siap diambil?</span>
                        <div class="icon-container">
                            <span class="icon-plus">+</span>
                            <span class="icon-minus">−</span>
                        </div>
                    </button>
                    <div class="faq-answer">
                        <p>Setelah pesanan Anda diproses, kami akan mengirim notifikasi melalui email bahwa barang sudah siap diambil di tempat yang sudah ditentukan.</p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFAQ(this)">
                        <span>4. Apakah bisa menitipkan orang lain untuk mengambil pesanan?</span>
                        <div class="icon-container">
                            <span class="icon-plus">+</span>
                            <span class="icon-minus">−</span>
                        </div>
                    </button>
                    <div class="faq-answer">
                        <p>Ya, Anda bisa menitipkan orang lain untuk mengambil pesanan dengan membawa bukti pemesanan dan identitas yang jelas.</p>
                    </div>
                </div>

                <!-- Arrow Down -->
                <div class="faq-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
            </div>
        </div>
    </main>

<!-- Footer -->

        <?php include '../../components/footer/footer.php'; ?> 

<!-- Scripts -->

        <script src="/front-end/global/scripts/loading-screen.js"></script>
    </body>
</html>