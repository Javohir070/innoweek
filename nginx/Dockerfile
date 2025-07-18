# Use the official Nginx image from Docker Hub
FROM nginx:alpine

# Set working directory
WORKDIR /var/www

# Remove the default server definition
RUN rm /etc/nginx/conf.d/default.conf

# Copy a new configuration file from your project
COPY default.conf /etc/nginx/conf.d/

# Expose port 80
EXPOSE 80

# Launch nginx
CMD ["nginx", "-g", "daemon off;"]
