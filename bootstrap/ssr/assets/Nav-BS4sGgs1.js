import { ref, resolveDirective, mergeProps, unref, withCtx, createTextVNode, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrGetDirectiveProps, ssrRenderComponent, ssrRenderStyle } from "vue/server-renderer";
import { Link } from "@inertiajs/vue3";
import _sfc_main$1 from "./ToggleDarkMode-JFaivfUX.js";
import "@tabler/icons-vue";
const _sfc_main = {
  __name: "Nav",
  __ssrInlineRender: true,
  setup(__props) {
    const breadIsOpen = ref(false);
    function closeBread() {
      breadIsOpen.value = false;
    }
    return (_ctx, _push, _parent, _attrs) => {
      const _directive_click_away = resolveDirective("click-away");
      _push(`<nav${ssrRenderAttrs(mergeProps({ class: "bg-white dark:bg-zinc-800 dark:text-white border-b border-zinc-300 h-14 fixed top-0 left-0 right-0 z-50 flex flex-col justify-center items-center max-w-xl mx-auto" }, _attrs))}><div${ssrRenderAttrs(mergeProps({ class: "container mx-auto" }, ssrGetDirectiveProps(_ctx, _directive_click_away, closeBread)))}><div class="mx-2 flex justify-between items-center gap-2">`);
      _push(ssrRenderComponent(unref(Link), { href: "/" }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`Home`);
          } else {
            return [
              createTextVNode("Home")
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`<div class="flex items-center gap-2">`);
      _push(ssrRenderComponent(_sfc_main$1, null, null, _parent));
      _push(`<button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-slate-900 dark:text-white hover:opacity-60" aria-controls="mobile-menu" aria-expanded="false"><span class="absolute -inset-0.5"></span><span class="sr-only">Open main menu</span><svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path></svg><svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg></button></div></div><div style="${ssrRenderStyle([
        breadIsOpen.value ? null : { display: "none" },
        { "display": "none" }
      ])}" x-transition class="" id="mobile-menu"><div class="fixed space-y-1 px-2 pb-3 pt-2 shadow rounded bg-lime-100 dark:bg-zinc-800 dark:text-white mt-0 max-w-xl w-full z-[100]">`);
      _push(ssrRenderComponent(unref(Link), {
        href: _ctx.route("packages.php"),
        class: "block px-3 py-2 text-sm font-medium hover:text-rose-500 {{ isActive('packages.php') }}"
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(` PHP Packages `);
          } else {
            return [
              createTextVNode(" PHP Packages ")
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(ssrRenderComponent(unref(Link), {
        href: _ctx.route("packages.go"),
        class: "block px-3 py-2 text-sm font-medium hover:text-rose-500 {{ isActive('packages.go') }}"
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(` Go Packages `);
          } else {
            return [
              createTextVNode(" Go Packages ")
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(ssrRenderComponent(unref(Link), {
        href: _ctx.route("devtools"),
        class: "block px-3 py-2 text-sm font-medium hover:text-rose-500 {{ isActive('devtools') }}"
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(` Tools `);
          } else {
            return [
              createTextVNode(" Tools ")
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(ssrRenderComponent(unref(Link), {
        href: _ctx.route("components"),
        class: "block px-3 py-2 text-sm font-medium hover:text-rose-500 {{ isActive('components') }}"
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(` Components `);
          } else {
            return [
              createTextVNode(" Components ")
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`<a href="https://nuxt-blog-gamma.vercel.app/" class="block px-3 py-2 text-sm font-medium hover:text-rose-500" target="_blank"> Nuxt SSR </a><a href="https://vue-blog-gules.vercel.app/" class="block px-3 py-2 text-sm font-medium hover:text-rose-500" target="_blank"> Vue SPA </a></div></div></div></nav>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Nav.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
