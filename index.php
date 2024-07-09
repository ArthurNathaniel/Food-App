<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Menu</title>
    <!-- Include necessary CDNs and stylesheets -->
    <?php include 'cdn.php' ?>
    <link rel="stylesheet" href="./css/base.css">
</head>

<body>
    <div class="cart_items" id="cart_items">
    <div class="cart_height">
        
    </div>
        <!-- Cart items will be dynamically displayed here -->
        <div class="cart_closing">
            <p>
                <i class="fa-regular fa-circle-xmark close-icon" onclick="toggleCart()"></i>
            </p>
        </div>
    </div>
    <div class="all">
        <div class="navbar_all">
            <div class="toogle">
                <i class="fa-solid fa-bars-staggered"></i>
            </div>
            <div class="location">
                <p><i class="fa-solid fa-location"></i> Ghana</p>
            </div>
        </div>
        <div class="home_all">
            <div class="home_grid">
                <div class="home_name">
                    <p><span>Good Morning</span> Nathaniel</p>
                </div>
                <div class="profile_bg">
                </div>
            </div>
            <div class="swiper mySwiper2">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="home_swiper">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="home_swiper">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="home_swiper">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="home_swiper">
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="show_cart">
            <!-- Header with home, search, cart number, total price, and profile -->
            <div class="home"><span><i class="fa-solid fa-house"></i></span>Home</div>
            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="mycart" onclick="toggleCart()">
                <p><i class="fa-solid fa-cart-plus"></i> <span id="cartnumber">0</span></p>
            </div>
            <div class="totalss">
                <p>Total: GHS <span id="totalprice">0.00</span></p>
            </div>
            <div class="profile"></div>
        </div>

        <?php
        // Include database connection
        include 'db.php';

        // Fetch food items from the database
        $sql = "SELECT * FROM food_items";
        $result = mysqli_query($conn, $sql);

        // Display food items dynamically
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
        <div class="food_all">
            <div class="food_box">
                <div class="food_image">
                    <img src="' . $row['food_image'] . '" alt="">
                </div>
                <div class="food_details">
                    <div class="food_info">
                        <div class="food_name">
                            <p>' . $row['food_name'] . '</p>
                        </div>
                        <div class="price">
                            <p>GHS ' . $row['price'] . '</p>
                        </div>
                    </div>
                    <div class="span_order" data-id="' . $row['id'] . '" data-name="' . $row['food_name'] . '" data-price="' . $row['price'] . '" data-discount="' . $row['discount'] . '" data-image="' . $row['food_image'] . '">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                </div>
            </div>
        </div>';
        }
        ?>
    </div>

   
    <script src="./js/order.js"></script>
    <script src="./js/swiper.js"></script>
</body>

</html>
