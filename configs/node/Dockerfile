FROM node:24.14.0

WORKDIR /var/www/html

# Copy package files for caching (if they exist in the build context)
# Note: With .dockerignore, these files will only be available if they're in the src directory
COPY src/package.json src/package-lock.json* ./

# Install dependencies
RUN npm install

# Keep the container running for development
CMD ["npm", "run", "dev"]