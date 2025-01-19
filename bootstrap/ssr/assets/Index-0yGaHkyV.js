import { withCtx, createVNode, openBlock, createBlock, Fragment, renderList, toDisplayString, useSSRContext } from "vue";
import { ssrRenderComponent, ssrRenderList, ssrInterpolate } from "vue/server-renderer";
import _sfc_main$1 from "./Base-9J_gqh7U.js";
import "./Nav-BS4sGgs1.js";
import "@inertiajs/vue3";
import "./ToggleDarkMode-JFaivfUX.js";
import "@tabler/icons-vue";
import "./Footer-B-2zln9Z.js";
const _sfc_main = {
  __name: "Index",
  __ssrInlineRender: true,
  props: {
    components: Object
  },
  setup(__props) {
    const gotoLink = (url) => {
      window.open(url, "_blank");
    };
    return (_ctx, _push, _parent, _attrs) => {
      _push(ssrRenderComponent(_sfc_main$1, _attrs, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<div class="flex flex-col space-y-1 mx-4 text-primary dark:text-slate-300"${_scopeId}><h1 class="font-bold text-xl"${_scopeId}>Components</h1><div class="flex flex-col space-y-2"${_scopeId}><!--[-->`);
            ssrRenderList(__props.components, (tool) => {
              _push2(`<div class="border border-slate-100 shadow py-2 px-2 hover:cursor-pointer hover:opacity-60 rounded"${_scopeId}><h2 class="text-lg font-medium"${_scopeId}>${ssrInterpolate(tool.name)}</h2><div class="flex gap-2 flex-row"${_scopeId}><!--[-->`);
              ssrRenderList(tool.styles, (style) => {
                _push2(`<p class="py-1 px-2 shadow rounded dark:bg-slate-900 bg-lime-200 text-xs"${_scopeId}>${ssrInterpolate(style.name)}</p>`);
              });
              _push2(`<!--]--></div></div>`);
            });
            _push2(`<!--]--></div></div>`);
          } else {
            return [
              createVNode("div", { class: "flex flex-col space-y-1 mx-4 text-primary dark:text-slate-300" }, [
                createVNode("h1", { class: "font-bold text-xl" }, "Components"),
                createVNode("div", { class: "flex flex-col space-y-2" }, [
                  (openBlock(true), createBlock(Fragment, null, renderList(__props.components, (tool) => {
                    return openBlock(), createBlock("div", {
                      key: tool.id,
                      class: "border border-slate-100 shadow py-2 px-2 hover:cursor-pointer hover:opacity-60 rounded",
                      onClick: ($event) => gotoLink(tool.link)
                    }, [
                      createVNode("h2", { class: "text-lg font-medium" }, toDisplayString(tool.name), 1),
                      createVNode("div", { class: "flex gap-2 flex-row" }, [
                        (openBlock(true), createBlock(Fragment, null, renderList(tool.styles, (style) => {
                          return openBlock(), createBlock("p", {
                            key: style.id,
                            class: "py-1 px-2 shadow rounded dark:bg-slate-900 bg-lime-200 text-xs"
                          }, toDisplayString(style.name), 1);
                        }), 128))
                      ])
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
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Component/Index.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
