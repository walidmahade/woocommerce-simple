!function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=24)}({1:function(e,t){!function(){e.exports=this.wp.i18n}()},24:function(e,t,n){"use strict";n.r(t);var r=n(6),o=n(1),c=n(5),i=n(7),u=Object(c.getSetting)("paypal_data",{}),a=function(){return React.createElement("div",null,Object(i.decodeEntities)(u.description||""))},l={name:"paypal",label:React.createElement("img",{src:"".concat(c.WC_ASSET_URL,"/images/paypal.png"),alt:Object(i.decodeEntities)(u.title||Object(o.__)("PayPal",'woocommerce'))}),placeOrderButtonLabel:Object(o.__)("Proceed to PayPal",'woocommerce'),content:React.createElement(a,null),edit:React.createElement(a,null),icons:null,canMakePayment:function(){return!0},ariaLabel:Object(i.decodeEntities)(u.title||Object(o.__)("Payment via PayPal",'woocommerce'))};Object(r.registerPaymentMethod)((function(e){return new e(l)}))},5:function(e,t){!function(){e.exports=this.wc.wcSettings}()},6:function(e,t){!function(){e.exports=this.wc.wcBlocksRegistry}()},7:function(e,t){!function(){e.exports=this.wp.htmlEntities}()}});
