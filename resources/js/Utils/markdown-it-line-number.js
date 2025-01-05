import hljs from "highlight.js/lib/core";

function applyLineNumbers(code, lang) {
    const lines = code.trim().split('\n');

    const rows = lines.map((line, idx) => {
        let lineNumber = idx + 1;
        if (lines.length === 1) {
            lineNumber = '';
        }
        if (lang === 'bash') {
            lineNumber = '$';
        }

        let html = '<tr>';
        html += `<td class="text-sky-600">${lineNumber}</td>`;
        html += `<td>${line}</td>`;
        html += '</tr>';
        return html;
    });

    return `<table><tbody>${rows.join('')}</tbody></table>`;
}

export const markdownItLineNumber = (md) => {
    md.options.highlight = (code, lang, attrs) => {
        let rendered = lang && hljs.getLanguage(lang)
            ? hljs.highlight(code, {
                language: lang,
                ignoreIllegals: true,
            }).value
            : md.utils.escapeHtml(code);

        rendered = applyLineNumbers(rendered, lang);

        return `${rendered}`;
    }
};
