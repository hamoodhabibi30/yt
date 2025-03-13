# Use PHP 8.1 as the base image
FROM php:8.1-cli

# Set the working directory
WORKDIR /app

# Copy all files to the container
COPY . /app

# Install yt-dlp
RUN apt update && apt install -y yt-dlp

# Expose port 8080 for Railway
EXPOSE 8080

# Start PHP's built-in server
CMD ["php", "-S", "0.0.0.0:8080", "-t", "."]
