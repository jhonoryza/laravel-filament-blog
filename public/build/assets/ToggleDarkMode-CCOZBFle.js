import{y as n,r as p,o as M,c as _,m as u,u as m,b as r}from"./vue-DjRCHpJJ.js";/**
 * @license @tabler/icons-vue v3.26.0 - MIT
 *
 * This source code is licensed under the MIT license.
 * See the LICENSE file in the root directory of this source tree.
 */var h={outline:{xmlns:"http://www.w3.org/2000/svg",width:24,height:24,viewBox:"0 0 24 24",fill:"none",stroke:"currentColor","stroke-width":2,"stroke-linecap":"round","stroke-linejoin":"round"},filled:{xmlns:"http://www.w3.org/2000/svg",width:24,height:24,viewBox:"0 0 24 24",fill:"currentColor",stroke:"none"}};/**
 * @license @tabler/icons-vue v3.26.0 - MIT
 *
 * This source code is licensed under the MIT license.
 * See the LICENSE file in the root directory of this source tree.
 */const g=(t,e,s,o)=>({color:l="currentColor",size:c=24,stroke:k=2,title:i,class:I,...f},{attrs:v,slots:d})=>{let a=[...o.map(w=>n(...w)),...d.default?[d.default()]:[]];return i&&(a=[n("title",i),...a]),n("svg",{...h[t],width:c,height:c,...v,class:["tabler-icon",`tabler-icon-${e}`],...t==="filled"?{fill:l}:{"stroke-width":k??h[t]["stroke-width"],stroke:l},...f},a)};/**
 * @license @tabler/icons-vue v3.26.0 - MIT
 *
 * This source code is licensed under the MIT license.
 * See the LICENSE file in the root directory of this source tree.
 */var b=g("outline","moon","IconMoon",[["path",{d:"M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z",key:"svg-0"}]]);/**
 * @license @tabler/icons-vue v3.26.0 - MIT
 *
 * This source code is licensed under the MIT license.
 * See the LICENSE file in the root directory of this source tree.
 */var x=g("outline","sun","IconSun",[["path",{d:"M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0",key:"svg-0"}],["path",{d:"M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7",key:"svg-1"}]]);const y={__name:"ToggleDarkMode",setup(t){const e=p(localStorage.getItem("color-mode")||void 0);M(()=>{e.value===void 0&&(e.value=window.matchMedia&&window.matchMedia("(prefers-color-scheme: dark)").matches?"dark":"light",localStorage.setItem("color-mode",e.value));const o=document.documentElement;e.value==="light"?o.classList.remove("dark"):o.classList.add("dark")});const s=()=>{e.value=e.value==="light"?"dark":"light",localStorage.setItem("color-mode",e.value);const o=document.documentElement;e.value==="light"?o.classList.remove("dark"):o.classList.add("dark")};return(o,l)=>(r(),_("button",{class:"inline-flex items-center p-2 focus:outline-none rounded-md",onClick:s},[e.value==="light"?(r(),u(m(x),{key:0,class:"size-6 text-primary-400 font-normal"})):(r(),u(m(b),{key:1,class:"size-5 stroke-white"}))]))}},C=Object.freeze(Object.defineProperty({__proto__:null,default:y},Symbol.toStringTag,{value:"Module"}));export{C as T,y as _,g as c};
