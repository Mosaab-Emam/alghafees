# API Quick Reference

## Base URL
`/api/v1/`

## All Endpoints (28 total)

### Home & About
- ✅ `GET /api/v1/home` - Home page data
- ✅ `GET /api/v1/about-us` - About us page data

### Services
- ✅ `GET /api/v1/services` - Services page content
- ✅ `GET /api/v1/services/list` - List all services
- ✅ `GET /api/v1/services/{id}` - Get single service

### Events
- ✅ `GET /api/v1/events` - List all events
- ✅ `GET /api/v1/events/{id}` - Get single event

### Blog
- ✅ `GET /api/v1/blog` - List posts (paginated, searchable)
- ✅ `GET /api/v1/blog/tags` - List all tags
- ✅ `GET /api/v1/blog/{slug}` - Get single post

### Pricing
- ✅ `GET /api/v1/pricing` - Pricing packages

### Reviews
- ✅ `GET /api/v1/reviews` - List reviews
- ✅ `POST /api/v1/reviews` - Submit review
- ✅ `GET /api/v1/reviews/check/{token}` - Validate token

### Training
- ✅ `GET /api/v1/training` - Training types
- ✅ `POST /api/v1/training/apply` - Submit application

### Static Pages
- ✅ `GET /api/v1/contact-us`
- ✅ `GET /api/v1/track-your-request`
- ✅ `GET /api/v1/faq`
- ✅ `GET /api/v1/privacy-policy`
- ✅ `GET /api/v1/our-clients`

### Rate Requests
- ✅ `GET /api/v1/rate-requests/form-data` - Form dropdown data
- ✅ `POST /api/v1/rate-requests` - Submit request
- ✅ `GET /api/v1/rate-requests/track` - Track request

### Categories
- ✅ `GET /api/v1/categories/goals`
- ✅ `GET /api/v1/categories/types`
- ✅ `GET /api/v1/categories/entities`
- ✅ `GET /api/v1/categories/usages`

## Documentation URLs

- **Interactive Docs:** `/docs`
- **OpenAPI Spec:** `/docs.openapi`
- **Postman Collection:** `/docs.postman`

## Files Created

### Controllers (10 files)
- `app/Http/Controllers/API/V1/HomeController.php`
- `app/Http/Controllers/API/V1/AboutUsController.php`
- `app/Http/Controllers/API/V1/ServicesController.php`
- `app/Http/Controllers/API/V1/EventsController.php`
- `app/Http/Controllers/API/V1/BlogController.php`
- `app/Http/Controllers/API/V1/PricingController.php`
- `app/Http/Controllers/API/V1/ReviewsController.php`
- `app/Http/Controllers/API/V1/TrainingController.php`
- `app/Http/Controllers/API/V1/StaticContentController.php`
- `app/Http/Controllers/API/V1/RateRequestController.php`
- `app/Http/Controllers/API/V1/CategoriesController.php`

### Resources (15 files)
- `app/Http/Resources/HomeStaticContentResource.php`
- `app/Http/Resources/InfoStaticContentResource.php`
- `app/Http/Resources/EventResource.php`
- `app/Http/Resources/ReviewResource.php`
- `app/Http/Resources/ContentResource.php`
- `app/Http/Resources/FileResource.php`
- `app/Http/Resources/CategoryResource.php`
- `app/Http/Resources/PricePackageResource.php`
- `app/Http/Resources/TrainingTypeResource.php`
- `app/Http/Resources/BlogPostResource.php`
- `app/Http/Resources/TagResource.php`
- `app/Http/Resources/AboutUsStaticContentResource.php`
- `app/Http/Resources/OurServicesStaticContentResource.php`
- `app/Http/Resources/PricingStaticContentResource.php`
- `app/Http/Resources/FaqStaticContentResource.php`

### Routes & Config
- ✅ Updated `routes/api.php` with V1 endpoints
- ✅ Configured `config/scribe.php` for documentation

### Documentation
- ✅ `API_README.md` - Comprehensive API documentation
- ✅ `API_QUICK_REFERENCE.md` - This file
- ✅ Generated OpenAPI spec at `storage/app/scribe/openapi.yaml`
- ✅ Generated Postman collection at `storage/app/scribe/collection.json`

## Next Steps

1. **Test the API:** Visit `/docs` to view interactive documentation
2. **Share with mobile dev:** Give them the API_README.md and the `/docs` URL
3. **Import to Postman:** Download collection from `/docs.postman`
4. **Customize responses:** Update example values in controllers as needed

## Notes

- ✅ All legacy routes preserved (backward compatible)
- ✅ No authentication required (public API)
- ✅ All endpoints documented with OpenAPI annotations
- ✅ Consistent response format across all endpoints
- ✅ Proper error handling with 404/422 responses
- ✅ File upload support for reviews and training applications
- ✅ Pagination support for blog posts

