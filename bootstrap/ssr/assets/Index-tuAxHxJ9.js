import { ref, onMounted, unref, withCtx, openBlock, createBlock, Fragment, createTextVNode, createVNode, withModifiers, withDirectives, withKeys, vModelText, vShow, renderList, toDisplayString, useSSRContext } from "vue";
import { ssrRenderComponent, ssrRenderAttr, ssrRenderList, ssrInterpolate, ssrRenderStyle } from "vue/server-renderer";
import { useForm, Head, WhenVisible, router } from "@inertiajs/vue3";
import _sfc_main$1 from "./Base-9J_gqh7U.js";
import { IconXboxX } from "@tabler/icons-vue";
import "./Nav-BS4sGgs1.js";
import "./ToggleDarkMode-JFaivfUX.js";
import "./Footer-B-2zln9Z.js";
const _export_sfc = (sfc, props) => {
  const target = sfc.__vccOpts || sfc;
  for (const [key, val] of props) {
    target[key] = val;
  }
  return target;
};
const _sfc_main = {
  __name: "Index",
  __ssrInlineRender: true,
  props: {
    posts: Array,
    page: Number,
    next_url: String
  },
  setup(__props) {
    const showFloatingButton = ref(false);
    onMounted(() => {
      window.addEventListener(
        "scroll",
        () => showFloatingButton.value = window.scrollY > 300
      );
      setTimeout(() => {
        const scrollPosition = sessionStorage.getItem("scrollPosition") || 0;
        window.scrollTo(0, scrollPosition);
      }, 100);
    });
    function scrollTop() {
      window.scrollTo({ top: 0, behavior: "smooth" });
    }
    const props = __props;
    const form = useForm({
      search: "",
      page: props.page
    });
    function searching() {
      form.page = 1;
      form.get(route("home"), {
        preserveState: true
      });
    }
    function clearSearch() {
      form.search = "";
      form.page = 1;
      searching();
    }
    function goToDetail(slug) {
      sessionStorage.setItem("scrollPosition", window.scrollY);
      router.get(route("posts.show", { post: slug }));
    }
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<!--[-->`);
      _push(ssrRenderComponent(unref(Head), { title: "Homepage" }, null, _parent));
      _push(ssrRenderComponent(_sfc_main$1, null, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<div data-v-dffc6031${_scopeId}><div class="flex flex-col gap-4 mx-4" data-v-dffc6031${_scopeId}><form class="flex items-center relative" data-v-dffc6031${_scopeId}><input type="text"${ssrRenderAttr("value", unref(form).search)} placeholder="search here" autocomplete="off" class="form-input rounded px-1 py-1 text-sm text-slate-500 w-full focus:ring-1 focus:ring-indigo-500 dark:bg-zinc-800 dark:text-white border border-slate-500" data-v-dffc6031${_scopeId}>`);
            _push2(ssrRenderComponent(unref(IconXboxX), {
              style: unref(form).search ? null : { display: "none" },
              class: "absolute right-1 size-5 text-slate-800 hover:opacity-60 hover:cursor-pointer",
              onClick: clearSearch
            }, null, _parent2, _scopeId));
            _push2(`</form><!--[-->`);
            ssrRenderList(__props.posts, (post, index) => {
              _push2(`<div class="hover:opacity-60 flex flex-col border border-slate-100 shadow-xl rounded-xl hover:cursor-pointer overflow-hidden pb-2 bg-white dark:bg-zinc-800 dark:text-white" data-v-dffc6031${_scopeId}><div class="w-full mx-auto flex justify-center mt-2" data-v-dffc6031${_scopeId}><img class="object-contain rounded-xl h-32 w-32 bg-transparent"${ssrRenderAttr("src", post.thumbnail)}${ssrRenderAttr("alt", post.title)} data-v-dffc6031${_scopeId}></div><div class="flex flex-col justify-between px-4 gap-4" data-v-dffc6031${_scopeId}><h5 class="mt-2 text-2xl font-bold tracking-tight text-slate-900 dark:text-white" data-v-dffc6031${_scopeId}>${ssrInterpolate(post.title)}</h5><p style="${ssrRenderStyle(post.summary !== "" ? null : { display: "none" })}" class="text-base text-slate-700 dark:text-white" data-v-dffc6031${_scopeId}>${ssrInterpolate(post.summary)}</p><div class="flex flex-wrap gap-4" data-v-dffc6031${_scopeId}><!--[-->`);
              ssrRenderList(post.categories, (catName) => {
                _push2(`<span class="border border-indigo-200 rounded-lg shadow-xl text-sm text-slate-700 dark:text-white font-medium py-1 px-2" data-v-dffc6031${_scopeId}>${ssrInterpolate(catName)}</span>`);
              });
              _push2(`<!--]--></div><div class="flex justify-between" data-v-dffc6031${_scopeId}><p class="text-sm text-slate-900 dark:text-white" data-v-dffc6031${_scopeId}> [${ssrInterpolate(index + 1)}] </p><p class="text-sm font-medium underline text-slate-900 dark:text-white" data-v-dffc6031${_scopeId}>${ssrInterpolate(post.publishedAt)}</p></div></div></div>`);
            });
            _push2(`<!--]-->`);
            _push2(ssrRenderComponent(unref(WhenVisible), {
              always: "",
              params: {
                data: {
                  page: __props.page + 1
                },
                only: ["posts", "page", "next_url"]
              }
            }, {
              default: withCtx((_2, _push3, _parent3, _scopeId2) => {
                if (_push3) {
                  if (__props.next_url === null) {
                    _push3(`<!--[--> You have reach the end <!--]-->`);
                  } else {
                    _push3(`<div class="loader" data-v-dffc6031${_scopeId2}></div>`);
                  }
                } else {
                  return [
                    __props.next_url === null ? (openBlock(), createBlock(Fragment, { key: 0 }, [
                      createTextVNode(" You have reach the end ")
                    ], 64)) : (openBlock(), createBlock("div", {
                      key: 1,
                      class: "loader"
                    }))
                  ];
                }
              }),
              _: 1
            }, _parent2, _scopeId));
            _push2(`<button style="${ssrRenderStyle([
              showFloatingButton.value ? null : { display: "none" },
              { "display": "none" }
            ])}" class="fixed bottom-5 right-1/4 bg-indigo-100 rounded-full p-3 shadow-lg hover:opacity-60 focus:outline-none z-50" data-v-dffc6031${_scopeId}> ⬆️ </button></div></div>`);
          } else {
            return [
              createVNode("div", null, [
                createVNode("div", { class: "flex flex-col gap-4 mx-4" }, [
                  createVNode("form", {
                    onSubmit: withModifiers(searching, ["prevent"]),
                    class: "flex items-center relative"
                  }, [
                    withDirectives(createVNode("input", {
                      type: "text",
                      onKeyup: withKeys(clearSearch, ["escape"]),
                      "onUpdate:modelValue": ($event) => unref(form).search = $event,
                      placeholder: "search here",
                      autocomplete: "off",
                      class: "form-input rounded px-1 py-1 text-sm text-slate-500 w-full focus:ring-1 focus:ring-indigo-500 dark:bg-zinc-800 dark:text-white border border-slate-500"
                    }, null, 40, ["onUpdate:modelValue"]), [
                      [vModelText, unref(form).search]
                    ]),
                    withDirectives(createVNode(unref(IconXboxX), {
                      class: "absolute right-1 size-5 text-slate-800 hover:opacity-60 hover:cursor-pointer",
                      onClick: clearSearch
                    }, null, 512), [
                      [vShow, unref(form).search]
                    ])
                  ], 32),
                  (openBlock(true), createBlock(Fragment, null, renderList(__props.posts, (post, index) => {
                    return openBlock(), createBlock("div", {
                      key: post.id,
                      onClick: ($event) => goToDetail(post.slug),
                      class: "hover:opacity-60 flex flex-col border border-slate-100 shadow-xl rounded-xl hover:cursor-pointer overflow-hidden pb-2 bg-white dark:bg-zinc-800 dark:text-white"
                    }, [
                      createVNode("div", { class: "w-full mx-auto flex justify-center mt-2" }, [
                        createVNode("img", {
                          class: "object-contain rounded-xl h-32 w-32 bg-transparent",
                          src: post.thumbnail,
                          alt: post.title
                        }, null, 8, ["src", "alt"])
                      ]),
                      createVNode("div", { class: "flex flex-col justify-between px-4 gap-4" }, [
                        createVNode("h5", { class: "mt-2 text-2xl font-bold tracking-tight text-slate-900 dark:text-white" }, toDisplayString(post.title), 1),
                        withDirectives(createVNode("p", { class: "text-base text-slate-700 dark:text-white" }, toDisplayString(post.summary), 513), [
                          [vShow, post.summary !== ""]
                        ]),
                        createVNode("div", { class: "flex flex-wrap gap-4" }, [
                          (openBlock(true), createBlock(Fragment, null, renderList(post.categories, (catName) => {
                            return openBlock(), createBlock("span", { class: "border border-indigo-200 rounded-lg shadow-xl text-sm text-slate-700 dark:text-white font-medium py-1 px-2" }, toDisplayString(catName), 1);
                          }), 256))
                        ]),
                        createVNode("div", { class: "flex justify-between" }, [
                          createVNode("p", { class: "text-sm text-slate-900 dark:text-white" }, " [" + toDisplayString(index + 1) + "] ", 1),
                          createVNode("p", { class: "text-sm font-medium underline text-slate-900 dark:text-white" }, toDisplayString(post.publishedAt), 1)
                        ])
                      ])
                    ], 8, ["onClick"]);
                  }), 128)),
                  createVNode(unref(WhenVisible), {
                    always: "",
                    params: {
                      data: {
                        page: __props.page + 1
                      },
                      only: ["posts", "page", "next_url"]
                    }
                  }, {
                    default: withCtx(() => [
                      __props.next_url === null ? (openBlock(), createBlock(Fragment, { key: 0 }, [
                        createTextVNode(" You have reach the end ")
                      ], 64)) : (openBlock(), createBlock("div", {
                        key: 1,
                        class: "loader"
                      }))
                    ]),
                    _: 1
                  }, 8, ["params"]),
                  withDirectives(createVNode("button", {
                    onClick: scrollTop,
                    class: "fixed bottom-5 right-1/4 bg-indigo-100 rounded-full p-3 shadow-lg hover:opacity-60 focus:outline-none z-50",
                    style: { "display": "none" }
                  }, " ⬆️ ", 512), [
                    [vShow, showFloatingButton.value]
                  ])
                ])
              ])
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`<!--]-->`);
    };
  }
};
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Post/Index.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const Index = /* @__PURE__ */ _export_sfc(_sfc_main, [["__scopeId", "data-v-dffc6031"]]);
export {
  Index as default
};
