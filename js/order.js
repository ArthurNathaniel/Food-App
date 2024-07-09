// Initialize empty cart array and total price variable
let cart = [];
let totalPrice = 0;

// Add event listeners to "Add to Cart" buttons
document.querySelectorAll('.span_order').forEach(button => {
    button.addEventListener('click', function() {
        const itemId = this.getAttribute('data-id');
        const itemName = this.getAttribute('data-name');
        const itemPrice = parseFloat(this.getAttribute('data-price'));
        const itemDiscount = parseFloat(this.getAttribute('data-discount'));
        const itemImage = this.getAttribute('data-image');
        addToCart(itemId, itemName, itemPrice, itemDiscount, itemImage);
    });
});

// Function to add item to cart
function addToCart(itemId, itemName, itemPrice, itemDiscount, itemImage) {
    const existingItem = cart.find(item => item.id === itemId);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: itemId,
            name: itemName,
            price: itemPrice,
            discount: itemDiscount,
            image: itemImage,
            quantity: 1
        });
    }
    updateCart(); // Update cart display
}

// Function to update cart display
function updateCart() {
    const cartItemsContainer = document.getElementById('cart_items');
    cartItemsContainer.innerHTML = ''; // Clear previous cart items
    totalPrice = 0;

    // Loop through cart items and display them
    cart.forEach(item => {
        const itemTotalPrice = item.quantity * item.price * (1 - item.discount / 100);
        totalPrice += itemTotalPrice;

        cartItemsContainer.innerHTML += `
   
        <div class="cart_item food_box" onTouchStart="handleTouchStart(event)" onTouchMove="handleTouchMove(event, '${item.id}')">
            <div class="cart_one">
                <img src="${item.image}" alt="${item.name}">
            </div>
            <div class="cart_flex">
                <div class="food_info">
                    <div>${item.name}</div>
                 
                </div>
                <div>
                   <div class="price">GHS ${item.price.toFixed(2)} </div>
                    
                </div>
            </div>
            <button class="quantity-btn" onclick="decreaseQuantity('${item.id}')"><i class="fa-solid fa-minus"></i></button>
                    <span class="cart_quantity">${item.quantity}</span>
                    <button class="quantity-btn" onclick="increaseQuantity('${item.id}')"><i class="fa-solid fa-plus"></i></button>
                   <i class="fa-solid fa-trash-can" onclick="removeItem('${item.id}')" "></i>
        </div>

        `;
    });

    // Display total price
    const vat = totalPrice * 0.125;
    const nhil = totalPrice * 0.025;
    const getFundLevy = totalPrice * 0.025;
    const covidLevy = totalPrice * 0.01;
    const totalTax = vat + nhil + getFundLevy + covidLevy;
    const grandTotal = totalPrice + totalTax;

    cartItemsContainer.innerHTML += `
  <div class=" amount_info">
        <div class="sub">Subtotal: GHS ${totalPrice.toFixed(2)}</div>
        <div class="sub" >VAT (12.5%): GHS ${vat.toFixed(2)}</div>
        <div class="sub" >NHIL (2.5%): GHS ${nhil.toFixed(2)}</div>
        <div class="sub" >GetFund Levy (2.5%): GHS ${getFundLevy.toFixed(2)}</div>
        <div class="sub" >COVID-19 Levy (1%): GHS ${covidLevy.toFixed(2)}</div>
        <div class="sub" ><b>Grand Total:</b> GHS ${grandTotal.toFixed(2)}</div>
        <button>Proceed To Checkout</button>
    </div>
    `;

    // Add a closing button
    cartItemsContainer.innerHTML += `
    <div class="cart_closing">
        <button class="close-button" onclick="toggleCart()"><i class="fa-solid fa-chevron-left"></i></button>
        <h4>Your Order</h4>
    </div>
    `;

    // Update cart number and total price display
    document.getElementById('cartnumber').textContent = cart.length;
    document.getElementById('totalprice').textContent = grandTotal.toFixed(2);
}

// Function to decrease quantity
function decreaseQuantity(itemId) {
    const cartItem = cart.find(item => item.id === itemId);
    if (cartItem && cartItem.quantity > 1) {
        cartItem.quantity -= 1;
        updateCart(); // Update cart display
    }
}

// Function to increase quantity
function increaseQuantity(itemId) {
    const cartItem = cart.find(item => item.id === itemId);
    if (cartItem) {
        cartItem.quantity += 1;
        updateCart(); // Update cart display
    }
}

// Function to remove item from cart
function removeItem(itemId) {
    cart = cart.filter(item => item.id !== itemId);
    updateCart(); // Update cart display
}

// Function to toggle cart display
function toggleCart() {
    const cartItemsContainer = document.getElementById('cart_items');
    cartItemsContainer.classList.toggle('active');
}

// Swipe handling
let startX;

function handleTouchStart(event) {
    startX = event.touches[0].clientX;
}

function handleTouchMove(event, itemId) {
    const currentX = event.touches[0].clientX;
    const diffX = startX - currentX;

    if (diffX > 50) {
        // Swipe left detected
        document.getElementById(`delete_${itemId}`).style.display = 'block';
    } else if (diffX < -50) {
        // Swipe right detected
        document.getElementById(`delete_${itemId}`).style.display = 'none';
    }
}