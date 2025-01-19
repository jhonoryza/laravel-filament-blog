import markdownIt from 'markdown-it';
import markdownItSub from 'markdown-it-sub';
import markdownItSup from 'markdown-it-sup';
import markdownItFootnote from 'markdown-it-footnote';
import markdownItDeflist from 'markdown-it-deflist';
import markdownItAbbr from 'markdown-it-abbr';
import markdownItContainer from 'markdown-it-container';
import markdownItMark from 'markdown-it-mark';
import markdownItAnchor from 'markdown-it-anchor';
import {slugify} from '@mdit-vue/shared';
import {full as emoji} from 'markdown-it-emoji'
import markdownItCopyCode from "@/Utils/markdown-it-copy-code.js";
import {markdownItLineNumber} from "@/Utils/markdown-it-line-number.js";

import highlightjs from 'markdown-it-highlightjs';
import hljs from 'highlight.js/lib/core';

/** to change code theme change this import styles */
//import 'highlight.js/styles/base16/gruvbox-dark-soft.min.css';
import 'highlight.js/styles/base16/material.min.css';

export async function renderMarkdown(markdown) {
    const md = markdownIt({
        html: true,
        linkify: true,
        breaks: true,
    });

    md.linkify.set({fuzzyLink: false})

    md
        .use(highlightjs, { hljs })
        .use(markdownItLineNumber)
        .use(markdownItContainer)
        .use(markdownItMark)
        .use(markdownItSub)
        .use(markdownItSup)
        .use(markdownItFootnote)
        .use(markdownItDeflist)
        .use(markdownItAbbr)
        .use(emoji)
        .use(markdownItCopyCode)
        .use(markdownItAnchor, {
            slugify,
            permalink: markdownItAnchor.permalink.linkInsideHeader({
                symbol: `<span class="opacity-60 text-blue-600 dark:text-white hover:opacity-100 transition hover:text-blue-300">#</span>`,
                placement: 'before',
            }),
        });

    return md.render(markdown);
}
