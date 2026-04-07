
let cart = []; 
let totalPrice = 0;


function loadProducts(category) {
    
    const url = `http://localhost/hosteldrop/hosteldrop/api/get_products.php?category=${encodeURIComponent(category)}`;
    
    
    fetch(url)
        .then(response => response.json())
        .then(products => {
            const container = document.getElementById('products-container');
            let html = '';
            
            
            if (products.length === 0) {
                container.innerHTML = `<p style="text-align: center; width: 100%; color: #666; font-size: 18px; margin-top: 40px; padding: 40px; background: white; border-radius: 8px;">No items found in the "${category}" category right now.</p>`;
                return;
            }

            
            products.forEach(product => {
                html += `
                    <div class="product-card">
                        <img src="${product.image}" alt="${product.name}" class="product-image">
                        <div class="product-info">
                            <h3 class="product-title">${product.name}</h3>
                            <p class="product-price">₹${product.price}</p>
                            <button class="add-btn" onclick="addToCart(${product.id}, '${product.name}', ${product.price})">Add to Cart</button>
                        </div>
                    </div>
                `;
            });
            
            
            container.innerHTML = html;
        })
        .catch(error => {
            console.error("Error loading products:", error);
            document.getElementById('products-container').innerHTML = "<p style='text-align: center; color: red;'>Failed to load products from database.</p>";
        });
}


window.onload = function() {
    loadProducts('All Items');
};



document.addEventListener('DOMContentLoaded', () => {
    
    const chips = document.querySelectorAll('.chip');
    
    chips.forEach(chip => {
        chip.addEventListener('click', function() {
            
            
            chips.forEach(c => c.classList.remove('active'));
            
            
            this.classList.add('active');
            
            
            const selectedCategory = this.innerText.trim();
            
            
            loadProducts(selectedCategory);
        });
    });
});


function addToCart(id, name, price) {
   
    cart.push({ id, name, price });
    
    
    totalPrice += parseFloat(price);
    
    
    const cartList = document.getElementById('cart-items');
    const li = document.createElement('li');
    li.className = 'cart-item';
    li.innerHTML = `<span>${name}</span> <span>₹${price}</span>`;
    cartList.appendChild(li);
    
    
    document.getElementById('displayTotal').innerText = totalPrice;
    
    
    document.getElementById('cartBadge').innerText = cart.length;
}


function placeOrder() {
    const blockInput = document.getElementById('block').value.trim();
    const roomInput = document.getElementById('room').value.trim();

    
    if (blockInput === "" || roomInput === "") {
       showToast("Please enter your Hostel Block and Room Number.", "error");
        return; 
    }
    
    
    if (cart.length === 0) {
        showToast("Your cart is empty! Please add items first.", "error");
        return;
    }

    
    const orderData = {
        block: blockInput,
        room: roomInput,
        totalPrice: totalPrice,
        items: cart
    };

    
    fetch('http://localhost/hosteldrop/hosteldrop/api/place_order.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(orderData)
    })
    .then(response => response.text()) 
    .then(data => {
        console.log("Server Response:", data);
        try {
            const result = JSON.parse(data);
            if (result.status === "success" || data.includes("success")) {
                showToast("Order Placed Successfully! Your delivery is on the way.", "success");
                
                
                cart = [];
                totalPrice = 0;
                document.getElementById('cart-items').innerHTML = '';
                document.getElementById('displayTotal').innerText = '0';
                document.getElementById('cartBadge').innerText = '0';
                document.getElementById('block').value = '';
                document.getElementById('room').value = '';
            } else {
                showToast("Server said: " + result.message, "error");
            }
        } catch (error) {
            showToast("Order processed, but server returned weird text: " + data, "error");
        }
    })
    .catch(error => console.error("Fetch API Error:", error));
}


document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('checkoutBtn').addEventListener('click', function(event) {
        event.preventDefault(); 
        placeOrder();
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.getElementById('contactForm');
    
    if(contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault(); 
            
            
            const messageData = {
                name: document.getElementById('contactName').value.trim(),
                room: document.getElementById('contactRoom').value.trim(),
                message: document.getElementById('contactMessage').value.trim()
            };
            
            
            fetch('http://localhost/hosteldrop/hosteldrop/api/send_message.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(messageData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    showToast("Message sent! We will get back to you soon.", "success");
                    contactForm.reset(); 
                } else {
                    showToast("Server error: Could not send message.", "error");
                }
            })
            .catch(error => {
                console.error("Error:", error);
                showToast("Connection error.", "error");
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            
            const searchTerm = this.value.toLowerCase().trim();
            
            
            const productCards = document.querySelectorAll('.product-card');
            

            productCards.forEach(card => {
                
                const title = card.querySelector('.product-title').innerText.toLowerCase();
                
                
                if (title.includes(searchTerm)) {
                    card.style.display = 'block'; 
                } else {
                    card.style.display = 'none'; 
                }
            });
        });
    }
});