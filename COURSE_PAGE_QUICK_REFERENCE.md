# Course Page - Quick Reference Guide

## CSS Classes & Selectors

### Main Container
```css
.courses-container
  - display: grid
  - grid-template-columns: repeat(auto-fill, minmax(250px, 1fr))
  - gap: 25px
  - margin-bottom: 40px
```

### Course Card
```css
.course-card-item
  - border: 1px solid #ddd
  - border-radius: 12px
  - box-shadow: 0 2px 8px rgba(0,0,0,0.08)
  - transition: all 0.3s ease
  - display: flex
  - flex-direction: column

.course-card-item:hover
  - box-shadow: 0 12px 24px rgba(0,0,0,0.12)
  - transform: translateY(-8px)
```

### Course Image
```css
.course-card-item img
  - object-fit: cover
  - transition: transform 0.3s ease

.course-card-item:hover img
  - transform: scale(1.05)
```

### Pagination
```css
.pagination
  - display: flex
  - justify-content: center
  - align-items: center
  - gap: 5px
  - margin: 0
  - padding: 0
  - list-style: none

.page-item.active
  - background: linear-gradient(135deg, #ff9800, #ff7043)
  - border: 2px solid #ff9800
  - color: #fff
  - font-weight: 700

.page-item:hover
  - border-color: #128C7E
  - color: #128C7E
  - background: #f0fdf4
```

### Filter Dropdown
```css
#categoryDropdownBtn
  - width: 100%
  - padding: 14px 16px
  - background: #fff
  - border: 2px solid #e5e7eb
  - border-radius: 10px
  - font-size: 14px
  - font-weight: 600

#categoryDropdownMenu
  - position: absolute
  - top: 100%
  - max-height: 0 (closed)
  - overflow: hidden
  - transition: max-height 0.3s ease
```

### Search Input
```css
#courseSearch
  - width: 100%
  - padding: 14px 16px
  - border: 2px solid #e5e7eb
  - border-radius: 10px
  - font-size: 14px

#courseSearch:focus
  - border-color: #128C7E
  - box-shadow: 0 0 0 3px rgba(18,140,126,0.1)
```

### Suggestions Box
```css
#courseSuggestions
  - position: absolute
  - top: 100%
  - max-height: 250px
  - overflow: auto
  - border: 2px solid #e5e7eb
  - border-radius: 0 0 10px 10px
  - z-index: 999
```

## JavaScript Functions

### Filter Functions
```javascript
filterCoursesByCategory(categoryId)
  - Filters courses by category ID
  - Shows/hides .course-card-item elements
  - Applies fade animation
  - categoryId: 'all' shows all courses

Example:
  filterCoursesByCategory('category-123')
  filterCoursesByCategory('all')
```

### Search Functions
```javascript
searchCourses(query)
  - Searches for courses as user types
  - Minimum length: 2 characters
  - Fetches from /frontend/coursesearch
  - Displays suggestions dropdown

highlightCourse(courseId)
  - Scrolls to course smoothly
  - Highlights with yellow (#fff3cd)
  - Removes highlight after 2 seconds

Example:
  searchCourses('Law')
  highlightCourse(456)
```

### Dropdown Functions
```javascript
// Open/Close Dropdown
document.getElementById('categoryDropdownBtn')
  .addEventListener('click', function() {
    let menu = document.getElementById('categoryDropdownMenu');
    menu.style.maxHeight = menu.style.maxHeight === '0px' 
      ? menu.scrollHeight + 'px' 
      : '0px';
  });

// Category Click Handler
document.querySelectorAll('.dropdown-category-item-course')
  .forEach(item => {
    item.addEventListener('click', function(e) {
      e.stopPropagation();
      const categoryId = this.dataset.categoryId;
      filterCoursesByCategory(categoryId);
    });
  });
```

