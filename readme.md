## Subscription Service - Backend

This project is the backend of a subscription management application, developed using the Laravel framework. It provides a RESTful API for the frontend, managing users, subscription plans, contracts, and payments. The application uses PostgreSQL as its database and follows best architecture practices by using Resources for JSON response formatting, Requests for data validation, and Services to centralize business logic.

### Technologies Used

* PHP 8+
* Laravel 9
* MySQL (or another relational database)
* Laravel Resources: For API JSON response formatting
* Laravel Requests: For HTTP request validation
* Service Layer: To encapsulate business logic

### Features

1. User Registration
2. Plan Listing
3. Plan Subscription
4. Plan Switching

### Installation and Setup

Follow the steps below to set up and run the backend locally.

#### Step by Step

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/your-repository.git
   ```
2. Navigate to the backend directory:

   ```bash
   cd your-repository/backend
   ```
3. Install project dependencies:

   ```bash
   composer install
   ```
4. Database Configuration:
   Configure the `.env` file with PostgreSQL database details.
5. Generate the application key:

   ```bash
   php artisan key:generate
   ```
6. Run the database migrations:

   ```bash
   php artisan migrate
   ```
7. Start the development server:

   ```bash
   php artisan serve
   ```

### Example: How the system handles plan switching

* Current plan: R\$ 100.00/month
* Subscription date: 09/01/2023
* Switch date: 09/15/2023, to a R\$ 200.00/month plan
* Credit calculation: The system calculates that the user used half of the current plan’s month (15 days), generating a credit of R\$ 50.00. The new plan costs R\$ 200.00, so the user pays only R\$ 150.00.
* This logic is handled in the Service layer, ensuring that the backend keeps business rules separated from the controller layer.
