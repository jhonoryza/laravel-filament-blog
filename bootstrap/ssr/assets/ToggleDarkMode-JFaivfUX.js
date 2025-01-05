import { ref, onMounted, mergeProps, unref, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrRenderComponent } from "vue/server-renderer";
import { IconSun, IconMoon } from "@tabler/icons-vue";
const _sfc_main = {
  __name: "ToggleDarkMode",
  __ssrInlineRender: true,
  setup(__props) {
    const colorMode = ref(localStorage.getItem("color-mode") || void 0);
    onMounted(() => {
      if (colorMode.value === void 0) {
        colorMode.value = window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        localStorage.setItem("color-mode", colorMode.value);
      }
      const rootElement = document.documentElement;
      if (colorMode.value === "light") {
        rootElement.classList.remove("dark");
      } else {
        rootElement.classList.add("dark");
      }
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<button${ssrRenderAttrs(mergeProps({ class: "inline-flex items-center p-2 focus:outline-none rounded-md" }, _attrs))}>`);
      if (colorMode.value === "light") {
        _push(ssrRenderComponent(unref(IconSun), { class: "size-6 text-primary-400 font-normal" }, null, _parent));
      } else {
        _push(ssrRenderComponent(unref(IconMoon), { class: "size-5 stroke-white" }, null, _parent));
      }
      _push(`</button>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/ToggleDarkMode.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
