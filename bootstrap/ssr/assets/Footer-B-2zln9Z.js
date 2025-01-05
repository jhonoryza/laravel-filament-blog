import { unref, useSSRContext } from "vue";
import { ssrRenderAttrs, ssrInterpolate } from "vue/server-renderer";
const _sfc_main = {
  __name: "Footer",
  __ssrInlineRender: true,
  setup(__props) {
    const weekday = [
      "Sunday",
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday"
    ];
    const now = /* @__PURE__ */ new Date();
    const today = weekday[now.getDay()];
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<footer${ssrRenderAttrs(_attrs)}><div class="flex flex-col sm:flex-row justify-between items-center text-secondary text-sm p-4"><div class="self-start"> © Copyright 2015 Fajar SP<br>Code snippets are <a href="https://opensource.org/licenses/MIT" class="hover:text-link hover:underline" target="_blank"> MIT licensed </a><br></div><div class="self-end"><i> Enjoy the rest of your <span>${ssrInterpolate(unref(today))}</span>! </i></div></div></footer>`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Footer.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
export {
  _sfc_main as default
};
