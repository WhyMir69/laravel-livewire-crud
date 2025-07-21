# Laravel Livewire CRUD with Image Upload

A modern Laravel application using Livewire for reactive CRUD operations with image upload functionality.

## Features

### Product Management
- ✅ Create, Read, Update, Delete products
- ✅ Real-time search functionality
- ✅ Image upload with preview
- ✅ Grid layout with product cards
- ✅ Responsive design with Bootstrap 5
- ✅ Form validation with error handling
- ✅ File upload with progress indication

### Image Upload Features
- **File Types**: JPG, PNG, GIF supported
- **File Size**: Maximum 2MB per image
- **Storage**: Images stored in `storage/app/public/products/`
- **Preview**: Real-time image preview during upload
- **Validation**: Server-side image validation
- **Cleanup**: Automatic deletion of old images when updated

### Product Schema
- `product_code` (unique string)
- `name` (string)
- `quantity` (integer)
- `price` (decimal)
- `description` (text)
- `image` (string, nullable)

## Installation

1. Clone the repository
2. Install dependencies: `composer install`
3. Set up environment: `cp .env.example .env`
4. Generate application key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Seed database: `php artisan db:seed`
7. Create storage link: `php artisan storage:link`
8. Start server: `php artisan serve`

## Usage

1. **Adding Products**: Click "Add New Product" to open the modal form
2. **Image Upload**: Use the file input to select an image (max 2MB)
3. **Preview**: See uploaded image preview before saving
4. **Editing**: Click "Edit" on any product card to modify
5. **Deleting**: Click "Delete" to remove a product (images are automatically deleted)
6. **Searching**: Use the search bar to find products by name or code

## Technical Details

### Livewire Components
- `ProductManager`: Main component handling CRUD operations
- `WithFileUploads`: Trait for handling file uploads
- `WithPagination`: Trait for pagination

### File Storage
- Images stored in `storage/app/public/products/`
- Symbolic link created from `public/storage` to `storage/app/public`
- Automatic cleanup of old images on update/delete

### Validation
- Image files: Required format validation
- File size: Maximum 2MB
- Product code: Unique validation
- All fields: Required field validation

## Requirements

- PHP 8.2+
- Laravel 12+
- Livewire 3.6+
- SQLite (default) or MySQL

## File Structure

```
app/
├── Livewire/
│   └── ProductManager.php
├── Models/
│   └── Product.php
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── livewire/
│   │   └── product-manager.blade.php
│   └── products/
│       └── index.blade.php
storage/
└── app/
    └── public/
        └── products/          # Image uploads
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is open-sourced software licensed under the MIT license.
