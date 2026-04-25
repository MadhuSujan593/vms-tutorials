<style>
    .vms-markdown table {
        display: table;
        width: 100%;
        margin-bottom: 2rem;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 0.75rem;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    }
    .dark .vms-markdown table {
        border-color: #334155;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.3);
    }
    .vms-markdown table th,
    .vms-markdown table td {
        padding: 1rem 1.25rem;
        text-align: left;
        border-bottom: 1px solid #e2e8f0;
    }
    .dark .vms-markdown table th,
    .dark .vms-markdown table td {
        border-bottom-color: #334155;
    }
    .vms-markdown table th {
        background-color: #f8fafc;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }
    .dark .vms-markdown table th {
        background-color: #0f172a;
        color: #94a3b8;
    }
    .vms-markdown table tbody tr {
        background-color: #ffffff;
        transition: all 0.2s ease;
    }
    .dark .vms-markdown table tbody tr {
        background-color: #1e293b;
    }
    .vms-markdown table tbody tr:hover {
        background-color: #f1f5f9;
    }
    .dark .vms-markdown table tbody tr:hover {
        background-color: rgba(51, 65, 85, 0.5);
    }
    .vms-markdown table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Force Prism colors to ALWAYS win over Tailwind prose */
    .vms-markdown pre[class*="language-"] {
        color: #ccc !important; /* Default fallback text color for code */
    }
    .dark .vms-markdown pre[class*="language-"] {
        color: #eee !important;
    }
    .vms-markdown li:empty, 
    .vms-markdown li > p:empty {
        display: none !important;
    }
    
    /* Override Tailwind Prose list styling to perfectly match TinyMCE editor */
    div.vms-markdown.prose ul, 
    div.vms-markdown.prose ol {
        margin-top: 0.5rem !important;
        margin-bottom: 0.5rem !important;
    }
    div.vms-markdown.prose ul:not([style]), 
    div.vms-markdown.prose ol:not([style]) {
        padding-left: 1.25rem; /* Set back to 20px baseline */
    }
    div.vms-markdown.prose li {
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        padding-left: 0 !important; /* Keep the bullet-to-text gap standard to align under "P" */
    }
    div.vms-markdown.prose li > * {
        /* Remove strict blockers to allow TinyMCE's intentional indenting to show up */
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }
    .vms-markdown ul, .vms-markdown ul ul, .vms-markdown ul ul ul {
        list-style-type: disc !important;
    }
    .vms-markdown ol, .vms-markdown ol ol, .vms-markdown ol ol ol {
        list-style-type: decimal !important;
    }
    .vms-markdown li::marker {
        color: #111827 !important;
        font-size: 1.1em;
    }
    .dark .vms-markdown li::marker {
        color: #f3f4f6 !important;
    }
</style>
<div class="vms-markdown prose prose-base dark:prose-invert max-w-none 
    prose-headings:font-bold prose-headings:tracking-tight
    prose-h2:text-xl prose-h2:mt-8 prose-h2:mb-4 prose-h2:border-b prose-h2:pb-2 prose-h2:border-gray-100 dark:prose-h2:border-gray-800
    prose-h3:text-lg prose-h3:mt-6 prose-h3:mb-3
    prose-p:text-gray-600 dark:prose-p:text-gray-400 prose-p:leading-relaxed
    prose-pre:!bg-gray-900 prose-pre:p-4 prose-pre:rounded-xl prose-pre:shadow-xl prose-pre:border prose-pre:border-gray-800 dark:prose-pre:!bg-[rgba(15,23,42,0.8)]
    prose-code:text-indigo-600 dark:prose-code:text-indigo-400 prose-code:bg-indigo-50 dark:prose-code:bg-indigo-900/30 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded-md prose-code:before:content-none prose-code:after:content-none
    [&_pre_code]:!bg-transparent [&_pre_code]:!p-0 dark:[&_pre_code]:!bg-transparent
    prose-a:text-indigo-600 dark:prose-a:text-indigo-400 prose-a:no-underline hover:prose-a:underline
    prose-ul:list-disc prose-ol:list-decimal">
    {!! $html !!}
</div>