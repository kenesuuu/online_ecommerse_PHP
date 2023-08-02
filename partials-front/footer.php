

<div class="clearfix"></div>
<footer class="section-p1 ">
        <div class="col">
                <img src="../img/logo.png" width="100px" alt="">
                <h4>Contact</h4>
                <p><strong>Address:</strong> 2119 Recto Ave, Sampaloc, Manila, Philippines</p>
                <p><strong>Phone:</strong> 09662636144</p>
                <p><strong>Hours:</strong> 9am to 8pm</p>
                <div class="follow"> 
                    <h4>Follow us</h4>
                    <div class="icon">
                        <a href="https://web.facebook.com/AmariSilogan?mibextid=ZbWKwL&_rdc=1&_rdr"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/amari.silogan/?fbclid=IwAR1F_04ybDfHCr5uw4w46kzB7lLzb8tEeSdI71JgtvlIRDbuTl5pv7WaO-g"><i class="fab fa-instagram"></i></a>
                        <a href=""><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
        </div>

        <div class="col">
                <h4>About</h4>
                <a href="<?php echo SITEURL; ?>/nav/about.php">About us</a>
                <a href="../menu-food/payment.php">Payments</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms & Conditions</a>
                <a href="<?php echo SITEURL; ?>/nav/contact.php">Contact Us</a>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="<?php echo SITEURL; ?>/auth/sign-in.php">Sign In</a>
            <a href="#">Help</a>
        </div>
    </div>
    </footer>

    <section id="credits" class="section-p1">
        <p>@2023, Software Design Group 7</p>
    </section>
    
    <script type="text/javascript"> window.$crisp=[];window.CRISP_WEBSITE_ID="5038ffdc-a924-4ff5-ab8f-8f2b0c7a8b09";(function(){ d=document;s=d.createElement("script"); 
        s.src="https://client.crisp.chat/l.js"; s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})(); 
    </script>

    <script>
        const bar = document.getElementById('bar');
        const nav = document.getElementById('navbar');
        const close = document.getElementById('close');

        if (bar) {
            bar.addEventListener('click',()=> {
                nav.classList.add('active');
            })
        }

        if (close) {
            close.addEventListener('click',()=> {
                nav.classList.remove('active');
            })
        }

        function incrementQuantity() {
            var quantityInput = document.getElementById("quantity-input");
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }
        
        function decrementQuantity() {
            var quantityInput = document.getElementById("quantity-input");
            if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        }
  
    </script>

    <script src="../js/script.js"></script>