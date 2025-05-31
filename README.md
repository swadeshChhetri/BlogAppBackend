## 🛠 Backend - Laravel API

The backend is powered by **Laravel**, a PHP framework that handles routing, authentication, database operations, and serves as the API for the frontend. It uses RESTful principles and interacts with a MySQL database.

### 🔧 Setup Instructions

1. Navigate to the backend folder:

```bash
cd backend
```

2. Install dependencies using Composer:

```bash
composer install
```

3. Create the `.env` file and generate the application key:

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure your database in the `.env` file, then run migrations:

```bash
php artisan migrate
```

5. Start the Laravel development server:

```bash
php artisan serve
```

6. API will be accessible at: [http://127.0.0.1:8000/api](http://127.0.0.1:8000/api)

---

## 🔗 Connecting Frontend to Backend

To connect the frontend with the backend API, configure your Vite environment:

In `frontend/.env`:

```
VITE_API_BASE_URL=http://127.0.0.1:8000/api
```

Make sure the Laravel backend allows CORS requests.

---

## 📄 License

This project is licensed under the MIT License.

## 🙋‍♂️ Author

Developed with ❤️ by **Swadesh**
