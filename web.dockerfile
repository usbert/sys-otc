# Use the official Nginx base image
FROM nginx:1.21-alpine

# Set the working directory
WORKDIR /var/www

# Copy the custom Nginx configuration file
COPY ./nginx/nginx.conf /etc/nginx/conf.d/default.conf

# Expose port 80 for web traffic
EXPOSE 80

# Start Nginx in the foreground
CMD ["nginx", "-g", "daemon off;"]