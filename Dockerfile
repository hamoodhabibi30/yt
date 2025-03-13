# Use official PHP image
FROM php:8.1-cli

# Set working directory
WORKDIR /app

# Copy all project files
COPY . /app

# Expose port 8080
EXPOSE 8080

# Start PHP built-in server
CMD ["php", "-S", "0.0.0.0:8080", "-t", "."]
