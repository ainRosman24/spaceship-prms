# SPACESHIP X26: PASSENGER RESOURCE MANAGEMENT SYSTEM

Build a Passenger Resource Management System that allows Crew Leads to manage passengers/resources while allowing passengers to access permitted resources and track usage.

## 🚀 Features

*   Role-Based Access Control: Distinct interfaces and routing for Admins (Crew Leads) and Standard Users (Passengers).
*   Dynamic Clearance Tiers: Passengers are assigned tiered packages (Silver, Gold, Platinum) which restrict or grant access to specific ship resources.
*   Facility Access Scanner: Real-time access validation engine that logs interactions and denies unauthorized attempts.
*   Command Center Dashboard: A separated, optimized administrative panel featuring Chart.js data visualization, animated statistics, and paginated data tables.
*   Immersive Front-End: Custom-built UI utilizing Bootstrap 5, Glassmorphism, CSS3 animations (holographic badges, drifting starfields), and a stark black-and-white color grading.

## 🛠️ Tech Stack

*   **Framework: Laravel (PHP)
*   **Database: MySQL
*   **Frontend: Blade Templating, Bootstrap 5, Custom CSS3
*   **Data Visualization: Chart.js

## ⚙️ Installation & Setup

To run this project locally for evaluation, follow these steps:

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/YourUsername/spaceship-prms.git](https://github.com/YourUsername/spaceship-prms.git)
   cd spaceship-prms

```

2. **Install PHP and Node dependencies:**
```bash
composer install
npm install
npm run build

```


3. **Environment Setup:**
Copy the example environment file and generate a new application key.
```bash
cp .env.example .env
php artisan key:generate

```


4. **Database Configuration:**
Update your `.env` file with your local MySQL database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spaceship_prms
DB_USERNAME=root
DB_PASSWORD=

```


5. **Run Migrations and Seeders:**
*Note: Running the seeders is highly recommended as it will populate the tiers, facilities, and provide instant testing accounts.*
```bash
php artisan migrate --seed

```


6. **Serve the Application:**
```bash
php artisan serve

```



## 🧪 Testing Credentials

If you ran the database seeders, you can log in immediately using the following test accounts:

**Crew Lead (Admin Access):**

* **Email:** alpha@x26.com
* **Password:** password123

**Passenger (Platinum Access):**

* **Email:** john@earth.com
* **Password:** password123

```

Just remember to change `YourUsername` in the clone link to your actual GitHub username before you save it!

```