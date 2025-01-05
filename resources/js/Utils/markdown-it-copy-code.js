function copyCode(button) {
    const codeElement = button.closest('.code').querySelector('pre code');
    if (!codeElement) return;

    const rows = codeElement.querySelectorAll('tr');

    let codeWithoutLineNumbers = '';

    rows.forEach(row => {
        const codeCell = row.querySelectorAll('td')[1];
        if (codeCell) {
            codeWithoutLineNumbers += codeCell.textContent + '\n';
        }
    });

    // Get the text content from the <code> block
    const code = codeWithoutLineNumbers === '' ? codeElement.textContent : codeWithoutLineNumbers;

    // Check if the Clipboard API is available
    if (navigator.clipboard) {
        navigator.clipboard.writeText(code).then(() => {
            button.textContent = 'Copied';

            setTimeout(() => {
                button.textContent = 'Copy';
            }, 2000);
        }).catch((err) => {
            console.error('Clipboard write failed', err);
            fallbackCopyCode(button, code);
        });
    } else {
        fallbackCopyCode(button, code);
    }
}

// Fallback method using document.execCommand for older browsers or unsupported environments
function fallbackCopyCode(button, code) {
    const textarea = document.createElement('textarea');
    textarea.value = code;
    document.body.appendChild(textarea);
    textarea.select();
    const successful = document.execCommand('copy');
    document.body.removeChild(textarea);

    if (successful) {
        button.textContent = 'Copied';

        setTimeout(() => {
            button.textContent = 'Copy';
        }, 2000);
    } else {
        button.textContent = 'Failed';

        setTimeout(() => {
            button.textContent = 'Copy';
        }, 2000);
    }
}

function renderCodeFence(renderer) {
    return function (tokens, idx, options, env, self) {
        const lang = tokens[idx].info.trim();
        const content = tokens[idx].content
        const rendered = renderer(tokens, idx, options, env, self)

        if (content.length === 0 || content === '\n') {
            return rendered
        }

        return `
          <div class="code">
            <div class="flex justify-between items-center bg-amber-950 rounded-t">
                <p class=" text-orange-100 p-2 my-0 text-sm">${ lang.toUpperCase() }</p>
                <button
                  class="hover:block text-orange-100 text-sm px-3 py-1
                  rounded shadow hover:text-orange-200 focus:outline-none
                  transition-all duration-300"
                  onclick="copyCode(this)"
                >
                  Copy
                </button>
            </div>
            ${rendered}
          </div>
        `;
    };
}

export default function markdownItCopyCode(md) {
    if (typeof window !== 'undefined') {
        window.copyCode = copyCode;
    }

    md.renderer.rules.fence = renderCodeFence(md.renderer.rules.fence)
}
