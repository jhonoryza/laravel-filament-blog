import { withCtx, unref, createVNode, openBlock, createBlock, Fragment, renderList, toDisplayString, useSSRContext } from "vue";
import { ssrRenderComponent, ssrRenderAttr, ssrRenderList, ssrInterpolate } from "vue/server-renderer";
import { Head } from "@inertiajs/vue3";
import _sfc_main$1 from "./Base-D2lUmFxp.js";
import "./Nav-kMGTw3sP.js";
import "./ToggleDarkMode-JFaivfUX.js";
import "@tabler/icons-vue";
import "./Footer-B-2zln9Z.js";
const _sfc_main = {
  __name: "Index",
  __ssrInlineRender: true,
  props: {
    tools: Object,
    meta: Array
  },
  setup(__props) {
    const gotoLink = (url) => {
      window.open(url, "_blank");
    };
    return (_ctx, _push, _parent, _attrs) => {
      _push(ssrRenderComponent(_sfc_main$1, _attrs, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(ssrRenderComponent(unref(Head), {
              title: __props.meta.title
            }, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  _push3(`<meta name="description"${ssrRenderAttr("content", __props.meta.desc)}${_scopeId2}><meta property="og:title"${ssrRenderAttr("content", __props.meta.title)}${_scopeId2}><meta property="og:type"${ssrRenderAttr("content", __props.meta.og_type)}${_scopeId2}><meta property="og:image"${ssrRenderAttr("content", __props.meta.image)}${_scopeId2}><meta property="og:description"${ssrRenderAttr("content", __props.meta.desc)}${_scopeId2}><meta name="twitter:title"${ssrRenderAttr("content", __props.meta.title)}${_scopeId2}><meta name="twitter:card"${ssrRenderAttr("content", __props.meta.tw_card)}${_scopeId2}><meta name="twitter:description"${ssrRenderAttr("content", __props.meta.desc)}${_scopeId2}><meta name="twitter:image"${ssrRenderAttr("content", __props.meta.image)}${_scopeId2}>`);
                } else {
                  return [
                    createVNode("meta", {
                      name: "description",
                      content: __props.meta.desc
                    }, null, 8, ["content"]),
                    createVNode("meta", {
                      property: "og:title",
                      content: __props.meta.title
                    }, null, 8, ["content"]),
                    createVNode("meta", {
                      property: "og:type",
                      content: __props.meta.og_type
                    }, null, 8, ["content"]),
                    createVNode("meta", {
                      property: "og:image",
                      content: __props.meta.image
                    }, null, 8, ["content"]),
                    createVNode("meta", {
                      property: "og:description",
                      content: __props.meta.desc
                    }, null, 8, ["content"]),
                    createVNode("meta", {
                      name: "twitter:title",
                      content: __props.meta.title
                    }, null, 8, ["content"]),
                    createVNode("meta", {
                      name: "twitter:card",
                      content: __props.meta.tw_card
                    }, null, 8, ["content"]),
                    createVNode("meta", {
                      name: "twitter:description",
                      content: __props.meta.desc
                    }, null, 8, ["content"]),
                    createVNode("meta", {
                      name: "twitter:image",
                      content: __props.meta.image
                    }, null, 8, ["content"])
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
            _push2(`<div class="flex flex-col space-y-1 mx-4 text-primary dark:text-slate-300"${_scopeId}><h1 class="font-bold text-xl"${_scopeId}>Go Packages</h1><div class="flex flex-col space-y-2"${_scopeId}><!--[-->`);
            ssrRenderList(__props.tools, (tool) => {
              _push2(`<div class="border border-slate-100 shadow py-2 px-2 hover:cursor-pointer hover:opacity-60 rounded"${_scopeId}><h2 class="text-lg font-medium"${_scopeId}>${ssrInterpolate(tool.name)}</h2><p class="text-secondary"${_scopeId}>${ssrInterpolate(tool.desc)}</p></div>`);
            });
            _push2(`<!--]--></div></div>`);
          } else {
            return [
              createVNode(unref(Head), {
                title: __props.meta.title
              }, {
                default: withCtx(() => [
                  createVNode("meta", {
                    name: "description",
                    content: __props.meta.desc
                  }, null, 8, ["content"]),
                  createVNode("meta", {
                    property: "og:title",
                    content: __props.meta.title
                  }, null, 8, ["content"]),
                  createVNode("meta", {
                    property: "og:type",
                    content: __props.meta.og_type
                  }, null, 8, ["content"]),
                  createVNode("meta", {
                    property: "og:image",
                    content: __props.meta.image
                  }, null, 8, ["content"]),
                  createVNode("meta", {
                    property: "og:description",
                    content: __props.meta.desc
                  }, null, 8, ["content"]),
                  createVNode("meta", {
                    name: "twitter:title",
                    content: __props.meta.title
                  }, null, 8, ["content"]),
                  createVNode("meta", {
                    name: "twitter:card",
                    content: __props.meta.tw_card
                  }, null, 8, ["content"]),
                  createVNode("meta", {
                    name: "twitter:description",
                    content: __props.meta.desc
                  }, null, 8, ["content"]),
                  createVNode("meta", {
                    name: "twitter:image",
                    content: __props.meta.image
                  }, null, 8, ["content"])
                ]),
                _: 1
              }, 8, ["title"]),
              createVNode("div", { class: "flex flex-col space-y-1 mx-4 text-primary dark:text-slate-300" }, [
                createVNode("h1", { class: "font-bold text-xl" }, "Go Packages"),
                createVNode("div", { class: "flex flex-col space-y-2" }, [
                  (openBlock(true), createBlock(Fragment, null, renderList(__props.tools, (tool) => {
                    return openBlock(), createBlock("div", {
                      key: tool.id,
                      class: "border border-slate-100 shadow py-2 px-2 hover:cursor-pointer hover:opacity-60 rounded",
                      onClick: ($event) => gotoLink(tool.link)
                    }, [
                      createVNode("h2", { class: "text-lg font-medium" }, toDisplayString(tool.name), 1),
                      createVNode("p", { class: "text-secondary" }, toDisplayString(tool.desc), 1)
                    ], 8, ["onClick"]);
                  }), 128))
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Package/Go/Index.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
