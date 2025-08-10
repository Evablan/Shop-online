# 🕯️ Laravel Candles Store

A modern e-commerce platform for candles built with Laravel 11, featuring a beautiful responsive design and comprehensive product management system.

## 📋 Overview

This project is a **candle store web application** that allows users to browse, view, and manage candle products. The application is built with Laravel and features a clean, modern interface using Bootstrap 5.

## ✨ Features

### ✅ Currently Implemented

- **Complete CRUD Operations** for candle products
- **Product Management** with specific candle attributes:
  - Name, Aroma, Color, Size, Material
  - Description, Price, Product Images
- **Responsive Design** using Bootstrap 5
- **Image Upload & Storage** with Laravel's file system
- **Form Validation** with error handling
- **Modern UI/UX** with Font Awesome icons
- **Layout System** with reusable components

### 🎨 Product Attributes

Each candle product includes:
- **Name**: Product name
- **Aroma**: Scent description (Lavender, Vanilla, Cinnamon, etc.)
- **Color**: Candle color
- **Size**: Small, Medium, Large
- **Material**: Soy wax, Beeswax, Paraffin
- **Description**: Detailed product information
- **Price**: Product pricing
- **Image**: Product photos

## 🛠️ Technologies Used

- **Backend**: Laravel 11 (PHP Framework)
- **Frontend**: Bootstrap 5, Font Awesome
- **Database**: SQLite (development)
- **Template Engine**: Blade
- **File Storage**: Laravel Storage System

## 📦 Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js (optional, for frontend assets)

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/tienda-online.git
   cd tienda-online
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Storage link (for images)**
   ```bash
   php artisan storage:link
   ```

6. **Start the development server**
   ```bash
   php artisan serve
   ```

7. **Access the application**
   - Open your browser and go to `http://localhost:8000`

## 🚀 Usage

### Product Management

1. **View Products**: Navigate to the main page to see all available candles
2. **Create Product**: Click "New Product" to add a new candle
3. **Edit Product**: Use the edit button on any product card
4. **View Details**: Click "View" to see detailed product information
5. **Delete Product**: Use the delete button (with confirmation)

### Adding Products

When creating or editing a candle, you can specify:
- Product name and description
- Aroma and color
- Size (Small, Medium, Large)
- Material type
- Price
- Product image

## 📁 Project Structure

```
tienda-online/
├── app/
│   ├── Http/Controllers/
│   │   └── ProductController.php
│   └── Models/
│       └── Product.php
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       └── products/
│           ├── index.blade.php
│           ├── create.blade.php
│           ├── edit.blade.php
│           └── show.blade.php
└── routes/
    └── web.php
```

## 🔄 Current Status

### ✅ Completed Features
- [x] Product CRUD operations
- [x] Image upload and storage
- [x] Responsive design
- [x] Form validation
- [x] Database structure
- [x] Basic navigation
- [x] Product listing with cards
- [x] Bootstrap styling

### 🚧 In Progress / Planned Features
- [ ] User authentication system
- [ ] Shopping cart functionality
- [ ] Product search and filtering
- [ ] Product categories
- [ ] User reviews and ratings
- [ ] Admin panel
- [ ] Order management
- [ ] Payment integration
- [ ] Email notifications
- [ ] Product pagination
- [ ] Advanced image gallery
- [ ] Wishlist functionality

## 🎯 Next Steps

The project is currently in **active development**. The next priorities include:

1. **User Authentication** - Login/register system
2. **Shopping Cart** - Add to cart functionality
3. **Search & Filters** - Find products by aroma, color, size, etc.
4. **Admin Panel** - Enhanced product management
5. **Payment Integration** - Stripe/PayPal integration

## 🤝 Contributing

This is a learning project, but contributions are welcome! Feel free to:

- Report bugs
- Suggest new features
- Submit pull requests
- Improve documentation

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Author

**Eva Blanco**
- Learning Laravel development
- Building e-commerce applications
- Focus on clean, maintainable code

---

**Note**: This project is currently under development and may have incomplete features or bugs. It's designed as a learning exercise for Laravel development and e-commerce functionality.
