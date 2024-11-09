document.addEventListener('DOMContentLoaded', function() {
    const products = {
        dairy: [
            { src: 'images/items/dairy/pro-1.png', name: 'Milk', price: '$2.50' },
            { src: 'images/items/dairy/pro-2.png', name: 'Cheese', price: '$3.00' },
            { src: 'images/items/dairy/pro-3.png', name: 'Butter', price: '$4.00' },
            { src: 'images/items/dairy/pro-4.png', name: 'Yogurt', price: '$1.50' },
            { src: 'images/items/dairy/pro-5.png', name: 'Cream', price: '$2.00' },
            { src: 'images/items/dairy/pro-6.png', name: 'Ice Cream', price: '$5.00' }
        ],
        food: [
            { src: 'images/items/food/pro-1.png', name: 'CocaCola', price: '$1.00' },
            { src: 'images/items/food/pro-2.png', name: 'Grapes', price: '$2.00' },
            { src: 'images/items/food/pro-3.png', name: 'Carrot', price: '$3.00' },
            { src: 'images/items/food/pro-4.png', name: 'Rice', price: '$4.00' },
            { src: 'images/items/food/pro-5.png', name: 'Pasta', price: '$1.50' },
            { src: 'images/items/food/pro-6.png', name: 'Chips', price: '$3.50' }
        ],
        beauty: [
            { src: 'images/items/beauty/pro-1.png', name: 'Shampoo', price: '$6.00' },
            { src: 'images/items/beauty/pro-2.png', name: 'Conditioner', price: '$5.00' },
            { src: 'images/items/beauty/pro-3.png', name: 'Face Cream', price: '$7.00' },
            { src: 'images/items/beauty/pro-4.png', name: 'Sunscreen', price: '$8.00' },
            { src: 'images/items/beauty/pro-5.png', name: 'Lipstick', price: '$4.00' },
            { src: 'images/items/beauty/pro-6.png', name: 'Perfume', price: '$20.00' }
        ],
        furniture: [
            { src: 'images/items/furniture/pro-1.png', name: 'Sofa', price: '$300.00' },
            { src: 'images/items/furniture/pro-2.png', name: 'Dining Table', price: '$150.00' },
            { src: 'images/items/furniture/pro-3.png', name: 'Chair', price: '$50.00' },
            { src: 'images/items/furniture/pro-4.png', name: 'Bed', price: '$500.00' },
            { src: 'images/items/furniture/pro-5.png', name: 'Wardrobe', price: '$200.00' },
            { src: 'images/items/furniture/pro-6.png', name: 'Desk', price: '$100.00' }
        ],
        appliances: [
            { src: 'images/items/appliances/pro-1.png', name: 'Washing Machine', price: '$400.00' },
            { src: 'images/items/appliances/pro-2.png', name: 'Refrigerator', price: '$500.00' },
            { src: 'images/items/appliances/pro-3.png', name: 'Microwave', price: '$100.00' },
            { src: 'images/items/appliances/pro-4.png', name: 'Oven', price: '$250.00' },
            { src: 'images/items/appliances/pro-5.png', name: 'Dishwasher', price: '$300.00' },
            { src: 'images/items/appliances/pro-6.png', name: 'Blender', price: '$60.00' }
        ],
        cleaning: [
            { src: 'images/items/cleaning/pro-1.png', name: 'Detergent', price: '$5.00' },
            { src: 'images/items/cleaning/pro-2.png', name: 'Bleach', price: '$3.00' },
            { src: 'images/items/cleaning/pro-3.png', name: 'Floor Cleaner', price: '$4.00' },
            { src: 'images/items/cleaning/pro-4.png', name: 'Glass Cleaner', price: '$2.50' },
            { src: 'images/items/cleaning/pro-5.png', name: 'Sponges', price: '$1.50' },
            { src: 'images/items/cleaning/pro-6.png', name: 'Mop', price: '$10.00' }
        ]
    };

   // Select all elements with the class 'category-item' and store 
    const categoryItems = document.querySelectorAll('.category-item');

    // Get the element with the ID 'productRow' to display
    const productRow = document.getElementById('productRow');

    // Loop through each category item
    categoryItems.forEach(item => {
        // Add event listener to each category item
        item.addEventListener('mouseover', function() {
            // Get the value of the 'data-category' attribute of the hovered item
            const category = this.getAttribute('data-category');
            // Retrieve the products for this category from the 'products' object
            const categoryProducts = products[category];
            // Update the HTML content of the 'productRow' element
            productRow.innerHTML = categoryProducts.map(product => `
                <div class="col-md-2 product-card">
                    <img src="${product.src}" class="img-fluid" alt="${product.name}">
                    <p>${product.name}</p>
                    <p>${product.price}</p>
                </div>
            `).join(''); // Join the array of HTML strings into a single string
        });
    });

});
