# Alghafis Real Estate API Documentation

## Overview

This API provides comprehensive access to all public data and actions available in the Alghafis Real Estate application. It's designed to be consumed by mobile applications and other client applications.

## Base URL

All API endpoints are prefixed with `/api/v1/`

**Example:**
```
https://yourdomain.com/api/v1/home
```

## Documentation

### Interactive Documentation
Visit `/docs` on your application domain to access the interactive API documentation powered by Scribe.

**Example:** `https://yourdomain.com/docs`

### OpenAPI Specification
- **YAML Format:** Available at `/docs.openapi` or in `storage/app/scribe/openapi.yaml`
- **Postman Collection:** Available at `/docs.postman` or in `storage/app/scribe/collection.json`

## Available Endpoints

### Home
- `GET /api/v1/home` - Get home page data including static content, events, reviews, and partners

### About Us
- `GET /api/v1/about-us` - Get about us page data including static content, reports, and evaluations

### Services
- `GET /api/v1/services` - Get services page static content
- `GET /api/v1/services/list` - List all active services
- `GET /api/v1/services/{id}` - Get details of a specific service

### Events
- `GET /api/v1/events` - List all events with static content
- `GET /api/v1/events/{id}` - Get details of a specific event

### Blog
- `GET /api/v1/blog` - List blog posts (supports pagination, search, and tag filtering)
  - Query Parameters:
    - `search` - Filter by title
    - `tag` - Filter by tag slug
    - `page` - Page number
    - `per_page` - Items per page (default: 9)
- `GET /api/v1/blog/tags` - List all blog tags with post counts
- `GET /api/v1/blog/{slug}` - Get details of a specific blog post

### Pricing
- `GET /api/v1/pricing` - Get pricing page data including price packages

### Reviews
- `GET /api/v1/reviews` - List all completed reviews
- `POST /api/v1/reviews` - Submit a customer review
- `GET /api/v1/reviews/check/{token}` - Check if a review token is valid

### Training
- `GET /api/v1/training` - Get training page data including training types
- `POST /api/v1/training/apply` - Submit a training application

### Static Content Pages
- `GET /api/v1/contact-us` - Get contact us page static content
- `GET /api/v1/track-your-request` - Get track your request page static content
- `GET /api/v1/faq` - Get FAQ page static content
- `GET /api/v1/privacy-policy` - Get privacy policy page static content
- `GET /api/v1/our-clients` - Get our clients page static content

### Rate Requests (Evaluation Requests)
- `GET /api/v1/rate-requests/form-data` - Get form data for rate request including categories and price packages
- `POST /api/v1/rate-requests` - Submit a new rate/evaluation request
- `GET /api/v1/rate-requests/track` - Track a rate request by request number or email
  - Query Parameters:
    - `request_number` - Request tracking number
    - `email` - Customer email

### Categories
- `GET /api/v1/categories/goals` - Get apartment goal categories
- `GET /api/v1/categories/types` - Get apartment type categories
- `GET /api/v1/categories/entities` - Get apartment entity categories
- `GET /api/v1/categories/usages` - Get apartment usage categories

## Response Format

All API responses follow a consistent JSON format:

### Success Response
```json
{
  "data": {
    // Response data here
  }
}
```

### Error Response
```json
{
  "message": "Error message here",
  "errors": {
    // Validation errors (for 422 responses)
  }
}
```

## HTTP Status Codes

- `200` - Success
- `201` - Resource created successfully
- `404` - Resource not found
- `422` - Validation error
- `500` - Server error

## Authentication

Currently, all V1 API endpoints are public and do not require authentication. This may change in future versions.

## File Uploads

Endpoints that accept file uploads expect `multipart/form-data` content type:

- `POST /api/v1/reviews` - Accepts image file
- `POST /api/v1/training/apply` - Accepts CV file (PDF, DOC, DOCX)

## Example Requests

### Get Home Page Data
```bash
curl -X GET "https://yourdomain.com/api/v1/home" \
  -H "Accept: application/json"
```

### Submit Rate Request
```bash
curl -X POST "https://yourdomain.com/api/v1/rate-requests" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "goal_id": 1,
    "type_id": 2,
    "entity_id": 1,
    "usage_id": 3,
    "name": "Ahmed Ali",
    "email": "ahmed@example.com",
    "phone": "0501234567",
    "property_location": "Riyadh, Al Olaya"
  }'
```

### List Blog Posts with Pagination
```bash
curl -X GET "https://yourdomain.com/api/v1/blog?page=1&per_page=9&search=real%20estate" \
  -H "Accept: application/json"
```

## Pagination

Endpoints that return lists support pagination. The response includes:

```json
{
  "data": {
    "posts": {
      "data": [...],
      "current_page": 1,
      "last_page": 3,
      "per_page": 9,
      "total": 25
    }
  }
}
```

## Rate Limiting

There is currently no rate limiting implemented. This may be added in future versions.

## Versioning

The API is versioned using URL path versioning (e.g., `/api/v1/`). This allows us to introduce breaking changes in future versions without affecting existing clients.

## Legacy API Routes

Legacy API routes (not prefixed with `/v1/`) are still available for backward compatibility but are not documented here. They will be deprecated in future versions. Please use the V1 API for all new implementations.

## Support

For API support and questions, please contact:
- Phone: 0539455519
- Email: info@alghafis.com

## Changes and Updates

### Version 1.0 (October 2025)
- Initial release of V1 API
- All public website data exposed via API endpoints
- OpenAPI documentation generated
- Postman collection available

---

**Note:** This API is designed specifically for the Alghafis Real Estate mobile application and follows the structure of the public website. All sensitive admin actions and private data are excluded from this API.

