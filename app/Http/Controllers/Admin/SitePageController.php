<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SitePage;
use Illuminate\Http\Request;

class SitePageController extends Controller
{
    /**
     * List all site pages
     */
    public function index()
    {
        $pages = SitePage::latest('updated_at')->paginate(10);
        return view('admin.site-pages.list', compact('pages'));
    }

    /**
     * Show edit form for a page
     */
    public function edit($id)
    {
        $page = SitePage::findOrFail($id);
        return view('admin.site-pages.edit', compact('page'));
    }

    /**
     * Update page content
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $page = SitePage::findOrFail($id);
        $page->update([
            'title' => $request->title,
            'content' => $request->content,
            'last_updated' => now(),
        ]);

        return redirect()->route('admin.listsitepages')
            ->with('success', 'Page updated successfully.');
    }

    /**
     * Restore a page to original content
     */
    public function reset($id)
    {
        $page = SitePage::findOrFail($id);

        // Reset to default content based on slug
        $defaults = $this->getDefaults();

        if (isset($defaults[$page->slug])) {
            $page->update([
                'content' => $defaults[$page->slug]['content'],
                'title' => $defaults[$page->slug]['title'],
                'last_updated' => now(),
            ]);

            return redirect()->route('admin.listsitepages')
                ->with('success', 'Page reset to default content.');
        }

        return redirect()->route('admin.listsitepages')
            ->with('error', 'Unable to reset this page.');
    }

