# Docker Setup Instructions for WordPress Project

This guide will help you run the WordPress project using Docker containers.

## Prerequisites

- Docker Desktop installed and running
- Docker Compose (included with Docker Desktop)

## Project Structure

```
.
├── Dockerfile
├── docker-compose.yml
├── .dockerignore
├── wp-config.php (configured for Docker)
├── mysql-init/
│   ├── 01-import-database.sh
│   └── kqhfawgrhosting_wp572.sql
└── [WordPress files...]
```

## Quick Start

### 1. Start the Containers

Open a terminal in the project root directory and run:

```bash
docker compose up -d
```

This command will:
- Build the WordPress container
- Start MySQL container with database initialization
- Start WordPress container
- Start phpMyAdmin container
- Automatically import the database dump on first run

### 2. Wait for Services to Start

The first startup may take a few minutes as:
- MySQL initializes and creates the database
- The SQL dump file is imported
- WordPress connects to the database

You can monitor the logs with:

```bash
docker compose logs -f
```

Press `Ctrl+C` to exit the log view.

### 3. Access the Services

Once all containers are running:

- **WordPress Site**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081

## Verifying Database Import

### Method 1: Using phpMyAdmin

1. Open http://localhost:8081 in your browser
2. Login with:
   - **Server**: `mysql`
   - **Username**: `root`
   - **Password**: `root`
3. Select the `wordpress` database from the left sidebar
4. You should see all the WordPress tables (wpgi_*)

### Method 2: Using Docker Exec

```bash
# Connect to MySQL container
docker exec -it wordpress_mysql mysql -u root -proot

# In MySQL prompt, run:
USE wordpress;
SHOW TABLES;

# You should see all WordPress tables
# Exit MySQL: type 'exit' or press Ctrl+D
```

### Method 3: Check Container Logs

```bash
# Check MySQL container logs for import confirmation
docker compose logs mysql | grep -i "import\|database"
```

## Accessing WordPress Admin

1. Go to http://localhost:8080/wp-admin
2. Use your existing WordPress admin credentials (from the original site)
3. If you don't know the credentials, you can reset them via MySQL:

```bash
# Connect to MySQL
docker exec -it wordpress_mysql mysql -u root -proot wordpress

# Find admin user (replace 'admin' with your username if different)
SELECT user_login, user_email FROM wpgi_users WHERE user_login = 'admin';

# Reset password (replace 'admin' and 'newpassword' as needed)
UPDATE wpgi_users SET user_pass = MD5('newpassword') WHERE user_login = 'admin';
```

## Useful Docker Commands

### View Running Containers
```bash
docker compose ps
```

### View Logs
```bash
# All services
docker compose logs -f

# Specific service
docker compose logs -f wordpress
docker compose logs -f mysql
```

### Stop Containers
```bash
docker compose stop
```

### Start Containers (after stopping)
```bash
docker compose start
```

### Stop and Remove Containers (keeps volumes)
```bash
docker compose down
```

### Stop and Remove Everything (including volumes - WARNING: deletes database data)
```bash
docker compose down -v
```

### Rebuild Containers (after Dockerfile changes)
```bash
docker compose up -d --build
```

### Execute Commands in Containers
```bash
# WordPress container
docker exec -it wordpress_app bash

# MySQL container
docker exec -it wordpress_mysql bash
```

## Configuration Details

### Database Configuration

- **Database Name**: `wordpress`
- **Database User**: `wordpress`
- **Database Password**: `wordpress`
- **Root Password**: `root`
- **Host**: `mysql` (service name in docker-compose)

### Ports

- **WordPress**: `8080` → `80` (container)
- **phpMyAdmin**: `8081` → `80` (container)
- **MySQL**: `3306` → `3306` (container)

### Volumes

- **WordPress files**: Current directory mounted to `/var/www/html`
  - Changes to local files are immediately reflected in the container
- **MySQL data**: `mysql_data` volume persists database data
  - Data persists even if containers are removed (unless using `docker compose down -v`)

## Troubleshooting

### WordPress shows "Error establishing a database connection"

1. Check if MySQL container is running:
   ```bash
   docker compose ps
   ```

2. Check MySQL logs:
   ```bash
   docker compose logs mysql
   ```

3. Verify wp-config.php has correct settings:
   - DB_HOST should be `mysql`
   - DB_NAME should be `wordpress`
   - DB_USER should be `wordpress`
   - DB_PASSWORD should be `wordpress`

### Database import didn't work

1. Check if the SQL file exists:
   ```bash
   ls -la mysql-init/kqhfawgrhosting_wp572.sql
   ```

2. Check MySQL logs for import errors:
   ```bash
   docker compose logs mysql
   ```

3. Manually import the database:
   ```bash
   docker exec -i wordpress_mysql mysql -u root -proot wordpress < kqhfawgrhosting_wp572.sql
   ```

### Port already in use

If ports 8080 or 8081 are already in use, edit `docker-compose.yml` and change the port mappings:

```yaml
ports:
  - "8080:80"  # Change 8080 to another port like 8082
```

### Permission Issues (Linux/Mac)

If you encounter permission issues with WordPress files:

```bash
# Fix ownership
sudo chown -R www-data:www-data .

# Or fix permissions
sudo chmod -R 755 .
```

## Development Workflow

1. **Make code changes**: Edit files directly in the project directory
2. **Changes are live**: WordPress container automatically reflects changes
3. **Database changes**: Use phpMyAdmin or connect via MySQL client
4. **View logs**: Use `docker compose logs -f` to debug issues

## Notes

- The database is automatically imported only on the **first** container start
- If you need to re-import, remove the MySQL volume: `docker compose down -v` then `docker compose up -d`
- WordPress files are mounted as volumes, so all changes persist
- MySQL data persists in a Docker volume named `mysql_data`

## Support

For issues or questions:
1. Check container logs: `docker compose logs`
2. Verify all containers are running: `docker compose ps`
3. Ensure Docker Desktop is running
4. Check if ports are available
