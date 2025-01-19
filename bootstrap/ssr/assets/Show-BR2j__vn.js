import { ref, onMounted, withCtx, unref, createTextVNode, createVNode, openBlock, createBlock, toDisplayString, createCommentVNode, useSSRContext } from "vue";
import { ssrRenderComponent, ssrRenderAttr, ssrInterpolate, ssrRenderClass } from "vue/server-renderer";
import { Link } from "@inertiajs/vue3";
import _sfc_main$1 from "./Base-9J_gqh7U.js";
import markdownIt from "markdown-it";
import markdownItSub from "markdown-it-sub";
import markdownItSup from "markdown-it-sup";
import markdownItFootnote from "markdown-it-footnote";
import markdownItDeflist from "markdown-it-deflist";
import markdownItAbbr from "markdown-it-abbr";
import markdownItContainer from "markdown-it-container";
import markdownItMark from "markdown-it-mark";
import markdownItAnchor from "markdown-it-anchor";
import { slugify } from "@mdit-vue/shared";
import { full } from "markdown-it-emoji";
import hljs from "highlight.js/lib/core";
import highlightjs from "markdown-it-highlightjs";
import "./Nav-BS4sGgs1.js";
import "./ToggleDarkMode-JFaivfUX.js";
import "@tabler/icons-vue";
import "./Footer-B-2zln9Z.js";
function copyCode(button) {
  const codeElement = button.closest(".code").querySelector("pre code");
  if (!codeElement) return;
  const rows = codeElement.querySelectorAll("tr");
  let codeWithoutLineNumbers = "";
  rows.forEach((row) => {
    const codeCell = row.querySelectorAll("td")[1];
    if (codeCell) {
      codeWithoutLineNumbers += codeCell.textContent + "\n";
    }
  });
  const code = codeWithoutLineNumbers === "" ? codeElement.textContent : codeWithoutLineNumbers;
  if (navigator.clipboard) {
    navigator.clipboard.writeText(code).then(() => {
      button.textContent = "Copied";
      setTimeout(() => {
        button.textContent = "Copy";
      }, 2e3);
    }).catch((err) => {
      console.error("Clipboard write failed", err);
      fallbackCopyCode(button, code);
    });
  } else {
    fallbackCopyCode(button, code);
  }
}
function fallbackCopyCode(button, code) {
  const textarea = document.createElement("textarea");
  textarea.value = code;
  document.body.appendChild(textarea);
  textarea.select();
  const successful = document.execCommand("copy");
  document.body.removeChild(textarea);
  if (successful) {
    button.textContent = "Copied";
    setTimeout(() => {
      button.textContent = "Copy";
    }, 2e3);
  } else {
    button.textContent = "Failed";
    setTimeout(() => {
      button.textContent = "Copy";
    }, 2e3);
  }
}
function renderCodeFence(renderer) {
  return function(tokens, idx, options, env, self) {
    const lang = tokens[idx].info.trim();
    const content = tokens[idx].content;
    const rendered = renderer(tokens, idx, options, env, self);
    if (content.length === 0 || content === "\n") {
      return rendered;
    }
    return `
          <div class="code">
            <div class="flex justify-between items-center bg-material rounded-t">
                <p class=" text-zinc-100 p-2 my-0 text-sm">${lang.toUpperCase()}</p>
                <button
                  class="hover:block text-zinc-100 text-sm px-3 py-1
                  rounded shadow hover:text-zinc-200 focus:outline-none
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
function markdownItCopyCode(md) {
  if (typeof window !== "undefined") {
    window.copyCode = copyCode;
  }
  md.renderer.rules.fence = renderCodeFence(md.renderer.rules.fence);
}
function applyLineNumbers(code, lang) {
  const lines = code.trim().split("\n");
  const rows = lines.map((line, idx) => {
    let lineNumber = idx + 1;
    if (lines.length === 1) {
      lineNumber = "";
    }
    if (lang === "bash") {
      lineNumber = "$";
    }
    let html = "<tr>";
    html += `<td class="text-sky-600">${lineNumber}</td>`;
    html += `<td>${line}</td>`;
    html += "</tr>";
    return html;
  });
  return `<table><tbody>${rows.join("")}</tbody></table>`;
}
const markdownItLineNumber = (md) => {
  md.options.highlight = (code, lang, attrs) => {
    let rendered = lang && hljs.getLanguage(lang) ? hljs.highlight(code, {
      language: lang,
      ignoreIllegals: true
    }).value : md.utils.escapeHtml(code);
    rendered = applyLineNumbers(rendered, lang);
    return `${rendered}`;
  };
};
async function renderMarkdown(markdown) {
  const md = markdownIt({
    html: true,
    linkify: true,
    breaks: true
  });
  md.linkify.set({ fuzzyLink: false });
  md.use(highlightjs, { hljs }).use(markdownItLineNumber).use(markdownItContainer).use(markdownItMark).use(markdownItSub).use(markdownItSup).use(markdownItFootnote).use(markdownItDeflist).use(markdownItAbbr).use(full).use(markdownItCopyCode).use(markdownItAnchor, {
    slugify,
    permalink: markdownItAnchor.permalink.linkInsideHeader({
      symbol: `<span class="opacity-60 text-blue-600 dark:text-white hover:opacity-100 transition hover:text-blue-300">#</span>`,
      placement: "before"
    })
  });
  return md.render(markdown);
}
const _sfc_main = {
  __name: "Show",
  __ssrInlineRender: true,
  props: {
    post: Object
  },
  setup(__props) {
    const props = __props;
    const renderedContent = ref("");
    onMounted(async () => {
      renderedContent.value = await renderMarkdown(props.post.content);
    });
    const scrollToTop = () => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    };
    return (_ctx, _push, _parent, _attrs) => {
      _push(ssrRenderComponent(_sfc_main$1, _attrs, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<div class="max-w-xl font-rubik text-lg"${_scopeId}>`);
            _push2(ssrRenderComponent(unref(Link), {
              href: _ctx.route("home"),
              class: "p-2 text-primary dark:text-white rounded-lg hover:opacity-60"
            }, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(` ⬅ Go Back `);
                } else {
                  return [
                    createTextVNode(" ⬅ Go Back ")
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
            if (__props.post) {
              _push2(`<article class="flex flex-col gap-1 my-12"${_scopeId}><img class="w-48 h-48 object-cover rounded-md"${ssrRenderAttr("src", __props.post.thumbnail)}${ssrRenderAttr("alt", __props.post.title)}${_scopeId}><h1 class="mt-4 text-primary dark:text-white text-5xl font-bold"${_scopeId}>${ssrInterpolate(__props.post.title)}</h1><span class="mt-4 text-secondary"${_scopeId}> Published on: ${ssrInterpolate(__props.post.publishedAt)}</span><span class="mt-0 text-primary dark:text-white"${_scopeId}>Categories: ${ssrInterpolate(__props.post.categories_name)}</span><span class="mt-0 text-primary dark:text-white"${_scopeId}>Author: ${ssrInterpolate(__props.post.author_name)}</span><div class="${ssrRenderClass({
                "mt-4 prose-lg": true,
                "prose-p:max-w-xl prose-h1:max-w-xl prose-h2:max-w-xl": true,
                "prose-ul:max-w-xl prose-li:max-w-xl prose-table:max-w-xl": true,
                "prose-thead:max-w-xl prose-tbody:max-w-xl prose-pre:max-w-xl": true,
                "prose-code:max-w-xl": true,
                "prose-pre:m-0 prose-pre:p-0": true,
                "prose-a:break-words prose-pre:w-full": true,
                "prose-ul:list-square": true,
                "prose-code:bg-lime-100 prose-code:p-1 prose-code:rounded-b": true,
                "prose-code:text-black": true
                // 'prose-code:text-slate-200': post.is_markdown === false,
              })}"${_scopeId}>${renderedContent.value ?? ""}</div></article>`);
            } else {
              _push2(`<!---->`);
            }
            _push2(`<div class="flex justify-between"${_scopeId}>`);
            _push2(ssrRenderComponent(unref(Link), {
              href: _ctx.route("home"),
              class: "p-2 text-primary dark:text-white rounded-lg hover:opacity-60"
            }, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(` ⬅ Go Back `);
                } else {
                  return [
                    createTextVNode(" ⬅ Go Back ")
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
            _push2(`<button class="px-4 py-2 rounded-full hover:opacity-60"${_scopeId}> ⬆ </button></div></div>`);
          } else {
            return [
              createVNode("div", { class: "max-w-xl font-rubik text-lg" }, [
                createVNode(unref(Link), {
                  href: _ctx.route("home"),
                  class: "p-2 text-primary dark:text-white rounded-lg hover:opacity-60"
                }, {
                  default: withCtx(() => [
                    createTextVNode(" ⬅ Go Back ")
                  ]),
                  _: 1
                }, 8, ["href"]),
                __props.post ? (openBlock(), createBlock("article", {
                  key: 0,
                  class: "flex flex-col gap-1 my-12"
                }, [
                  createVNode("img", {
                    class: "w-48 h-48 object-cover rounded-md",
                    src: __props.post.thumbnail,
                    alt: __props.post.title
                  }, null, 8, ["src", "alt"]),
                  createVNode("h1", { class: "mt-4 text-primary dark:text-white text-5xl font-bold" }, toDisplayString(__props.post.title), 1),
                  createVNode("span", { class: "mt-4 text-secondary" }, " Published on: " + toDisplayString(__props.post.publishedAt), 1),
                  createVNode("span", { class: "mt-0 text-primary dark:text-white" }, "Categories: " + toDisplayString(__props.post.categories_name), 1),
                  createVNode("span", { class: "mt-0 text-primary dark:text-white" }, "Author: " + toDisplayString(__props.post.author_name), 1),
                  createVNode("div", {
                    innerHTML: renderedContent.value,
                    class: {
                      "mt-4 prose-lg": true,
                      "prose-p:max-w-xl prose-h1:max-w-xl prose-h2:max-w-xl": true,
                      "prose-ul:max-w-xl prose-li:max-w-xl prose-table:max-w-xl": true,
                      "prose-thead:max-w-xl prose-tbody:max-w-xl prose-pre:max-w-xl": true,
                      "prose-code:max-w-xl": true,
                      "prose-pre:m-0 prose-pre:p-0": true,
                      "prose-a:break-words prose-pre:w-full": true,
                      "prose-ul:list-square": true,
                      "prose-code:bg-lime-100 prose-code:p-1 prose-code:rounded-b": true,
                      "prose-code:text-black": true
                      // 'prose-code:text-slate-200': post.is_markdown === false,
                    }
                  }, null, 8, ["innerHTML"])
                ])) : createCommentVNode("", true),
                createVNode("div", { class: "flex justify-between" }, [
                  createVNode(unref(Link), {
                    href: _ctx.route("home"),
                    class: "p-2 text-primary dark:text-white rounded-lg hover:opacity-60"
                  }, {
                    default: withCtx(() => [
                      createTextVNode(" ⬅ Go Back ")
                    ]),
                    _: 1
                  }, 8, ["href"]),
                  createVNode("button", {
                    onClick: scrollToTop,
                    class: "px-4 py-2 rounded-full hover:opacity-60"
                  }, " ⬆ ")
                ])
              ])
            ];
          }
        }),
        _: 1
      }, _parent));
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Post/Show.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
