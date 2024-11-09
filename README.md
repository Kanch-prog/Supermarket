# Dynamic Web Application for Online Supermarket

![screencapture-localhost-supermarket-index-php-2024-11-09-16_42_31](https://github.com/user-attachments/assets/267d9156-369b-4264-8e82-f4dffc41e344)

![screencapture-localhost-supermarket-display-products-php-2024-11-09-16_42_50](https://github.com/user-attachments/assets/a4ca1588-eb70-4bb6-9412-1832c6056cfc)

![Uploading screencapture-localhost-supermarket-cart-display-php-2024-11-09-16_43_30.png…]()

![Uploading screencapture-localhost-supermarket-cart-display-php-2024-11-09-16_43_20.png…]()


## Overview
This project is a dynamic web application for an online supermarket. It provides customers with the ability to browse a range of products, add them to their shopping cart, and place orders. Administrators can manage product inventory, process orders, and oversee customer interactions.

## Features and Modules

### 1. User Management Module
- **Functionality**: Handles user-related tasks.
- **Features**:
  - User registration and login
  - Profile management (view and update personal information)
  - Password reset and management

### 2. Product Management Module
- **Functionality**: Manages product inventory.
- **Features**:
  - Addition, removal, and modification of products
  - Categorization and organization of products by type
  - Real-time product availability updates

### 3. Shopping Cart Module
- **Functionality**: Manages shopping cart for customers.
- **Features**:
  - Add, remove, and update items in the cart
  - Calculate the total price of items in the cart
  - Save cart state during user sessions

### 4. Order Management Module
- **Functionality**: Handles order processing.
- **Features**:
  - Allows administrators to view, process, and manage customer orders
  - Order status tracking for customers
  - Email notifications for order confirmations and updates

### 5. User Profile Module
- **Functionality**: Manages user profiles.
- **Features**:
  - Allows users to view and update personal information
  - Options to update address information and change passwords

## Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Additional**: Session management for user authentication and shopping cart persistence

## Getting Started

### Prerequisites
Ensure the following are installed on your system:
- **PHP** (version 7.4 or above)
- **MySQL** (version 5.7 or above)
- **Apache** or another web server

### Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/yourusername/online-supermarket.git
   cd online-supermarket

2. **Set up the Database**:
Set up the Database:

Create a MySQL database named online_supermarket.
Import the database schema from the database/online_supermarket.sql file:
bash
Copy code
mysql -u yourusername -p online_supermarket < database/online_supermarket.sql

## Contributing
Contributions are welcome! Please follow these steps to contribute:

1. Fork the repository.
2. Create a new branch (`feature/YourFeature`).
3. Commit your changes.
4. Open a pull request.

Thank you for using this online supermarket application! Feel free to reach out with any questions or suggestions.
