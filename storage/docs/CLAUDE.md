# Claude Code Project Guidelines

## Documentation & Reports

**All markdown documentation files (.md) must be stored in `storage/docs/`** — never create them in the project root folder.

### Current Structure
- `storage/docs/reports/` — Project analysis and standardization reports
- `README.md` — Only exception; standard project readme stays in root

### Why?
- Keeps project root clean and focused on source code
- Separates generated reports from actual project files
- Makes git history cleaner (reports aren't tracked as project changes)
- Easier to maintain and organize documentation

---

## Hero Section Implementation

The hero section frames and motifs are implemented across 10 inner pages:

- **Files**: `/public/assets/theme/images/hero-frame/` (SVG assets)
- **CSS**: `/public/assets/theme/css/inner.css` (lines 94-123)
- **Markup**: Each inner page Blade template has `<div class="hero-frame" aria-hidden="true"></div>` as first child of `<section class="page-hero">`

**Pages with hero frames:**
About Us, Acts, Rules, Legal Knowledge, Courses, Free Notes (copys), Clientele, Govt. Exams, Gallery, Contact Us

Homepage is excluded (uses different layout).

---

## Known Issues & Notes

- `Table 'u792878158_aa.banners' doesn't exist` — Pre-existing DB mismatch, logged to `storage/logs/laravel.log`, does not affect functionality
