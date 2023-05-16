<?php
if (isset($_GET['login'])) {
    if ($_GET['login'] == 1) {
        echo "<script type='text/javascript'>alert('Login successfully!');</script>";
    } elseif ($_GET['login'] == -1) {
        echo "<script type='text/javascript'>alert('Login unsuccessfully!');</script>";
    }
}

if (isset($_GET['register'])) {
    if ($_GET['register'] == 1) {
        echo "<script type='text/javascript'>alert('Register successfully!');</script>";
    } elseif ($_GET['register'] == -1) {
        echo "<script type='text/javascript'>alert('Register unsuccessfully!');</script>";
    }
}

if (isset($_GET['resultAddCart'])) {
    if ($_GET['resultAddCart'] == -1) {
        echo "<script type='text/javascript'>alert('We are sorry! Your product choose is out of stock. Pls keep enjoy our store! Tks');</script>";
    }
}
?>

<!-- Footer-->
<footer>
    <div class="container-fluid">
        <!-- Contact -->
        <div class="contact">
            <div class="row">
                <div class="col-lg-4">
                    <a href="index.php" class="mb-4" style="display: inline-block;">
                        <img src="https://cdn.shopify.com/s/files/1/0076/1708/5530/files/logo_360x.png?v=1609091045" alt="logo-img" class="img-fluid logo-img">
                    </a>
                    <p class="my-4 pr-2">2593 Timbercrest Road, Chisana, Alaska Badalas
                        United State,</p>
                    <p style="margin: 0;">+ (00) 003.526.5244</p>
                    <a href="#" class="website-link">uneoxfurniture@onea.com</a>
                </div>
                <div class="col-lg-2">
                    <p class="contact-list-title">Footer Menu</p>
                    <ul style="list-style: none;">
                        <li class="list-item"><a href="#">Returns Policy</a></li>
                        <li class="list-item"><a href="#">Track Your Order</a></li>
                        <li class="list-item"><a href="#">Shipping & Delivery</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <p class="contact-list-title">Main Menu</p>
                    <ul style="list-style: none;">
                        <li class="list-item"><a href="#">Layout</a></li>
                        <li class="list-item"><a href="#">Shop</a></li>
                        <li class="list-item"><a href="#">Lookbook</a></li>
                        <li class="list-item"><a href="#">Blog</a></li>
                        <li class="list-item"><a href="#">Page</a></li>
                        <li class="list-item"><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <p class="contact-list-title">Be In The Know</p>
                    <ul style="list-style: none;">
                        <li class="list-item"><a href="#">Promotions, new products and sales. Directly to your
                                inbox.</a></li>
                        <li class="list-item">
                            <input type="text" placeholder="Your email" class="input-email"> <button class="btn-subscribe">SUBSCRIBE</button>
                        </li>
                        <li class="list-item">
                            <ul class="footer-media">
                                <li class="list-item1"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="list-item1"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li class="list-item1"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                                <li class="list-item1"><a href="#"><i class="fab fa-instagram-square"></i></a>
                                </li>
                                <li class="list-item1"><a href="#"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">&copy; 2021, <span><a href="#">Uneo</a></span>. <span><a href="#">Powered
                            by
                            Shopify</a></span></div>
                <div class="col-lg-6 d-flex justify-content-end">
                    <img src="https://cdn.shopify.com/s/files/1/0076/1708/5530/files/paypal_400x.png?v=1609092737" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./public/js/script.js"></script>
</body>

</html>