# Library Management System

This is a Library Management System built with Laravel, providing functionalities for managing books, users, borrow records, and book ratings. 
The system ensures that only registered users can borrow books and rate the books they have borrowed.

## Features
- **Admin Role**: A special role with elevated permissions for managing books, users, and overseeing system operations.
- **User Authentication**: Users can register, log in, and authenticate using jwt .
- **Book Management**: CRUD operations for managing books.
- **Borrow Records**: Track which user has borrowed which book, with details on borrow and return dates.
- **Book Ratings**: Users can rate the books they've borrowed, with a check to ensure they only rate books they've borrowed.
- **Custom Error Handling**: Clear and specific error messages are provided for validation failures.
- **Postman Collection for API Testing**: Included for easy API testing and includes pre-configured variables for `authToken` and `baseUrl`.

- [Installation](#installation)
 1. **Clone the repository:**
 
     ```bash
     git clone https://github.com/HusseinIte/LibraryManagementSystem.git
     cd library-management-system
     ```
 
 2. **Install dependencies:**
 
     ```bash
     composer install
     npm install
     ```
 
 3. **Copy the `.env` file:**
 
     ```bash
     cp .env.example .env
     ```
 
 4. **Generate an application key:**
 
     ```bash
     php artisan key:generate
     ```
 
 5. **Configure the database:**
 
     Update your `.env` file with your database credentials.
 
 6. **Run the migrations:**
 
     ```bash
     php artisan migrate --seed
     ```
 
 7. **Serve the application:**
 
     ```bash
     php artisan serve
     ```
## API Endpoints
### Authentication
### Books
### Users
### Borrow Records
### Ratings


## Postman Collection for API Testing

To make it easier to test the API, a Postman collection is provided with the project. This collection includes:

- **Pre-configured Variables**:
  - `authToken`: Stores the authentication token required for accessing protected endpoints.
  - `baseUrl`: Stores the base URL of the API, so you don't have to manually set it for each request.

### How to Use the Collection

1. **Import the Collection**:
   - Open Postman, click on the `Import` button, and select the provided `.json` collection file from the repository.
