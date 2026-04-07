<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HostelDrop - Student Delivery</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        
        html { scroll-behavior: smooth; }
        
        
        .info-section { background-color: white; padding: 60px 20px; text-align: center; border-top: 1px solid #eee; }
        .info-section.alt-bg { background-color: #f9f9f9; }
        .info-container { max-width: 800px; margin: 0 auto; }
        .info-container h2 { color: var(--primary-color, #ff4757); margin-bottom: 20px; }
        .info-container p { font-size: 18px; line-height: 1.6; color: #555; margin-bottom: 30px; }
        .contact-form { display: flex; flex-direction: column; gap: 15px; max-width: 500px; margin: 0 auto; }
        .contact-form input, .contact-form textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        .contact-form button { background-color: var(--secondary-color, #333); color: white; border: none; padding: 15px; border-radius: 8px; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>

    
        
       
    <header style="display: flex; justify-content: space-between; align-items: center; padding: 15px 20px; background: white; border-bottom: 1px solid #eee; position: sticky; top: 0; z-index: 100;">
        
        
        <div style="display: flex; align-items: center; gap: 30px;">
            <h1 style="margin: 0; color: var(--primary-color, #ff4757);">HostelDrop 🍜</h1>
            <nav style="display: flex; gap: 15px;">
                <button class="chip active" style="background: none; border: none; color: #555; font-weight: bold; cursor: pointer;">All Items</button>
                <button class="chip" style="background: none; border: none; color: #555; font-weight: bold; cursor: pointer;">Snacks</button>
                <button class="chip" style="background: none; border: none; color: #555; font-weight: bold; cursor: pointer;">Beverages</button>
                <button class="chip" style="background: none; border: none; color: #555; font-weight: bold; cursor: pointer;">Essentials</button>
                
                <a href="#about" style="color: #555; text-decoration: none; font-weight: bold; margin-left: 20px;">About</a>
                <a href="#contact" style="color: #555; text-decoration: none; font-weight: bold;">Contact</a>
            </nav>
        </div>
        
        
        <div style="flex: 1; max-width: 300px; margin: 0 20px; position: relative;">
            <input type="text" id="searchInput" placeholder="Search for snacks..." style="width: 100%; padding: 10px 15px 10px 40px; border: 1px solid #ddd; border-radius: 20px; font-size: 16px; outline: none; box-sizing: border-box; transition: 0.2s; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
            <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #888; font-size: 16px;">🔍</span>
        </div>
        
        
        <div style="display: flex; align-items: center; gap: 20px;">
            <a href="admin.php" style="color: var(--primary-color, #ff4757); text-decoration: none; font-weight: bold; border: 2px solid var(--primary-color, #ff4757); padding: 5px 15px; border-radius: 8px;">⚙️ Admin</a>
            <div class="cart-icon-container" style="cursor: pointer; font-size: 1.2rem;">
                🛒 <span class="cart-badge" id="cartBadge">0</span>
            </div>
        </div>
    </header>
       
        
        

    <main style="padding: 20px; max-width: 1200px; margin: 0 auto; display: flex; gap: 40px;">
        
        
        <div style="flex: 2;">
            <section style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <h2 style="color: var(--primary-color, #ff4757); margin-top: 0;">How to Order</h2>
                <ol style="line-height: 1.8; font-size: 16px; color: #555;">
                    <li>Browse our available snacks below.</li>
                    <li>Add items to your cart.</li>
                    <li>Enter your Hostel Block and Room Number in the cart section.</li>
                    <li>Click Checkout and we will deliver it directly to your door!</li>
                </ol>
            </section>

            <h2>Available Items</h2>
            
            <div class="products-grid" id="products-container" style="display: flex; gap: 20px; flex-wrap: wrap;">
                
            </div>
        </div>

        
        <div style="flex: 1;">
            <section id="cart-section" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); position: sticky; top: 90px;">
                <h2 style="margin-top:0;">🛒 Your Cart</h2>
                
                
                <ul id="cart-items" style="list-style: none; padding: 0; margin-bottom: 20px;">
                    
                </ul>
                
                <div style="padding-top: 15px; border-top: 2px solid #eee;">
                    
                    <h3>Total: ₹<span id="displayTotal">0</span></h3>
                    
                    
                    <input type="text" id="block" placeholder="Hostel Block (e.g. A)" style="padding: 12px; width: 100%; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;" required>
                    <input type="text" id="room" placeholder="Room Number (e.g. 104)" style="padding: 12px; width: 100%; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;" required>
                    
                    <button id="checkoutBtn" style="background: var(--primary-color, #ff4757); color: white; padding: 15px 20px; border: none; width: 100%; font-size: 18px; font-weight: bold; cursor: pointer; border-radius: 5px;">Place Order</button>
                </div>
            </section>
        </div>

    </main>

    
    <section id="about" class="info-section">
        <div class="info-container">
            <h2>About HostelDrop</h2>
            <p>HostelDrop was built to help the students. We know the struggle of late-night study sessions, sudden cravings, and empty hostel canteens. Our mission is to deliver your favorite snacks, cold beverages, and daily essentials directly to your hostel block within minutes. Fast, reliable, and always there when you need it most!</p>
        </div>
    </section>

    
    <section id="contact" class="info-section alt-bg">
        <div class="info-container">
            <h2>Contact Us</h2>
            <p>Have an issue with your order or want to suggest a new snack for our inventory? Send us a message!</p>
            
                       
            <form id="contactForm" class="contact-form">
                <input type="text" id="contactName" placeholder="Your Name" required>
                <input type="text" id="contactRoom" placeholder="Hostel Block & Room Number" required>
                <textarea id="contactMessage" placeholder="How can we help you?" rows="4" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </section>

   
    <footer style="background: var(--secondary-color, #333); color: white; text-align: center; padding: 20px;">
        <p style="margin: 0;">&copy; 2026 HostelDrop. Built for Hostel Students.</p>
    </footer>

    
    <div id="toast-container"></div>
    <script src="js/script.js"></script>
</body>
</html>