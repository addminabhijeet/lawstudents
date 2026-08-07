# Category API Routes Example

Add these routes to `routes/api.php` or `routes/web.php` to enable category API endpoints:

## Option 1: API Routes (Recommended)

**File:** `routes/api.php`

```php
use App\Http\Controllers\CategoryApiController;

Route::prefix('categories')->group(function () {
    // Get all root categories
    Route::get('/', [CategoryApiController::class, 'getRoots']);
    
    // Get children of a parent category
    Route::get('{categoryId}/children', [CategoryApiController::class, 'getChildren']);
    
    // Get ancestors (breadcrumb) of a category
    Route::get('{categoryId}/ancestors', [CategoryApiController::class, 'getAncestors']);
    
    // Get full tree from a parent (or root if null)
    Route::get('{categoryId?}/tree', [CategoryApiController::class, 'getTree']);
    
    // Search categories by name
    Route::get('search', [CategoryApiController::class, 'search']);
    
    // Get single category with metadata
    Route::get('{categoryId}', [CategoryApiController::class, 'getCategory']);
    
    // Get all courses under a category (including nested)
    Route::get('{categoryId}/courses', [CategoryApiController::class, 'getCourses']);
    
    // Get category statistics
    Route::get('stats/all', [CategoryApiController::class, 'getStats']);
});
```

## Option 2: Web Routes

If you prefer web routes, add to `routes/web.php`:

```php
use App\Http\Controllers\CategoryApiController;

Route::prefix('api/categories')->group(function () {
    Route::get('/', [CategoryApiController::class, 'getRoots']);
    Route::get('{categoryId}/children', [CategoryApiController::class, 'getChildren']);
    Route::get('{categoryId}/ancestors', [CategoryApiController::class, 'getAncestors']);
    Route::get('{categoryId?}/tree', [CategoryApiController::class, 'getTree']);
    Route::get('search', [CategoryApiController::class, 'search']);
    Route::get('{categoryId}', [CategoryApiController::class, 'getCategory']);
    Route::get('{categoryId}/courses', [CategoryApiController::class, 'getCourses']);
    Route::get('stats', [CategoryApiController::class, 'getStats']);
});
```

---

## API Endpoint Examples

### 1. Get All Root Categories
**Endpoint:** `GET /api/categories`

**Response:**
```json
[
  {
    "id": 1,
    "name": "Law",
    "slug": "law",
    "icon": "📚"
  },
  {
    "id": 2,
    "name": "Medicine",
    "slug": "medicine",
    "icon": "⚕️"
  }
]
```

### 2. Get Child Categories
**Endpoint:** `GET /api/categories/1/children`

**Response:**
```json
[
  {
    "id": 3,
    "name": "Constitutional Law",
    "slug": "constitutional-law"
  },
  {
    "id": 4,
    "name": "Criminal Law",
    "slug": "criminal-law"
  }
]
```

### 3. Get Full Category Tree
**Endpoint:** `GET /api/categories/tree`

**Response:**
```json
[
  {
    "id": 1,
    "name": "Law",
    "slug": "law",
    "children": [
      {
        "id": 3,
        "name": "Constitutional Law",
        "children": [
          {
            "id": 10,
            "name": "Fundamental Rights",
            "children": []
          }
        ]
      }
    ]
  }
]
```

### 4. Search Categories
**Endpoint:** `GET /api/categories/search?q=constitution`

**Response:**
```json
[
  {
    "id": 3,
    "name": "Constitutional Law",
    "breadcrumb": "Law > Constitutional Law"
  }
]
```

### 5. Get Category Ancestors (Breadcrumb)
**Endpoint:** `GET /api/categories/10/ancestors`

**Response:**
```json
[
  {
    "id": 1,
    "name": "Law",
    "slug": "law"
  },
  {
    "id": 3,
    "name": "Constitutional Law",
    "slug": "constitutional-law"
  },
  {
    "id": 10,
    "name": "Fundamental Rights",
    "slug": "fundamental-rights"
  }
]
```

