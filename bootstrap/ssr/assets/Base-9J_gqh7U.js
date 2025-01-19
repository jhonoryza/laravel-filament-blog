import { mergeProps, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderSlot } from "vue/server-renderer";
import _sfc_main$1 from "./Nav-BS4sGgs1.js";
import _sfc_main$2 from "./Footer-B-2zln9Z.js";
import "@inertiajs/vue3";
import "./ToggleDarkMode-JFaivfUX.js";
import "@tabler/icons-vue";
const _sfc_main = {
  __name: "Base",
  __ssrInlineRender: true,
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "dark:bg-zinc-800 dark:text-white" }, _attrs))}><div class="min-h-screen max-w-xl flex flex-col bg-white mx-auto subpixel-antialiased dark:bg-zinc-800 dark:text-white">`);
      _push(ssrRenderComponent(_sfc_main$1, null, null, _parent));
      _push(`<main class="grow flex flex-col"><div class="mt-20 grow flex flex-col justify-between">`);
      ssrRenderSlot(_ctx.$slots, "default", {}, null, _push, _parent);
      _push(`</div></main>`);
      _push(ssrRenderComponent(_sfc_main$2, null, null, _parent));
      _push(`</div></div>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Base.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