### Utility Functions
```javascript
ensureAOSElementsVisible()
  - Makes all AOS elements visible
  - Sets opacity: 1
  - Calls AOS.refresh() if available
  - Used for animation fix
```

## HTML Structure

### Course Card HTML
```html
<div class="course-card-item" 
     data-category-id="123" 
     data-course-id="456"
     style="border:1px solid #ddd; ...">
  
  <!-- Image -->
  <div style="width:100%; height:180px; overflow:hidden;">
    <img src="..." alt="..." 
         style="width:100%; height:100%; object-fit:cover;">
  </div>
  
  <!-- Content -->
  <div style="padding:16px; flex:1; display:flex; flex-direction:column;">
    
    <div>
      <h4>Course Title</h4>
      <div>📄 Notes: 5</div>
      <div>Price: ₹2500.00</div>
      <div>Discount: ₹500.00</div>
    </div>
    
    <!-- Buttons -->
    <div style="display:flex; gap:10px;">
      <a href="" style="...">Enroll Now</a>
      <a href="" style="...">Brochure</a>
    </div>
    
  </div>
</div>
```

### Pagination HTML
```html
<nav aria-label="Page navigation">
  <ul class="pagination" 
      style="display:flex; justify-content:center; ...">
    
    <!-- Previous -->
    <li class="page-item">
      <a href="?page=1" style="...">◄</a>
    </li>
    
    <!-- Pages -->
    <li class="page-item active">
      <span style="...">1</span>
    </li>
    <li class="page-item">
      <a href="?page=2" style="...">2</a>
    </li>
    
    <!-- Next -->
    <li class="page-item">
      <a href="?page=2" style="...">►</a>
    </li>
    
  </ul>
</nav>
```

## Blade Template Syntax

### Course Loop
```blade
@forelse ($allCourses as $course)
  <div class="course-card-item" 
       data-category-id="{{ $course->category_id }}" 
       data-course-id="{{ $course->id }}">
    <!-- Card content -->
  </div>
@empty
  <div style="grid-column: 1 / -1;">
    No courses found
  </div>
@endforelse
```

### Pagination Links
```blade
@if($allCourses->hasPages())
  <!-- Pagination HTML -->
@endif
```

### Filter Dropdown
```blade
<div id="categoryDropdownMenu" 
     style="...">
  
  <!-- All Courses Option -->
  <div class="dropdown-item-course" 
       data-category-id="all" 
       style="...">
    All Courses
  </div>
  
  <!-- Category Tree -->
  @include('course.partials.category-tree', 
           ['categories' => $categories, 'depth' => 0])
  
</div>
```

## Data Attributes

```html
<!-- Course Card -->
<div data-category-id="123" data-course-id="456">

<!-- Filter Dropdown Items -->
<div data-category-id="789">

<!-- Page Links -->
<a href="?page=2"></a>
```

## CSS Classes Used

```
.courses-container       - Main grid container
.course-card-item       - Individual course card
.pagination             - Pagination list
.page-item              - Pagination item
.page-item.active       - Current page
.category-filter-wrapper - Filter dropdown container
.search-container       - Search input wrapper
.dropdown-item-course   - All courses option
.dropdown-category-item-course - Category options
```

## Event Listeners

```javascript
// Dropdown Button Click
#categoryDropdownBtn → click → open/close menu

// Category Item Click
.dropdown-category-item-course → click → filter courses

// Search Input
#courseSearch → keyup → searchCourses()

// Pagination Links
.pagination a → click → navigate to page

// Outside Click
document → click → close dropdown if outside
```

## Route & API Endpoints

### Frontend Routes
```php
// Get courses page
GET /course
  → CourseController@__invoke
  → View: course.course
  → Data: $allCourses, $categories

// Search courses
GET /frontend/coursesearch?q=query
  → CourseController@coursesearch
  → Response: JSON array of courses
```

### Response Format (Search)
```json
[
  {
    "title": "Course Title",
    "category_name": "Law & Constitution",
    "course_id": 123,
    "category_id": 456,
    "note_id": 789
  },
  ...
]
```