### 6. Get Single Category with Details
**Endpoint:** `GET /api/categories/3`

**Response:**
```json
{
  "id": 3,
  "name": "Constitutional Law",
  "slug": "constitutional-law",
  "description": "Study of constitutional principles",
  "status": 1,
  "parent_id": 1,
  "parent": {
    "id": 1,
    "name": "Law"
  },
  "children_count": 2,
  "courses_count": 5,
  "children": [
    {
      "id": 10,
      "name": "Fundamental Rights"
    },
    {
      "id": 11,
      "name": "Directive Principles"
    }
  ]
}
```

### 7. Get All Courses Under a Category (Including Nested)
**Endpoint:** `GET /api/categories/1/courses`

**Response:**
```json
[
  {
    "id": 1,
    "title": "Introduction to Law",
    "slug": "intro-to-law",
    "category_id": 1,
    "price": 999.99,
    "discount": 100.00
  },
  {
    "id": 2,
    "title": "Constitutional Law Basics",
    "slug": "const-law-basics",
    "category_id": 3,
    "price": 1499.99,
    "discount": 200.00
  }
]
```

### 8. Get Category Statistics
**Endpoint:** `GET /api/categories/stats`

**Response:**
```json
{
  "total_categories": 25,
  "active_categories": 24,
  "root_categories": 3,
  "max_nesting_level": 5,
  "total_courses": 150
}
```

---

## JavaScript Usage Examples

### Cascading Select (Level 1 → Level 2 → Level 3)

```javascript
// Load root categories
async function loadLevel1() {
    const response = await fetch('/api/categories');
    const categories = await response.json();
    
    const select = document.getElementById('level1');
    select.innerHTML = '<option value="">-- Select --</option>';
    
    categories.forEach(cat => {
        select.innerHTML += `<option value="${cat.id}">${cat.name}</option>`;
    });
}

// Load child categories when parent changes
document.getElementById('level1').addEventListener('change', async (e) => {
    const parentId = e.target.value;
    if (!parentId) return;
    
    const response = await fetch(`/api/categories/${parentId}/children`);
    const children = await response.json();
    
    const select = document.getElementById('level2');
    select.innerHTML = '<option value="">-- Select --</option>';
    
    children.forEach(cat => {
        select.innerHTML += `<option value="${cat.id}">${cat.name}</option>`;
    });
    
    select.disabled = false;
    document.getElementById('level3').disabled = true;
    document.getElementById('level3').innerHTML = '<option value="">-- Select --</option>';
});

// Similar for level2 to level3
document.getElementById('level2').addEventListener('change', async (e) => {
    const parentId = e.target.value;
    if (!parentId) return;
    
    const response = await fetch(`/api/categories/${parentId}/children`);
    const children = await response.json();
    
    const select = document.getElementById('level3');
    select.innerHTML = '<option value="">-- Select --</option>';
    
    children.forEach(cat => {
        select.innerHTML += `<option value="${cat.id}">${cat.name}</option>`;
    });
    
    select.disabled = false;
});

// Initialize
loadLevel1();
```

### Search with Autocomplete

```javascript
document.getElementById('categorySearch').addEventListener('keyup', async (e) => {
    const query = e.target.value;
    
    if (query.length < 2) {
        document.getElementById('suggestions').innerHTML = '';
        return;
    }
    
    const response = await fetch(`/api/categories/search?q=${encodeURIComponent(query)}`);
    const results = await response.json();
    
    let html = '';
    results.forEach(cat => {
        html += `
            <div class="suggestion" data-id="${cat.id}">
                <strong>${cat.name}</strong>
                <small>${cat.breadcrumb}</small>
            </div>
        `;
    });
    
    document.getElementById('suggestions').innerHTML = html;
    
    // Add click handlers to suggestions
    document.querySelectorAll('.suggestion').forEach(item => {
        item.addEventListener('click', () => {
            document.getElementById('categorySearch').value = item.textContent;
            document.getElementById('category_id').value = item.dataset.id;
            document.getElementById('suggestions').innerHTML = '';
        });
    });
});
```

