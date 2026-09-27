<?php

// Editorial presentation only. Programme facts remain in the existing course records.
return [
    'home' => [
        'label' => 'Choose Your Direction',
        'title' => 'A learning path for every stage.',
        'lead' => 'Start with your goal. Explore the course catalogue for focused study, or use the free collections to get familiar with a subject before making a course inquiry.',
        'cards' => [
            [
                'title' => 'Preparing for law entrance',
                'body' => 'Explore legal aptitude, reasoning and entrance preparation. Compare the course overview with the subjects you want to strengthen.',
                'route' => 'course',
                'link' => 'Explore entrance courses',
                'query' => 'Entrance',
            ],
            [
                'title' => 'Studying LL.B. or LL.M.',
                'body' => 'Connect your classroom reading with subject-focused courses, notes and primary legal texts.',
                'route' => 'course',
                'link' => 'Explore law programmes',
                'query' => 'LL.B.',
            ],
            [
                'title' => 'Working towards judicial services',
                'body' => 'Explore judiciary preparation and judgment-writing courses, then discuss your preparation stage with the team.',
                'route' => 'course',
                'link' => 'Explore judiciary courses',
                'query' => 'Judicial',
            ],
            [
                'title' => 'Pursuing CA, CS or CMA',
                'body' => 'Find courses covering business laws, company law, taxation and professional studies.',
                'route' => 'course',
                'link' => 'Browse professional courses',
                'query' => null,
            ],
            [
                'title' => 'Building communication skills',
                'body' => 'Explore English grammar and spoken-English courses with a focus on legal study and professional communication.',
                'route' => 'course',
                'link' => 'Explore English courses',
                'query' => 'English',
            ],
            [
                'title' => 'Exploring law for the first time',
                'body' => 'Begin with the Legal Knowledge Library. Choose a topic, read a guide and note the questions you want to explore further.',
                'route' => 'legalknowledgelibrary',
                'link' => 'Start with the library',
                'query' => null,
            ],
        ],
        'story' => [
            'image' => 'community',
            'title' => 'Build a study routine that connects the pieces.',
            'paragraphs' => [
                'A course, a Bare Act and a revision note serve different purposes. Start with an overview to understand the subject, read the relevant primary text, then use your own notes to organize what you have learned.',
                'Before choosing a paid course, read the available description, check the displayed price and review the brochure where provided. A specific inquiry helps you confirm whether the content and arrangements suit your goal.',
            ],
            'points' => [
                'Choose one subject to begin',
                'Keep questions alongside your notes',
                'Compare the course with your study needs',
            ],
        ],
        'steps' => [],
        'faqs' => [
            [
                'question' => 'Can I explore resources before choosing a course?',
                'answer' => 'Yes. Browse Free Notes, Bare Acts, Rules and the Legal Knowledge Library. The available View links let you inspect resources; some download actions may ask you to sign in.',
            ],
            [
                'question' => 'How do I find the right programme?',
                'answer' => 'Start with your goal and current study level. Use the course categories or keyword search, read the overview and send an inquiry naming the course you are considering.',
            ],
            [
                'question' => 'Where can I confirm schedules, access and fees?',
                'answer' => 'Check the course listing and any brochure, then ask the team to confirm the current schedule, access period, inclusions and payable fee before enrolling.',
            ],
            [
                'question' => 'Does an inquiry enrol me in a course?',
                'answer' => 'The Send Enquiry button opens the contact form. It is a request for information; the team can explain the next steps for the programme you choose.',
            ],
        ],
        'cta' => [
            'title' => 'Make your next study decision with clarity.',
            'body' => 'Explore the catalogue, shortlist a course and ask the questions that matter to your learning.',
            'route' => 'course',
            'label' => 'Find your course',
        ],
    ],
    'course' => [
        'label' => 'Programme Pathways',
        'title' => 'Choose by your goal, then compare the details.',
        'lead' => 'Use these starting points to explore the catalogue. Each course card keeps its own price, available notes and inquiry options together.',
        'cards' => [
            [
                'title' => 'Law entrance & legal aptitude',
                'body' => 'For learners building a foundation in legal reasoning, language and entrance-examination preparation.',
                'route' => 'course',
                'link' => 'Explore entrance preparation',
                'query' => 'Entrance',
            ],
            [
                'title' => 'LL.B. & LL.M. study',
                'body' => 'Explore undergraduate core subjects and postgraduate subject study that connects with your academic interests.',
                'route' => 'course',
                'link' => 'Explore academic courses',
                'query' => 'LL.',
            ],
            [
                'title' => 'Judicial services preparation',
                'body' => 'Explore preparation for preliminary and mains study, plus judgment-writing and interview-focused options.',
                'route' => 'course',
                'link' => 'Explore judicial courses',
                'query' => 'Judicial',
            ],
            [
                'title' => 'Practice-focused law subjects',
                'body' => 'Explore civil procedure, corporate law, taxation and other subjects listed in the catalogue.',
                'route' => 'course',
                'link' => 'Explore law subjects',
                'query' => 'Law',
            ],
            [
                'title' => 'CA, CS, CMA & CSEET',
                'body' => 'Find professional study options across accounting, business law, governance and compliance.',
                'route' => 'course',
                'link' => 'Browse professional options',
                'query' => null,
            ],
            [
                'title' => 'English & communication',
                'body' => 'Build your shortlist from grammar and spoken-English options for students and professionals.',
                'route' => 'course',
                'link' => 'Explore communication courses',
                'query' => 'English',
            ],
        ],
        'story' => [
            'image' => 'inquiry',
            'title' => 'Choose the fit, not just the course title.',
            'paragraphs' => [
                'Read the course overview for its subject focus and intended level. Look for a match between what you already know, what you need to learn and the goal you are working towards.',
                'The listing shows the published price and any separately displayed discount. Use the brochure where available, then ask about the total payable amount, teaching format, schedule, course materials and access arrangements before making a commitment.',
            ],
            'points' => [
                'Compare the overview and learning level',
                'Review available notes and brochure',
                'Confirm timing, access and payment details',
            ],
        ],
        'steps' => [
            [
                'title' => 'Shortlist a subject',
                'body' => 'Use the category selector or search field. Read the course overview and expand its details to understand the focus.',
            ],
            [
                'title' => 'Send a specific inquiry',
                'body' => 'Choose Send Enquiry on the course card so the contact page knows which programme interests you. Mention your level and goal.',
            ],
            [
                'title' => 'Confirm before enrolling',
                'body' => 'Ask the team to confirm the syllabus, delivery format, timetable, access, fees and any eligibility or assessment requirements.',
            ],
        ],
        'faqs' => [
            [
                'question' => 'What information is shown for each course?',
                'answer' => 'Where provided in the course record, the card shows its overview, learning level and description. The existing listing also shows notes, price, any discount and a brochure link when available.',
            ],
            [
                'question' => 'Are all courses delivered in the same format?',
                'answer' => 'The catalogue does not establish one delivery format for every programme. Ask about live or recorded teaching, study materials, schedule and support for your chosen course.',
            ],
            [
                'question' => 'Will I receive a certificate or qualification?',
                'answer' => 'Confirm any certificate, assessment and eligibility arrangements directly for the programme you choose. A course title alone does not establish recognition or an academic award.',
            ],
            [
                'question' => 'How do discounts and payment work?',
                'answer' => 'Use the displayed price and discount as a starting point, then confirm the final amount and payment arrangements with the team. Read the refund policy before paying.',
            ],
            [
                'question' => 'Can I ask a question before enrolling?',
                'answer' => 'Yes. Use the course card\'s Send Enquiry link and describe your goal, current level and the information you need.',
            ],
        ],
        'cta' => [
            'title' => 'Ready to shortlist your course?',
            'body' => 'Tell us the programme you are considering and what you want to achieve. Get the details you need for an informed decision.',
            'route' => 'contact',
            'label' => 'Discuss a course',
        ],
    ],
    'acts' => [
        'label' => 'Build Your Foundation',
        'title' => 'Make primary texts part of your study.',
        'lead' => 'Use the collection to move from a broad topic to the provisions you want to read. Pair careful reading with a course or your own academic notes.',
        'cards' => [
            [
                'title' => 'Begin with a subject',
                'body' => 'Choose a category or search for the Act named in your reading list. Keep your study question narrow enough to work through in one session.',
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Read with structure',
                'body' => 'Use the contents, headings and definitions to understand how the document is organized before focusing on individual provisions.',
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Connect your resources',
                'body' => 'Keep a study note beside the text so you can record questions, cross-references and concepts to revisit.',
                'route' => 'copys',
                'link' => 'Explore revision notes',
                'query' => null,
            ],
        ],
        'story' => [
            'image' => 'notes',
            'title' => 'Turn a reading session into useful notes.',
            'paragraphs' => [
                'Write the title of the text and the topic you are studying at the top of your notes. Work through a manageable section, record unfamiliar terms and mark any references you need to follow.',
                'Finish by explaining the main idea in your own words and listing what you still need to understand. This gives your next study session a clear starting point.',
            ],
            'points' => [
                'Record the document and topic',
                'Separate quotations from your own summary',
                'Keep a short list of follow-up questions',
            ],
        ],
        'steps' => [
            [
                'title' => 'Locate',
                'body' => 'Use a category or keyword to find the relevant entry in the collection.',
            ],
            [
                'title' => 'Read',
                'body' => 'Open the available PDF and follow its headings and internal references.',
            ],
            [
                'title' => 'Revisit',
                'body' => 'Return to your notes, related Rules or a course to deepen your understanding.',
            ],
        ],
        'faqs' => [
            [
                'question' => 'How do I find an Act quickly?',
                'answer' => 'Use Quick Search with a word from the Act\'s title, or select a category to narrow the entries.',
            ],
            [
                'question' => 'Can I view and download the documents?',
                'answer' => 'Use the actions shown for each document. Viewing and downloading can have different sign-in requirements.',
            ],
            [
                'question' => 'Where should I go for related study material?',
                'answer' => 'Explore Rules for related reference material, Free Notes for revision resources and Courses for available subject-focused study.',
            ],
        ],
        'cta' => [
            'title' => 'Bring your reading into a wider study plan.',
            'body' => 'Explore courses that connect with the subjects you are studying.',
            'route' => 'course',
            'label' => 'Explore law courses',
        ],
    ],
    'rules' => [
        'label' => 'Read in Context',
        'title' => 'Give procedural detail a place in your notes.',
        'lead' => 'Build a reading habit that connects a document\'s structure, your study question and the wider topic.',
        'cards' => [
            [
                'title' => 'Find a relevant category',
                'body' => 'Browse the grouped collection and choose the subject area you are working on.',
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Follow the document',
                'body' => 'Use headings, definitions and references to make your reading more systematic.',
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Connect related material',
                'body' => 'Keep relevant Bare Acts and revision notes within reach as you explore the topic.',
                'route' => 'acts',
                'link' => 'Browse Bare Acts',
                'query' => null,
            ],
        ],
        'story' => [
            'image' => 'acts',
            'title' => 'Keep the details organized.',
            'paragraphs' => [
                'Use a simple reading sheet with space for the document title, topic, important references and questions. Capture your understanding in short sentences so you can revisit it later.',
                'Make a separate list of points that need further explanation. The Legal Knowledge inquiry form gives you a place to describe the subject you want to understand.',
            ],
            'points' => [
                'Name the source in your notes',
                'Record cross-references as you read',
                'Return to uncertain points',
            ],
        ],
        'steps' => [
            [
                'title' => 'Select a topic',
                'body' => 'Use the category control or search to focus the collection.',
            ],
            [
                'title' => 'Read the available resource',
                'body' => 'Open the document and work through a small part at a time.',
            ],
            [
                'title' => 'Connect and revise',
                'body' => 'Review your notes alongside related resources and questions.',
            ],
        ],
        'faqs' => [
            [
                'question' => 'How is this collection organized?',
                'answer' => 'Entries are grouped by category. Use the page\'s filters and keyword search to narrow the visible resources.',
            ],
            [
                'question' => 'Can I use Rules alongside Bare Acts?',
                'answer' => 'You can use both collections in your reading plan, following the references and subject matter of the documents you select.',
            ],
            [
                'question' => 'Where can I ask for more information?',
                'answer' => 'Use the Legal Knowledge inquiry page to describe your topic, or contact the team about available course options.',
            ],
        ],
        'cta' => [
            'title' => 'Want a more structured way to study?',
            'body' => 'Explore the course catalogue and compare the available subject overviews.',
            'route' => 'course',
            'label' => 'Find a related course',
        ],
    ],
    'copys' => [
        'label' => 'Revision That Makes Sense',
        'title' => 'Use notes to strengthen your own understanding.',
        'lead' => 'Build a repeatable revision routine around the free material available here.',
        'cards' => [
            [
                'title' => 'Preview a topic',
                'body' => 'Read the headings and main ideas before beginning a longer textbook or course session.',
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Make connections',
                'body' => 'Link the notes to a subject you are studying and the questions you want to answer.',
                'route' => 'acts',
                'link' => 'Explore primary texts',
                'query' => null,
            ],
            [
                'title' => 'Check your recall',
                'body' => 'Close the resource and explain the main points in your own words. Revisit the gaps you notice.',
                'link' => 'Explore',
                'query' => null,
            ],
        ],
        'story' => [
            'image' => 'exams',
            'title' => 'A simple routine for focused revision.',
            'paragraphs' => [
                'Choose one resource and set a clear goal: understand a concept, revisit a topic or organize a short summary. Read with that goal in mind instead of trying to cover everything at once.',
                'After reading, write a few questions for yourself and answer them without looking. Save the questions you find difficult for your next revision session.',
            ],
            'points' => [
                'Choose a manageable topic',
                'Summarize in your own words',
                'Review the points you could not recall',
            ],
        ],
        'steps' => [
            [
                'title' => 'Find your subject',
                'body' => 'Select a category or search for a keyword in the notes collection.',
            ],
            [
                'title' => 'Read with a question',
                'body' => 'Open the available PDF and identify what you want to understand.',
            ],
            [
                'title' => 'Build your revision sheet',
                'body' => 'Keep the key ideas, examples and follow-up questions together.',
            ],
        ],
        'faqs' => [
            [
                'question' => 'Are these study notes free?',
                'answer' => 'This page is the Free Notes collection. Use the viewing and download actions shown on each entry; downloads may require sign-in.',
            ],
            [
                'question' => 'Do notes replace a full course or textbook?',
                'answer' => 'Use notes as one part of your learning. For a fuller picture, combine them with your prescribed reading, primary texts and any course you choose.',
            ],
            [
                'question' => 'What if I cannot find my subject?',
                'answer' => 'Try a broader keyword or clear the selected category. You can also check the Legal Knowledge Library and course catalogue.',
            ],
        ],
        'cta' => [
            'title' => 'Ready to build beyond revision?',
            'body' => 'Compare the available courses and find a subject you would like to study in more depth.',
            'route' => 'course',
            'label' => 'Explore courses',
        ],
    ],
    'govtexams' => [
        'label' => 'Plan Your Preparation',
        'title' => 'Start with a clear study target.',
        'lead' => 'Use the material on this page to support your own preparation plan. Keep the requirements of your chosen examination alongside your notes.',
        'cards' => [
            [
                'title' => 'Choose your examination',
                'body' => 'Begin with the exam and stage you are preparing for, then identify the subjects you need to cover.',
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Organize available material',
                'body' => 'Use the categories and search field to find resources relevant to those subjects.',
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Balance reading and recall',
                'body' => 'Make room for understanding, self-testing and revisiting difficult topics in your weekly routine.',
                'link' => 'Explore',
                'query' => null,
            ],
        ],
        'story' => [
            'image' => 'notes',
            'title' => 'A preparation plan you can return to.',
            'paragraphs' => [
                'Create a subject checklist from the requirements of your chosen examination. Give each study session one achievable task and record what you completed.',
                'Keep a separate list of questions or topics that need more work. Revisit that list regularly and adjust your plan around the areas where you need more practice.',
            ],
            'points' => [
                'Set a weekly subject focus',
                'Keep a record of difficult topics',
                'Review progress before adding more material',
            ],
        ],
        'steps' => [
            [
                'title' => 'Map your subjects',
                'body' => 'Identify the topics you want to work on and organize them into a checklist.',
            ],
            [
                'title' => 'Find supporting resources',
                'body' => 'Use the examination collection, Free Notes and relevant primary texts.',
            ],
            [
                'title' => 'Review your next step',
                'body' => 'Reflect on what you can explain confidently and what you need to revisit.',
            ],
        ],
        'faqs' => [
            [
                'question' => 'Is this an official examination notification page?',
                'answer' => 'This page provides the study material published on Law Students. Use the relevant examination authority for official eligibility, dates and application requirements.',
            ],
            [
                'question' => 'Can I find judiciary preparation courses here?',
                'answer' => 'The course catalogue includes judicial-services preparation options. Review the available descriptions and ask the team about a programme that fits your stage.',
            ],
            [
                'question' => 'What should I include in a course inquiry?',
                'answer' => 'Name the examination, your preparation stage, the subjects you need help with and the schedule you are hoping to follow.',
            ],
        ],
        'cta' => [
            'title' => 'Find a course that supports your preparation.',
            'body' => 'Explore available programmes and ask about their fit for your examination goal.',
            'route' => 'course',
            'label' => 'Explore preparation courses',
        ],
    ],
    'legalknowledgelibrary' => [
        'label' => 'Explore With Purpose',
        'title' => 'Build a broader understanding of legal topics.',
        'lead' => 'Choose an area of interest, read a resource and follow the questions that emerge.',
        'cards' => [
            [
                'title' => 'Discover a topic',
                'body' => 'Browse categories to find a subject that connects with your studies or general interests.',
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Read beyond the headline',
                'body' => 'Open the available PDF and work through its explanation in the context of the whole document.',
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Ask a focused question',
                'body' => 'Describe what you have read and the point you want to understand more clearly.',
                'route' => 'legal-knowledge',
                'link' => 'Open the inquiry form',
                'query' => null,
            ],
        ],
        'story' => [
            'image' => 'inquiry',
            'title' => 'Let one question lead to deeper learning.',
            'paragraphs' => [
                'Begin with a clear question and choose a resource that seems relevant. Note the terms you encounter and the related subjects you would like to explore.',
                'Use the library alongside Bare Acts, Rules and courses where they connect with your interests. Moving between an overview and a more detailed resource can help you build a fuller study plan.',
            ],
            'points' => [
                'Start with a question',
                'Record unfamiliar terms',
                'Explore related subjects',
            ],
        ],
        'steps' => [
            [
                'title' => 'Choose',
                'body' => 'Select a category or search for a topic in the library.',
            ],
            [
                'title' => 'Explore',
                'body' => 'Read the available document and make a short summary.',
            ],
            [
                'title' => 'Continue',
                'body' => 'Follow a related resource or submit a knowledge inquiry.',
            ],
        ],
        'faqs' => [
            [
                'question' => 'How is the library different from the inquiry page?',
                'answer' => 'The library contains published reading resources. The Legal Knowledge inquiry page has a form for sending the team a question.',
            ],
            [
                'question' => 'How do I open a resource?',
                'answer' => 'Expand the relevant category if needed, then use the View action on the entry you want to read.',
            ],
            [
                'question' => 'Can I study a topic through a course?',
                'answer' => 'Explore the course catalogue for a related subject and read its overview before sending an inquiry.',
            ],
        ],
        'cta' => [
            'title' => 'Take your interest a step further.',
            'body' => 'Explore a related course or ask the team about the subject you want to understand.',
            'route' => 'legal-knowledge',
            'label' => 'Ask a learning question',
        ],
    ],
    'legal-knowledge' => [
        'label' => 'Make Your Question Clear',
        'title' => 'A little context makes an inquiry more useful.',
        'lead' => 'Use the existing form to describe the legal or educational topic you want to understand.',
        'cards' => [
            [
                'title' => 'Name the subject',
                'body' => 'Choose the closest subject in the form. If none fits, select Other Laws and describe the area in your question.',
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Explain the learning gap',
                'body' => 'Tell us what you have already read and identify the term, concept or resource that needs more explanation.',
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Add relevant context',
                'body' => 'Keep your question focused. If a document helps explain it, the form provides an optional upload field.',
                'link' => 'Explore',
                'query' => null,
            ],
        ],
        'story' => [
            'image' => 'library',
            'title' => 'Explore the library while you prepare your question.',
            'paragraphs' => [
                'The Legal Knowledge Library brings published resources together by category. Reading an overview first can help you identify the exact point you want to discuss.',
                'Use the inquiry form for the context and question you want to send. For course availability, fees or study arrangements, the Contact page provides programme inquiry options.',
            ],
            'points' => [
                'Use a clear subject line in your question',
                'Ask one main question at a time',
                'Mention the resource you are referring to',
            ],
        ],
        'steps' => [
            [
                'title' => 'Choose a subject',
                'body' => 'Select the area that best matches your inquiry.',
            ],
            [
                'title' => 'Write your question',
                'body' => 'Explain the topic and what you need to understand, then add an optional relevant document.',
            ],
            [
                'title' => 'Check and submit',
                'body' => 'Review your contact details and question before using Submit Inquiry.',
            ],
        ],
        'faqs' => [
            [
                'question' => 'Do I need to upload a document?',
                'answer' => 'No. The upload field is optional. The form accepts the document types listed beside that field.',
            ],
            [
                'question' => 'Can I ask about a course here?',
                'answer' => 'For programme selection, fees and course arrangements, use Contact Us or the Send Enquiry button on a course card.',
            ],
            [
                'question' => 'Does submitting this form create a professional engagement?',
                'answer' => 'As the existing form explains, submitting an inquiry does not itself create an advocate-client relationship. Any formal engagement is subject to separate communication and acceptance.',
            ],
        ],
        'cta' => [
            'title' => 'Prefer to explore published material first?',
            'body' => 'Browse the library and return with a more focused question.',
            'route' => 'legalknowledgelibrary',
            'label' => 'Read the library',
        ],
    ],
    'contact' => [
        'label' => 'Before You Send',
        'title' => 'Help us understand what you need.',
        'lead' => 'A clear message makes it easier to discuss a relevant next step.',
        'cards' => [
            [
                'title' => 'Choosing a programme',
                'body' => 'Tell us your current study level, the course or subject you are considering and the goal you are working towards.',
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Comparing course details',
                'body' => 'Ask about subject coverage, teaching format, schedule, learning materials, access and the full payable fee.',
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Finding a resource',
                'body' => 'Include the page name, document title or course name so the team can identify what you are referring to.',
                'link' => 'Explore',
                'query' => null,
            ],
        ],
        'story' => [
            'image' => 'courses',
            'title' => 'Make an informed course decision.',
            'paragraphs' => [
                'Start by reading the overview and learning level on the course card. Open the brochure where one is available, and make a short list of the details you still need.',
                'Bring those questions into your inquiry. If you are considering more than one programme, name both and explain the subjects or skills you want to develop.',
            ],
            'points' => [
                'Read the available course description',
                'State your learning goal',
                'Confirm the practical arrangements',
            ],
        ],
        'steps' => [
            [
                'title' => 'Choose the right topic',
                'body' => 'Select the programme of interest that best fits your message.',
            ],
            [
                'title' => 'Explain your request',
                'body' => 'Give the course name, your study stage and the questions you want to discuss.',
            ],
            [
                'title' => 'Review your contact details',
                'body' => 'Check your email and phone number so the team can respond using the information you provide.',
            ],
        ],
        'faqs' => [
            [
                'question' => 'How do I ask about a specific course?',
                'answer' => 'Use Send Enquiry on its course card, or name the course in your message on this page.',
            ],
            [
                'question' => 'What should I confirm before paying?',
                'answer' => 'Confirm course coverage, delivery format, schedule, access period, total fee and applicable refund terms.',
            ],
            [
                'question' => 'Where should I send a legal-topic question?',
                'answer' => 'Use the Legal Knowledge inquiry form for a subject-specific educational or legal information inquiry. It includes a subject selector and optional document upload.',
            ],
        ],
        'cta' => [
            'title' => 'Still exploring your options?',
            'body' => 'Read the available course details and return with a shortlist.',
            'route' => 'course',
            'label' => 'Compare courses',
        ],
    ],
    'clientele' => [
        'label' => 'Learning Across Stages',
        'title' => 'Find the resources that fit your interests.',
        'lead' => 'The platform brings together academic study, examination preparation and subject-focused legal learning.',
        'cards' => [
            [
                'title' => 'Students building foundations',
                'body' => 'Use courses, free notes and primary texts to connect new ideas with your regular academic reading.',
                'route' => 'copys',
                'link' => 'Explore free notes',
                'query' => null,
            ],
            [
                'title' => 'Aspirants planning preparation',
                'body' => 'Organize your reading around your chosen examination and explore the available preparation material.',
                'route' => 'govtexams',
                'link' => 'Explore exam resources',
                'query' => null,
            ],
            [
                'title' => 'Professionals revisiting a subject',
                'body' => 'Browse subject-focused courses and legal knowledge resources to identify areas for further study.',
                'route' => 'course',
                'link' => 'Browse subject courses',
                'query' => null,
            ],
        ],
        'story' => [
            'image' => 'community',
            'title' => 'Begin with your own learning goal.',
            'paragraphs' => [
                'Different learners need different starting points. A first-year student may want a subject overview, while another learner may be looking for a focused course or revision resource.',
                'Tell the team what you are studying, the programme you are interested in and the kind of information you need. The inquiry form on this page gives you a direct place to begin.',
            ],
            'points' => [
                'Share your subject interests',
                'Describe your current stage',
                'Ask about the programme that fits',
            ],
        ],
        'steps' => [
            [
                'title' => 'Explore a collection',
                'body' => 'Start with the resource or course category most relevant to you.',
            ],
            [
                'title' => 'Identify a next step',
                'body' => 'Choose a subject to study further or write down the questions you need answered.',
            ],
            [
                'title' => 'Introduce your learning needs',
                'body' => 'Use the existing client-network form to send your inquiry.',
            ],
        ],
        'faqs' => [
            [
                'question' => 'Who can explore the resources?',
                'answer' => 'The public collections are intended for students, aspirants, professionals and people interested in legal learning. Individual viewing or download actions may have sign-in requirements.',
            ],
            [
                'question' => 'How do I ask about joining a programme?',
                'answer' => 'Use the form on this page or a course card\'s Send Enquiry link. Include the programme name and your learning goal.',
            ],
            [
                'question' => 'Are the new learning images photographs of actual clients?',
                'answer' => 'The added learning scenes are illustrative. Client information and documents appear in the existing client section above.',
            ],
        ],
        'cta' => [
            'title' => 'Find your next subject to explore.',
            'body' => 'Compare the available programmes and choose a course to ask about.',
            'route' => 'course',
            'label' => 'Explore programmes',
        ],
    ],
    'gallery' => [
        'label' => 'Look Around',
        'title' => 'Explore the gallery, then discover the learning.',
        'lead' => 'Use the existing albums to browse photographs shared on the site, and follow your interests into the course and resource collections.',
        'cards' => [
            [
                'title' => 'Browse by album',
                'body' => 'Each gallery card groups photographs under its published album name. Open an album to explore its images.',
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Explore the platform',
                'body' => 'Read About Us for an overview of the learning resources available through Law Students.',
                'route' => 'about',
                'link' => 'About Law Students',
                'query' => null,
            ],
            [
                'title' => 'Ask about a programme',
                'body' => 'A photograph can introduce an activity; the course description and team can explain the programme details.',
                'route' => 'course',
                'link' => 'Explore the catalogue',
                'query' => null,
            ],
        ],
        'story' => [
            'image' => 'courses',
            'title' => 'See where your interest could take you.',
            'paragraphs' => [
                'After exploring the gallery, browse the course catalogue for the subjects that interest you. Look at each course\'s overview, learning level and available brochure.',
                'Use a course inquiry to learn more about the study arrangements. If your question relates to a particular album, include its name so the team can understand the context.',
            ],
            'points' => [
                'Explore the published albums',
                'Read the course information',
                'Ask about your chosen subject',
            ],
        ],
        'steps' => [],
        'faqs' => [
            [
                'question' => 'How do I browse an album?',
                'answer' => 'Select an album card in the gallery above. The existing gallery viewer opens its available photographs.',
            ],
            [
                'question' => 'Where can I find details of a course shown or mentioned?',
                'answer' => 'Browse Courses or contact the team with the album name and the programme you are asking about.',
            ],
            [
                'question' => 'Is the new introductory image an event photograph?',
                'answer' => 'The added introductory artwork is illustrative. The photographs in the existing gallery albums remain separate.',
            ],
        ],
        'cta' => [
            'title' => 'Explore the subjects behind your interest.',
            'body' => 'Take a look at the available courses and their published details.',
            'route' => 'course',
            'label' => 'Discover courses',
        ],
    ],
    'about' => [
        'label' => 'Our Academic Focus',
        'title' => 'Resources that support each part of your learning.',
        'lead' => 'Law Students brings together course information and legal reading collections so you can choose a useful next step.',
        'cards' => [
            [
                'title' => 'Academic exploration',
                'body' => 'Browse undergraduate, postgraduate and subject-focused course options and review the information provided for each.',
                'route' => 'course',
                'link' => 'Explore academic courses',
                'query' => null,
            ],
            [
                'title' => 'Independent reading',
                'body' => 'Use Bare Acts, Rules and free notes to build a reading routine around the subjects you want to understand.',
                'route' => 'acts',
                'link' => 'Explore Bare Acts',
                'query' => null,
            ],
            [
                'title' => 'Preparation and questions',
                'body' => 'Explore examination resources and use the inquiry pages when you need information about a topic or programme.',
                'route' => 'govtexams',
                'link' => 'Explore preparation material',
                'query' => null,
            ],
        ],
        'story' => [
            'image' => 'library',
            'title' => 'Learn with a question in mind.',
            'paragraphs' => [
                'Strong study habits begin with curiosity and a clear purpose. Choose a subject, identify a question and work through the available material with that question in view.',
                'Our public collections give you several starting points. Read a primary text, use a note for revision, explore a broader legal topic or compare the course options available for deeper study.',
            ],
            'points' => [
                'Start from your academic goal',
                'Connect different types of resources',
                'Choose a practical next step',
            ],
        ],
        'steps' => [],
        'faqs' => [
            [
                'question' => 'What can I find on Law Students?',
                'answer' => 'The website includes courses, Bare Acts, Rules, free notes, government examination material, a Legal Knowledge Library and inquiry pages.',
            ],
            [
                'question' => 'How can I decide whether a course suits me?',
                'answer' => 'Read its overview and level, check the brochure where available and ask the team about the programme arrangements before enrolling.',
            ],
            [
                'question' => 'Can I begin with free resources?',
                'answer' => 'Yes. Explore the Free Notes and public reading collections, using the available viewing and download options.',
            ],
        ],
        'cta' => [
            'title' => 'Start with the subject that matters to you.',
            'body' => 'Explore the catalogue and find a course you would like to discuss.',
            'route' => 'course',
            'label' => 'Explore our courses',
        ],
    ],
    'privacy' => [
        'label' => 'Reading the Policy',
        'title' => 'Find the information relevant to your question.',
        'lead' => 'Use the published privacy policy above as your reference. These pointers help you prepare a clear question for the team.',
        'cards' => [
            [
                'title' => 'Identify the interaction',
                'body' => 'Note whether your question relates to an inquiry, account, course or another part of the website.',
                'route' => null,
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Locate the policy section',
                'body' => 'Read the relevant part of the policy in full and note the heading you want to ask about.',
                'route' => null,
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Ask for clarification',
                'body' => 'Describe the information you need and reference the policy section in your message.',
                'route' => 'contact',
                'link' => 'Contact the team',
                'query' => null,
            ],
        ],
        'faqs' => [
            [
                'question' => 'Where can I find the privacy terms?',
                'answer' => 'Read the published privacy policy above. This reading guide helps you navigate it and does not add to or replace its provisions.',
            ],
            [
                'question' => 'How do I ask about a privacy concern?',
                'answer' => 'Use the contact details or contact form, describe your concern and identify the relevant interaction or policy section.',
            ],
        ],
        'cta' => [
            'title' => 'Need help understanding the policy?',
            'body' => 'Send a focused question to the team and refer to the section you want clarified.',
            'route' => 'contact',
            'label' => 'Ask a policy question',
        ],
    ],
    'terms' => [
        'label' => 'Before You Enrol',
        'title' => 'Review the details that shape your decision.',
        'lead' => 'Read the published terms above alongside the information for your chosen course.',
        'cards' => [
            [
                'title' => 'Course scope',
                'body' => 'Read the overview and brochure where available. Ask which subjects, materials and learning arrangements are included.',
                'route' => 'course',
                'link' => 'Review courses',
                'query' => null,
            ],
            [
                'title' => 'Access and arrangements',
                'body' => 'Confirm the schedule, delivery format, access period and any account requirements for the programme you choose.',
                'route' => null,
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Fees and refund information',
                'body' => 'Confirm the total payable amount and review the published refund policy before proceeding.',
                'route' => 'refund',
                'link' => 'Read the refund policy',
                'query' => null,
            ],
        ],
        'faqs' => [
            [
                'question' => 'Does this checklist replace the terms?',
                'answer' => 'No. The published terms above remain the reference for the website and its services. This checklist highlights questions to consider before choosing a course.',
            ],
            [
                'question' => 'Where do I confirm details for a particular programme?',
                'answer' => 'Use Send Enquiry on the relevant course card and ask the team about the specific arrangements you need to understand.',
            ],
        ],
        'cta' => [
            'title' => 'Choose with the information you need.',
            'body' => 'Ask about your selected programme before you make an enrolment decision.',
            'route' => 'contact',
            'label' => 'Discuss programme details',
        ],
    ],
    'disclaimer' => [
        'label' => 'Use Resources Thoughtfully',
        'title' => 'Keep the source and purpose in view.',
        'lead' => 'Read the published disclaimer above and use the collections with a clear study goal.',
        'cards' => [
            [
                'title' => 'Identify the resource',
                'body' => 'Note the document title and the topic you are studying so you can refer back to the same material.',
                'route' => null,
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Record your questions',
                'body' => 'Keep uncertainties alongside your notes rather than treating a short overview as the end of your research.',
                'route' => null,
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Choose a next step',
                'body' => 'Read related resources or describe your learning question through the Legal Knowledge inquiry form.',
                'route' => 'legal-knowledge',
                'link' => 'Open a knowledge inquiry',
                'query' => null,
            ],
        ],
        'faqs' => [
            [
                'question' => 'Where can I read the full disclaimer?',
                'answer' => 'The full published disclaimer appears above this guide. Refer to it for the stated context and limitations of the website\'s material.',
            ],
            [
                'question' => 'Where can I find related reading?',
                'answer' => 'Browse Bare Acts, Rules, Free Notes and the Legal Knowledge Library. Select resources relevant to your subject and study purpose.',
            ],
        ],
        'cta' => [
            'title' => 'Continue exploring your subject.',
            'body' => 'Use the library to discover related topics and further reading.',
            'route' => 'legalknowledgelibrary',
            'label' => 'Explore the library',
        ],
    ],
    'refund' => [
        'label' => 'Payment Questions',
        'title' => 'Prepare the details for a clear conversation.',
        'lead' => 'Read the full refund policy above before raising a payment or refund question. The policy determines the applicable conditions.',
        'cards' => [
            [
                'title' => 'Identify your programme',
                'body' => 'Have the course name and the nature of your request ready so the team can understand what you are asking about.',
                'route' => null,
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Review the applicable policy',
                'body' => 'Read the relevant provisions in full and note any points you need clarified.',
                'route' => null,
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Contact the team',
                'body' => 'Explain your request through the existing contact channel and ask which information is needed to review it.',
                'route' => 'contact',
                'link' => 'Open contact options',
                'query' => null,
            ],
        ],
        'faqs' => [
            [
                'question' => 'Does sending a request guarantee a refund?',
                'answer' => 'A request needs to be considered under the published policy. Read the conditions above and ask the team about your situation.',
            ],
            [
                'question' => 'Where can I confirm eligibility and timing?',
                'answer' => 'Refer to the published policy for its conditions and processing information. Contact the team if a point is unclear; this guide does not create a different refund entitlement or timeline.',
            ],
        ],
        'cta' => [
            'title' => 'Have a question about a payment?',
            'body' => 'Contact the team with the course name and a clear description of what you need.',
            'route' => 'contact',
            'label' => 'Ask a payment question',
        ],
    ],
    'sitemap' => [
        'label' => 'Choose a Starting Point',
        'title' => 'Find the right section for your goal.',
        'lead' => 'Use the full link directory above, or choose one of these common journeys.',
        'cards' => [
            [
                'title' => 'I want to choose a course',
                'body' => 'Browse the catalogue, compare the published descriptions and open an inquiry for your shortlist.',
                'route' => 'course',
                'link' => 'Find a course',
                'query' => null,
            ],
            [
                'title' => 'I want reading material',
                'body' => 'Start with Free Notes, then explore Bare Acts, Rules and the Legal Knowledge Library.',
                'route' => 'copys',
                'link' => 'Find free notes',
                'query' => null,
            ],
            [
                'title' => 'I need help or information',
                'body' => 'Use Contact Us for programme and platform questions or the Legal Knowledge form for a topic inquiry.',
                'route' => 'contact',
                'link' => 'Contact the team',
                'query' => null,
            ],
        ],
        'faqs' => [
            [
                'question' => 'Where are the site policies?',
                'answer' => 'The Policies group in the sitemap above links to Privacy Policy, Terms & Conditions, Disclaimer and Refund Policy.',
            ],
            [
                'question' => 'Where can I see new resources?',
                'answer' => 'Visit Announcements for recent additions linked to their relevant collections.',
            ],
        ],
        'cta' => [
            'title' => 'Not sure which section you need?',
            'body' => 'Describe your goal to the team and ask where to begin.',
            'route' => 'contact',
            'label' => 'Ask for directions',
        ],
    ],
    'announcements' => [
        'label' => 'Keep Learning',
        'title' => 'Turn a new addition into your next study session.',
        'lead' => 'The feed above brings recent resources together. Follow an entry to its collection and choose what fits your study plan.',
        'cards' => [
            [
                'title' => 'Browse recent additions',
                'body' => 'Review the title and resource type to identify material relevant to the subject you are studying.',
                'route' => null,
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Open the collection',
                'body' => 'Follow the entry, then use the destination page\'s categories or search to locate the resource.',
                'route' => null,
                'link' => 'Explore',
                'query' => null,
            ],
            [
                'title' => 'Connect it to your learning',
                'body' => 'Add relevant material to your reading plan and compare it with the notes or course you are using.',
                'route' => 'course',
                'link' => 'Explore related courses',
                'query' => null,
            ],
        ],
        'steps' => [
            [
                'title' => 'Notice',
                'body' => 'Choose a recent title that connects with your current subject.',
            ],
            [
                'title' => 'Read',
                'body' => 'Open the collection and inspect the available resource.',
            ],
            [
                'title' => 'Revisit',
                'body' => 'Write a short summary and one question for your next study session.',
            ],
        ],
        'faqs' => [
            [
                'question' => 'What appears in this feed?',
                'answer' => 'The existing feed brings together recent Bare Acts, Rules, free notes, examination material and legal knowledge added to the site.',
            ],
            [
                'question' => 'Are these official exam announcements?',
                'answer' => 'The feed describes additions to Law Students. Use the relevant examination authority for official notifications and application details.',
            ],
        ],
        'cta' => [
            'title' => 'Explore beyond the latest additions.',
            'body' => 'Find a legal topic to read about in the library.',
            'route' => 'legalknowledgelibrary',
            'label' => 'Browse the library',
        ],
    ],
];