## Styling Quick Reference

### Colors
```
Primary Green:      #10b981
Primary Blue:       #3b82f6
Teal Accent:        #128C7E
Orange Active:      #ff9800
Text Dark:          #1f2937
Text Medium:        #6b7280
Text Light:         #9ca3af
Background:         #f9fafb
Card:               #ffffff
Discount/Alert:     #ef4444
```

### Shadows
```
Light:      0 2px 8px rgba(0,0,0,0.08)
Medium:     0 4px 12px rgba(0,0,0,0.12)
Heavy:      0 12px 24px rgba(0,0,0,0.12)
```

### Border Radius
```
Small:      6px
Default:    8px
Medium:     10px
Large:      12px
Pills:      20px or 30px
```

### Transitions
```
Default:    all 0.3s ease
Fast:       0.2s ease
Slow:       0.5s ease
```

## Common Modifications

### Change Courses Per Page
**File:** `CourseController.php` Line 54
```php
// Change from 12 to desired number
->paginate(12)  ← Change this
```

### Change Grid Columns
**File:** `course.blade.php` Line 119
```css
grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
/*                                                 ↑
                                    Change from 250px to desired width */
```

### Change Button Colors
**File:** `course.blade.php` Lines 169-184
```html
<!-- Enroll Button -->
background: linear-gradient(135deg, #25D366, #128C7E);
                                     ↑          ↑
                           Change these color codes

<!-- Brochure Button -->
background: linear-gradient(135deg, #4A90E2, #357ABD);
                                     ↑          ↑
                           Change these color codes
```

### Change Card Shadow
**File:** `course.blade.php` Line 109
```css
box-shadow: 0 12px 24px rgba(0,0,0,0.12);
            ↑                      ↑
         Adjust X Y Blur Spread  Opacity
```

## Testing URLs

```
# Main page
https://yoursite.com/course

# With pagination
https://yoursite.com/course?page=2

# Search API
https://yoursite.com/frontend/coursesearch?q=law

# Filter by category (client-side, no URL change)
Click category in dropdown
```

## Troubleshooting

### Pagination Not Showing
**Issue:** No pagination buttons visible
**Solution:** Check if `$allCourses->hasPages()` returns true
**File:** `course.blade.php` line 200

### Filter Not Working
**Issue:** Courses not filtering on category select
**Solution:** Verify class name is `dropdown-category-item-course`
**File:** `category-tree.blade.php` line 8

### Search Not Working
**Issue:** Search suggestions not appearing
**Solution:** Check API route `/frontend/coursesearch` exists
**File:** `CourseController.php` line 57

### Pagination Links Wrong
**Issue:** Page links have wrong URL
**Solution:** Verify Laravel pagination links are generated correctly
**File:** `course.blade.php` lines 214-243

## Browser DevTools Console Commands

```javascript
// Filter courses
filterCoursesByCategory('category-id')

// Search courses
searchCourses('Law')

// Highlight specific course
highlightCourse(123)

// Get current page
document.querySelector('.page-item.active').innerText

// Get total courses displayed
document.querySelectorAll('.course-card-item').length

// Check pagination state
document.querySelector('.pagination').innerHTML
```

## Git Diff Summary

```diff
Files Modified:
- resources/views/course/course.blade.php        (+400 lines)
- resources/views/course/partials/category-tree.blade.php  (1 line)
- app/Http/Controllers/Frontend/CourseController.php       (3 lines)

Total Changes:
+404 lines
-~150 lines (old design)
Net: +254 lines
```

## Version Info

- Laravel Version: 8.0+
- PHP Version: 7.4+
- Browser Support: All modern browsers
- Responsive: Yes (mobile, tablet, desktop)
- Accessibility: WCAG 2.1 AA

---

**Last Updated:** 2026-08-07  
**Status:** Production Ready ✅