    /**
     * Get default content for all pages
     */
    private function getDefaults()
    {
        $docUser = \App\Models\User::first();
        $docEmail = !empty($docUser->webemail) ? $docUser->webemail : 'lawstudents.edu@gmail.com';
        $docMobile = !empty($docUser->mobile) ? $docUser->mobile : '+916624536320';

        return [
            'privacy-policy' => [
                'title' => 'Privacy Policy',
                'content' => <<<'HTML'
<p><strong>Sample policy.</strong> This is template text written for Law Students. Have it reviewed by a qualified legal professional and adjust it to your actual practices before relying on it.</p>
<p>Last updated: 24 September 2026</p>

<p>Law Students ("we", "us", "our") runs this website to provide legal education, study materials, Bare Acts, Rules and examination guidance. This policy explains what personal information we collect, why we collect it and the choices you have. It is intended to be read with the Information Technology Act, 2000 and the Digital Personal Data Protection Act, 2023.</p>

<h2>1. Information we collect</h2>
<ul>
<li><strong>Enquiry and contact forms:</strong> your name, email address, phone number, city, the course or subject you are interested in, and your message.</li>
<li><strong>Legal knowledge inquiries:</strong> the details above plus any document you choose to upload with your question.</li>
<li><strong>Student accounts:</strong> registration details, admission information and course enrolment records.</li>
<li><strong>Payments:</strong> transaction references and amounts. Card, UPI and bank details are handled by our payment partner and are not stored on this website.</li>
<li><strong>Technical data:</strong> session cookies needed to keep you signed in and to protect forms, and basic server logs (IP address, browser, pages visited).</li>
</ul>

<h2>2. How we use your information</h2>
<ul>
<li>To reply to your enquiries and send the course or study information you ask for.</li>
<li>To enrol you in courses, give you access to study material and issue receipts.</li>
<li>To improve our courses, notes and website.</li>
<li>To meet legal, tax and accounting obligations.</li>
</ul>
<p>We do not sell your personal information.</p>

<h2>3. Sharing</h2>
<p>We share information only with service providers who help us run the platform (hosting, email delivery, payment processing), under confidentiality obligations, or when required by law or a lawful request from a government authority.</p>

<h2>4. Retention</h2>
<p>Enquiries are kept for as long as needed to respond and follow up, and student records for as long as your account is active and as required by law. Documents uploaded with inquiries are deleted once they are no longer needed.</p>

<h2>5. Security</h2>
<p>We use reasonable technical and organisational safeguards, including encrypted connections and restricted staff access. No method of transmission over the internet is completely secure, so please avoid sending sensitive documents unless necessary.</p>

<h2>6. Your rights</h2>
<p>Subject to applicable law, you may ask to access, correct or erase your personal information, withdraw consent, or raise a grievance. Students under 18 should use the platform with the consent of a parent or guardian.</p>

<h2>7. Cookies</h2>
<p>We use essential cookies for sign-in and form security. You can block cookies in your browser, but some features, such as the student dashboard, may stop working.</p>

<h2>8. Changes to this policy</h2>
<p>We may update this policy from time to time. The "Last updated" date above shows when it last changed.</p>

<h2>9. Contact and grievances</h2>
<p>Email <a href="mailto:' . $docEmail . '">' . $docEmail . '</a> or call <a href="tel:' . $docMobile . '">' . $docMobile . '</a>. Address: 224 Legal District, Delhi High Court Marg, New Delhi 110001.</p>
HTML
            ],
            'terms-and-conditions' => [
                'title' => 'Terms & Conditions',
                'content' => <<<'HTML'
<p><strong>Sample terms.</strong> This is template text written for Law Students. Have it reviewed by a qualified legal professional before relying on it.</p>
<p>Last updated: 24 September 2026</p>

<p>By using the Law Students website, enrolling in a course or downloading study material, you agree to these Terms &amp; Conditions. If you do not agree, please do not use the platform.</p>

<h2>1. Who can use the platform</h2>
<p>The platform is meant for law students, examination aspirants, professionals and anyone interested in learning about law. Users under 18 should use it with the consent of a parent or guardian.</p>

<h2>2. Accounts</h2>
<p>You are responsible for keeping your login details confidential and for activity under your account. Tell us promptly if you think your account has been misused.</p>

<h2>3. Courses and study material</h2>
<ul>
<li>Course access is personal and non-transferable, and lasts for the period stated for that course.</li>
<li>Notes, PDFs, videos and tests are for your own study. You may not copy, sell, share or republish them without our written permission.</li>
<li>Bare Acts and Rules are provided for convenience. For official purposes, rely on the text published in the Gazette of India or on India Code.</li>
</ul>

<h2>4. Fees and payments</h2>
<p>Course fees are shown on the course page and are payable in advance. Refunds are governed by our Refund Policy.</p>

<h2>5. Acceptable use</h2>
<p>Do not misuse the platform: no unlawful, abusive or misleading content, no attempts to break security, and no automated scraping of study material.</p>

<h2>6. No legal advice</h2>
<p>Content on this platform is educational and is not legal advice. Please read our Disclaimer.</p>

<h2>7. Limitation of liability</h2>
<p>We work to keep content accurate and the platform available, but we do not guarantee that it will be error-free or uninterrupted. To the extent permitted by law, we are not liable for indirect losses arising from use of the platform.</p>

<h2>8. Suspension and termination</h2>
<p>We may suspend or close accounts that break these terms, including accounts that share paid material.</p>

<h2>9. Governing law</h2>
<p>These terms are governed by the laws of India. Courts at New Delhi have jurisdiction over any dispute.</p>

<h2>10. Changes and contact</h2>
<p>We may update these terms; the date above shows the latest version. Questions: <a href="mailto:' . $docEmail . '">' . $docEmail . '</a>.</p>
HTML
            ],
            'disclaimer' => [
                'title' => 'Disclaimer',
                'content' => <<<'HTML'
<p><strong>Sample disclaimer.</strong> This is template text written for Law Students. Have it reviewed by a qualified legal professional before relying on it.</p>
<p>Last updated: 24 September 2026</p>

<h2>1. Educational purpose only</h2>
<p>All courses, notes, Bare Acts, Rules, articles and examination guides on Law Students are provided for general education and examination preparation. They are not legal advice and should not be used as a substitute for advice from an advocate on your specific facts.</p>

<h2>2. No advocate–client relationship</h2>
<p>Reading this website, contacting us or submitting a legal knowledge inquiry does not by itself create an advocate–client relationship. Any formal legal advice, representation or engagement is subject to separate communication and acceptance.</p>

<h2>3. Not a solicitation</h2>
<p>In keeping with the rules of the Bar Council of India, this website is not intended to advertise or solicit legal work. You visit it of your own accord to learn about the law.</p>

<h2>4. Accuracy of legal texts</h2>
<p>Laws, rules and judgments change, and we may not reflect every amendment immediately. Bare Acts and Rules on this site are reproduced for study; for official or court use, rely on the text published in the Gazette of India or on India Code.</p>

<h2>5. Examinations and results</h2>
<p>Examination information (patterns, syllabi, dates, eligibility) is compiled from public notices and may change. Always confirm details with the official conducting body. Enrolling in a course does not guarantee selection or a particular result.</p>

<h2>6. External links</h2>
<p>Links to other websites are provided for convenience. We are not responsible for their content or practices.</p>
HTML
            ],
            'refund-policy' => [
                'title' => 'Refund Policy',
                'content' => <<<'HTML'
<p><strong>Sample policy.</strong> The periods and percentages below are placeholders. Set them to match how Law Students actually handles refunds, and have the text reviewed before relying on it.</p>
<p>Last updated: 24 September 2026</p>

<h2>1. Free material</h2>
<p>Free notes, Bare Acts, Rules and other free resources involve no payment, so no refund applies.</p>

<h2>2. Paid courses: when you can get a refund</h2>
<ul>
<li>You ask within <strong>7 days</strong> of payment, and</li>
<li>you have used no more than <strong>20%</strong> of the course content (classes, notes or tests), and</li>
<li>no certificate has been issued for the course.</li>
</ul>

<h2>3. When a refund is not available</h2>
<ul>
<li>After 7 days from payment, or once more than 20% of the content has been used.</li>
<li>Fees for examinations or registrations paid to third parties on your behalf.</li>
<li>Printed material that has already been dispatched.</li>
<li>Accounts suspended for sharing paid material or breaking our Terms &amp; Conditions.</li>
</ul>

<h2>4. Batch changes and cancellations</h2>
<p>If we cancel or postpone a batch, you can move to another batch at no extra cost or receive a full refund.</p>

<h2>5. How to ask for a refund</h2>
<p>Email <a href="mailto:' . $docEmail . '">' . $docEmail . '</a> or call <a href="tel:' . $docMobile . '">' . $docMobile . '</a> with your name, registered phone number, course name and payment reference.</p>

<h2>6. Processing</h2>
<p>Approved refunds are made to the original payment method within <strong>7–10 working days</strong>. Payment-gateway charges, if any, may be deducted.</p>
HTML
            ],
        ];
    }
}
