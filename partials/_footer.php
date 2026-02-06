<style>
    .footer-dark {
        background-color: #1a1a1a; /* Hitam soft, tidak terlalu pekat */
        color: #b0b0b0; /* Abu-abu muda agar tidak terlalu kontras menyakitkan mata */
    }
    .footer-dark h5 {
        color: #ffc107; /* Kuning Bootstrap (Warning) */
        font-weight: 700;
        margin-bottom: 20px;
    }
    .footer-link {
        color: #b0b0b0;
        text-decoration: none;
        transition: all 0.3s ease;
        display: block;
        margin-bottom: 10px;
    }
    .footer-link:hover {
        color: #ffc107; /* Berubah jadi kuning saat disentuh */
        text-decoration: none;
        padding-left: 5px; /* Efek geser sedikit */
    }
    .social-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        background: #333;
        color: #fff;
        border-radius: 50%;
        margin-right: 10px;
        transition: 0.3s;
        text-decoration: none;
    }
    .social-btn:hover {
        background: #ffc107; /* Background kuning saat hover */
        color: #000; /* Ikon jadi hitam */
    }
    .footer-bottom {
        background-color: #000000; /* Hitam pekat untuk baris copyright */
        padding: 20px 0;
        border-top: 1px solid #333;
    }
</style>

<footer class="footer-dark mt-5">
    <div class="container py-5">
        <div class="row">
            
            <div class="col-md-5 mb-4">
                <h5>Dtastyum</h5>
                <p class="small" style="line-height: 1.8;">
                    Nikmati sensasi rasa terbaik dari dapur kami. Kami menyajikan makanan 
                    dengan bahan berkualitas tinggi yang dipadukan dengan resep rahasia 
                    untuk kepuasan Anda.
                </p>
                <div class="mt-4">
                    <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-btn"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <h5>Quick Links</h5>
                <a href="index.php" class="footer-link">Home</a>
                <a href="about.php" class="footer-link">Our Menu</a>
                <a href="viewCart.php" class="footer-link">My Cart</a>
                <a href="contact.php" class="footer-link">Contact Us</a>
            </div>

            <div class="col-md-4 mb-4">
                <h5>Contact Info</h5>
                <p class="small mb-2"><i class="fas fa-map-marker-alt text-warning mr-2"></i> Jakarta Selatan, Indonesia</p>
                <p class="small mb-2"><i class="fas fa-envelope text-warning mr-2"></i> support@dtastyum.com</p>
                <p class="small mb-2"><i class="fas fa-phone-alt text-warning mr-2"></i> +62 812-3456-7890</p>
                <p class="small"><i class="fas fa-clock text-warning mr-2"></i> 10:00 - 22:00 WIB</p>
            </div>

        </div>
    </div>

    <div class="footer-bottom text-center">
        <div class="container">
            <p class="mb-0 small text-white-50">
                &copy; <?php echo date("Y"); ?> <strong>Dtastyum</strong>. All Rights Reserved.
            </p>
        </div>
    </div>
</footer>