### Display Category Breadcrumb

```javascript
async function displayBreadcrumb(categoryId) {
    const response = await fetch(`/api/categories/${categoryId}/ancestors`);
    const breadcrumb = await response.json();
    
    let html = '<nav class="breadcrumb">';
    breadcrumb.forEach((item, index) => {
        if (index === breadcrumb.length - 1) {
            html += `<span class="active">${item.name}</span>`;
        } else {
            html += `<a href="/categories/${item.slug}">${item.name}</a> > `;
        }
    });
    html += '</nav>';
    
    document.getElementById('breadcrumb').innerHTML = html;
}

displayBreadcrumb(10);
```

### Show Category Tree

```javascript
async function displayTree(parentId = null) {
    const url = parentId ? `/api/categories/${parentId}/tree` : '/api/categories/tree';
    const response = await fetch(url);
    const tree = await response.json();
    
    function renderTree(categories, level = 0) {
        let html = '<ul>';
        categories.forEach(cat => {
            html += `<li style="margin-left: ${level * 20}px">
                        <strong>${cat.name}</strong>`;
            if (cat.children.length > 0) {
                html += renderTree(cat.children, level + 1);
            }
            html += '</li>';
        });
        html += '</ul>';
        return html;
    }
    
    document.getElementById('categoryTree').innerHTML = renderTree(tree);
}

displayTree();
```

---

## Frontend Usage in Course Creation

Update the course creation form to use cascading selects:

```blade
<form action="{{ route('admin.storecourse') }}" method="POST">
    @csrf
    
    <div class="row">
        <div class="col-md-6">
            <label class="form-label">Main Category</label>
            <select id="level1" name="level1" class="form-control" required>
                <option value="">-- Select Category --</option>
            </select>
        </div>
        
        <div class="col-md-6">
            <label class="form-label">Sub Category</label>
            <select id="level2" name="level2" class="form-control" disabled>
                <option value="">-- Select Sub Category --</option>
            </select>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <label class="form-label">Sub Sub Category</label>
            <select id="level3" name="level3" class="form-control" disabled>
                <option value="">-- Select Sub Sub Category --</option>
            </select>
        </div>
        
        <div class="col-md-6">
            <label class="form-label">Final Category (Hidden)</label>
            <input type="hidden" id="category_id" name="category_id">
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Create Course</button>
</form>

<script>
// Set final category when level3 changes
document.getElementById('level3').addEventListener('change', (e) => {
    document.getElementById('category_id').value = e.target.value;
});

// Or if only 2 levels are needed
document.getElementById('level2').addEventListener('change', (e) => {
    document.getElementById('category_id').value = e.target.value;
});

// Load initial data
loadLevel1();
</script>
```

---

## Testing the API

### Using cURL:

```bash
# Get root categories
curl "http://localhost/api/categories"

# Get children of category 1
curl "http://localhost/api/categories/1/children"

# Search for categories
curl "http://localhost/api/categories/search?q=law"

# Get full tree
curl "http://localhost/api/categories/tree"

# Get category stats
curl "http://localhost/api/categories/stats"
```

### Using Postman:

1. Create a new collection "Law Categories API"
2. Add requests:
   - GET `/api/categories`
   - GET `/api/categories/1/children`
   - GET `/api/categories/search?q=law`
   - GET `/api/categories/1`
   - GET `/api/categories/1/courses`
   - GET `/api/categories/stats`

---

## Error Handling

All endpoints return appropriate HTTP status codes:

- **200 OK** - Request successful
- **404 Not Found** - Category not found
- **400 Bad Request** - Invalid query parameters

Example error response:
```json
{
  "error": "Category not found"
}
```
