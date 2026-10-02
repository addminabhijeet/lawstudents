# Study PDF Protection

## Deployment

Run `php artisan migrate` to create the separate `pdf_watermark_settings` table.
Existing and newly uploaded study PDFs are watermarked by default. The admin
can change each file's preference without modifying the uploaded document.

The existing FPDI library brands normal PDFs. PDFs containing compressed object
streams additionally require [QPDF](https://github.com/qpdf/qpdf/releases).
QPDF 12.4.2 is installed locally in
`storage/app/tools/qpdf-12.4.2-msvc64`. This runtime directory is not committed.
On another server install QPDF and set `PDF_QPDF_BINARY` to its executable path,
or put `qpdf` on the server's PATH. The web-server account must be permitted to
execute it. Normalization only affects temporary copies; originals stay intact.
Both temporary files are removed after processing/delivery.

The project-root Apache `.htaccess` denies original study PDFs under
`storage/app/public/{course_notes,acts,rules,copys,govt-exams,legal-knowledge-library}`
and equivalent public storage aliases. It also denies access to temporary files
and tool binaries. These rules are active for the current XAMPP installation.
If deploying with a `public` document root or Nginx, apply equivalent denial
rules in that server configuration before enabling public storage aliases.
Never expose the project's `storage/app/temp` or `storage/app/tools` directories.

## Behavior And Limits

Student access, paid enrollment checks, expiring viewer tokens, activity records,
download permissions and counters remain in the existing student controllers.
Public routes can only resolve active, free study documents. Watermark settings
can only be changed through authenticated admin routes with CSRF protection.

Faint tiled logo, company name and website branding is embedded in PDF pages,
not merely placed above them in the browser. Original files are not overwritten.
Disabling a watermark intentionally serves the original content for that file.

The viewer suppresses browser printing, save shortcuts, context menus, copying
and dragging where browser events allow it. While a protected viewer is open,
observed capture shortcuts, focus loss and hidden-page events conceal the
website viewport with white. Content is restored on focus return.

These are deterrents, not DRM. Browsers do not reliably report operating-system
screenshots or screen recording. A capture can occur before any browser event,
and authorized users can retrieve the PDF bytes their browser receives.
Printing a separately downloaded PDF is also outside the site's control.
Native OS protection such as Android FLAG_SECURE requires a native application;
it cannot be enabled by Laravel, JavaScript, or an installed PWA alone.
