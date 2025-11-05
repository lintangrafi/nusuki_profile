# Deploying Laravel Application to Vercel

This document provides instructions for deploying your Laravel application to Vercel.

## Prerequisites

1. A Vercel account (sign up at [vercel.com](https://vercel.com))
2. The Vercel CLI installed globally: `npm install -g vercel`
3. Your Laravel application code pushed to a Git repository

## Deployment Steps

### Option 1: Using Vercel CLI (Recommended for development/testing)

1. Install the Vercel CLI:
   ```bash
   npm install -g vercel
   ```

2. Navigate to your project directory and run:
   ```bash
   cd D:\Project\nusuki_profile
   vercel
   ```

3. Follow the prompts to link your project to a Git repository or deploy directly.

### Option 2: Using the Vercel Dashboard (Recommended for production)

1. Push your code to a Git repository (GitHub, GitLab, or Bitbucket)
2. Go to [vercel.com/dashboard](https://vercel.com/dashboard)
3. Click "Add New Project"
4. Select your Git repository
5. Vercel should automatically detect that it's a Laravel project
6. Make sure the following settings are configured:

   Build Command:
   ```
   composer install && npm install && npm run build
   ```

   Output Directory: `public`

   Root Directory: `.` (root)

7. Add the required Environment Variables as specified in `.env.production`

## Environment Variables

Set these environment variables in your Vercel project dashboard:

```
APP_NAME="PT. Nusuki Mega Utama"
APP_ENV=production
APP_KEY=base64:your-generated-app-key-here
APP_DEBUG=false
APP_URL=https://your-project-name.vercel.app
DB_CONNECTION=sqlite
DB_DATABASE=/tmp/database.sqlite
```

> **Note:** Generate a new APP_KEY for production by running:
> 
> ```bash
> php artisan key:generate --show
> ```

## Database Configuration for Vercel

Since Vercel has a read-only file system, we use a temporary SQLite database located at `/tmp/database.sqlite`. This database will reset on every deployment and is only suitable for testing purposes.

For a production application, consider using:
- PostgreSQL with Vercel Postgres
- MySQL with a managed database service
- MongoDB with MongoDB Atlas

## File Storage on Vercel

Vercel's file system is read-only, so any files that need to be saved should be stored in cloud storage (e.g., AWS S3) using Laravel's File Storage system.

## Caching and Sessions

This configuration uses database drivers for both caching and sessions. For production, consider using Redis or other managed cache services.

## Troubleshooting

### Common Issues and Solutions:

1. **File permissions errors**: Because of the read-only file system, ensure all runtime files are written to `/tmp/`

2. **Database not found**: Make sure the SQLite database is created in `/tmp/database.sqlite`

3. **Storage links**: Since the file system is read-only, you may need to create custom storage handling for user uploads

## Custom Configuration

The `vercel.json` file contains the configuration for deployment:

- Custom PHP runtime configuration
- Route rewrites to ensure Laravel routing works
- Environment variables setup
- Build settings

## Post-Deployment Steps

1. Run database migrations after deployment by visiting `/install` endpoint (if implemented) or by using the Vercel CLI:
   ```bash
   vercel env add DB_MIGRATE true production
   ```

2. Clear caches:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   php artisan view:clear
   ```

## Additional Considerations

1. **Static Assets**: Vite-compiled assets are automatically handled by the build process
2. **Security**: Update the APP_KEY and ensure other sensitive information is properly secured
3. **Performance**: Consider using Laravel Octane for better performance on Vercel Functions
4. **Monitoring**: Implement error tracking with services like Sentry

## Limitations

- The SQLite database will reset on each deployment since the file system is read-only
- File uploads need special handling since the file system is temporary
- For a production application, consider using persistent database and storage services

## Support

For support with deploying Laravel applications to Vercel, refer to the official documentation or contact the Vercel support team.