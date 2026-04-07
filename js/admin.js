document.getElementById('add-product-form').addEventListener('submit', function(event) {
    event.preventDefault(); 

    
    const name = document.getElementById('new-name').value;
    const price = document.getElementById('new-price').value;
    const imageName = document.getElementById('new-image').value;

    
    let savedProducts = JSON.parse(localStorage.getItem('hosteldrop_products')) || [];

    
    const newProduct = {
        id: Date.now(), 
        name: name,
        price: parseInt(price),
        image: "images/" + imageName 
    };

    
    savedProducts.push(newProduct);
    localStorage.setItem('hosteldrop_products', JSON.stringify(savedProducts));

    
    alert("Success! " + name + " has been added to the storefront.");
    document.getElementById('add-product-form').reset();
});