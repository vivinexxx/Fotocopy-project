## Description
This is a project built using the **CodeIgniter Framework**—a lightweight and powerful PHP framework. It’s ideal for building dynamic web applications quickly and efficiently. This template serves as a starting point for your next project, with pre-configured settings and an organized structure.

## Features
- MVC Architecture for clean and modular code.
- Lightweight and fast performance.
- Preconfigured routes and controllers.
- Secure input handling and form validation.
- Database integration with query builder support.

## Requirements
To run this project, ensure your environment meets the following requirements:
- **PHP** 7.4 or higher
- **Composer** installed
- A web server (e.g., Apache or Nginx)
- **MySQL** or any database supported by CodeIgniter

## Installation
Follow these steps to set up the project locally:

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/username/Fotcopy-project.git
   ```
2. **Navigate to the Project Directory**:
   ```bash
   cd codeigniter-project
   ```
3. **Install Dependencies**:
   If using Composer, install required dependencies:
   ```bash
   composer install
   ```
4. **Set Up Environment File**:
   - Copy `.env.example` to `.env`.
   - Update database configuration in the `.env` file:
     ```env
     database.default.hostname = localhost
     database.default.database = your_database_name
     database.default.username = your_username
     database.default.password = your_password
     database.default.DBDriver = MySQLi
     ```

5. **Run Database Migrations** (if applicable):
   ```bash
   php spark migrate
   ```

6. **Start the Development Server**:
   ```bash
   php spark serve
   ```
   The application will be accessible at `http://localhost:8080`.

## Usage
- Add your controllers in the `app/Controllers` directory.
- Define routes in `app/Config/Routes.php`.
- Use `app/Models` for database interaction.
- Customize views in `app/Views`.

## Contributing
We welcome contributions! Feel free to fork this repository, make changes, and submit a pull request. Please ensure your code follows the CodeIgniter guidelines.

## License
This project is licensed under the **MIT License**. See the [LICENSE](LICENSE) file for details.

