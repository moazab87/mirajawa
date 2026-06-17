(function () {
    'use strict';

    const SELECTOR = 'textarea.mj-rich-editor';
    const initialized = new Set();

    function directionForLang(lang) {
        return lang === 'ar' ? 'rtl' : 'ltr';
    }

    function buildConfig(textarea) {
        const lang = textarea.dataset.lang || 'en';
        const dir = directionForLang(lang);

        return {
            target: textarea,
            height: 320,
            menubar: false,
            statusbar: false,
            branding: false,
            promotion: false,
            license_key: 'gpl',
            directionality: dir,
            plugins: 'lists link autolink code directionality',
            toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright | bullist numlist | link | removeformat | code',
            block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3',
            content_style: 'body { font-family: IBM Plex Sans, Rubik, Noto Sans JP, sans-serif; font-size: 14px; line-height: 1.6; direction: ' + dir + '; }',
            setup(editor) {
                editor.on('change keyup', () => editor.save());
            },
        };
    }

    function ensureId(textarea) {
        if (!textarea.id) {
            textarea.id = 'mj-editor-' + Math.random().toString(36).slice(2, 11);
        }

        return textarea.id;
    }

    function initEditor(textarea) {
        if (typeof tinymce === 'undefined') {
            return;
        }

        const id = ensureId(textarea);

        if (initialized.has(id) || tinymce.get(id)) {
            return;
        }

        initialized.add(id);
        tinymce.init(buildConfig(textarea));
    }

    function initEditorsIn(container) {
        if (!container) {
            return;
        }

        container.querySelectorAll(SELECTOR).forEach(initEditor);
    }

    window.MjRichEditor = {
        initAll(root) {
            initEditorsIn(root || document);
        },
    };

    document.addEventListener('DOMContentLoaded', () => {
        const activePane = document.querySelector('.tab-pane.show.active');
        initEditorsIn(activePane || document);

        document.querySelectorAll('[data-bs-toggle="tab"]').forEach((tab) => {
            tab.addEventListener('shown.bs.tab', (event) => {
                const target = event.target.getAttribute('data-bs-target');

                if (target) {
                    initEditorsIn(document.querySelector(target));
                }
            });
        });

        document.querySelectorAll('form').forEach((form) => {
            form.addEventListener('submit', () => {
                if (typeof tinymce !== 'undefined') {
                    tinymce.triggerSave();
                }
            });
        });
    });
})();
