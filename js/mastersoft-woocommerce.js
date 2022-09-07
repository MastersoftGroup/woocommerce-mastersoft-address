/*@preserve mastersoft/woocommerce-mastersoft-address*/
jQuery(document).ready(function($){function init(){configs=function(){var result={username:void 0,password:void 0,url:"https://hosted.mastersoftgroup.com",AU:{locale:Harmony.AUSTRALIA,sot:Harmony.GNAF,featureOptions:{singleLineHitNumber:5,caseType:"TITLE"}},NZ:{locale:Harmony.NEW_ZEALAND,sot:Harmony.NZAD,featureOptions:{singleLineHitNumber:5,caseType:"TITLE",exposeAttributes:"1"}}},key=php_vars.licenceKey,url=php_vars.url,optionsLayout=php_vars.widgetLayout,options=php_vars.widgetOptions,optionsAu=php_vars.widgetOptionsAu,optionsNz=php_vars.widgetOptionsNz,hasUsernamePassword=!1;if("undefined"!=typeof key&&key&&key.indexOf(":")>0){var i=key.indexOf(":"),username=key.substring(0,i),password=key.substring(i+1,key.length);if(username&&password){if(hasUsernamePassword=!0,result.username=username,result.password=password,"undefined"!=typeof url&&url&&(result.url=url),"undefined"!=typeof optionsLayout&&optionsLayout){var layoutObj=eval("(["+optionsLayout+"])")[0];result.layout=layoutObj}var obj,value;"undefined"!=typeof options&&options&&(obj=eval("(["+options+"])")[0],Object.keys(obj).forEach(function(e){value=obj[e],"sot"!==e&&(result.AU.featureOptions[e]=value,result.NZ.featureOptions[e]=value)})),"undefined"!=typeof optionsAu&&optionsAu&&(obj=eval("(["+optionsAu+"])")[0],Object.keys(obj).forEach(function(e){value=obj[e],"sot"===e?result.AU.sot=value:result.AU.featureOptions[e]=value})),"undefined"!=typeof optionsNz&&optionsNz&&(obj=eval("(["+optionsNz+"])")[0],Object.keys(obj).forEach(function(e){value=obj[e],"sot"===e?result.NZ.sot=value:result.NZ.featureOptions[e]=value}))}}return console.info("Licence key is in "+(hasUsernamePassword?"VALID":"INVALID")+" format, URL: "+url+", Options: "+options+", AU Options: "+optionsAu+", NZ Options: "+optionsNz),result}(),nzRegions=php_vars.nzRegionsValKey,$("#"+BILLING_PREFIX+"country").data("val",$("#"+BILLING_PREFIX+"country").val()),$("#"+SHIPPING_PREFIX+"country").data("val",$("#"+SHIPPING_PREFIX+"country").val())}function executeTasksForOnChangeCountry(e){var o=$("#"+e+"country").val(),t=$("#"+e+"country").data("val");"undefined"!=typeof t&&t&&o!==t&&(clearAddressFields(e),clearField(e,"company"),main(o,e))}function main(e,o){function t(e,o,t,n,a,s,i,r){function l(e){var o="";if(e.attributes&&e.attributes.regional_council_name){var t=e.attributes.regional_council_name.toUpperCase();t.endsWith(" REGION")&&(t=t.substring(0,t.length-7)),o=nzRegions[t.replace(/[^A-Za-z0-9]/g,"")]}return o}if(!document.querySelector("#"+r+"address_1"))return void console.error("address_1 field not found");if(!document.querySelector("#"+r+"country"))return void console.error("country field not found");Harmony.useEnv(e),Harmony.useProtocol(Harmony.CORS),Harmony.init(o,t,a),Harmony.useFeatureOptions(i);var d=HarmonyJS.addressLookup(c(r,_layoutOptions),document.querySelector("#"+r+"country"),s,{minLength:3,getIntlGeocode:!1,onRetrieve:function(e){var o=e.onRetrieveItem,t=[o.streetNumber,o.street].filter(Boolean).join(" "),n=[o.buildingName,o.subdwelling,t,o.postal].filter(Boolean).join(", ");$("#"+r+"address_1").val(n);var s=a==Harmony.AUSTRALIA?o.locality:[o.suburb,o.townCity].filter(Boolean).join(", ");$("#"+r+"city").val(s).change();var i=a==Harmony.AUSTRALIA?o.state.toUpperCase():l(o);$("#"+r+"state").val(i).change(),$("#"+r+"postcode").val(o.postcode)}});_autocompleteInstances[r]=d.autocomplete}function n(o,t){if(null==document.querySelector("#"+o+"address_lookup")){var n='<p class="form-row address-field validate-required form-row-wide woocommerce-validated" id="'+o+'address_lookup_field" data-priority="50"><label for="'+o+'address_lookup" class="">Address lookup&nbsp;<abbr class="required" title="required">*</abbr></label><span class="woocommerce-input-wrapper"><input type="text" class="input-text " name="'+o+'address_lookup" id="'+o+'address_lookup" placeholder="Type an address to start searching..." data-placeholder=""></span></p>';$("#"+o+"country_field").after($(n));var s=document.querySelector("#"+o+"address_lookup");$(s).val(a(o)),s.addEventListener("input",function(e){clearAddressFields(o)});var i=o+"show_address_fields_link";if(null==document.querySelector("#"+i)){var r=document.createElement("a");r.id=i,r.href="#",r.text="Can't find your address? Enter manually.",r.onclick=function(n){n.preventDefault(),t[o].disableOptimisation=!0,clearAddressFields(o);var a=document.querySelector("#"+o+"address_lookup_field");a&&a.parentNode.removeChild(a),main(e,o)},s.insertAdjacentElement("afterend",r)}}}function a(e){return[$("#"+e+"address_1").val(),$("#"+e+"address_2").val(),[$("#"+e+"city").val(),$("#"+e+"state").val(),$("#"+e+"postcode").val()].filter(Boolean).join(" ")].filter(Boolean).join(", ")}function s(e){var o=e+"add_businessname",t=document.querySelector("#"+o);if(!t){var n=document.createElement("p");n.classList.add("form-row"),n.classList.add("address-field"),n.classList.add("form-row-wide"),n.id=e+"add_businessname_field",t=document.createElement("a"),t.id=o,t.href="#",t.onclick=function(o){o.preventDefault(),l(e,"company_field")?u(e,"company_field"):(clearField(e,"company"),d(e,"company_field")),t.text=l(e,"company_field")?"Add business name":"Remove business name"},n.appendChild(t),document.querySelector("#"+e+"last_name_field").insertAdjacentElement("afterend",n)}t.text=l(e,"company_field")?"Add business name":"Remove business name"}function i(e){var o=document.querySelector("#"+e+"address_lookup_field");o&&o.parentNode.removeChild(o);var t=document.querySelector("#"+e+"add_businessname_field");t&&t.parentNode.removeChild(t)}function r(e,o,t){t&&o[e]&&"OPTIMISED"===o[e].layout&&!o[e].disableOptimisation?(""==$("#"+e+"company").val()&&d(e,"company_field"),setTimeout(function(){d(e,"address_1_field"),d(e,"address_2_field"),d(e,"city_field"),d(e,"state_field"),d(e,"postcode_field")},0),n(e,o),s(e)):(u(e,"company_field"),u(e,"address_1_field"),u(e,"address_2_field"),u(e,"city_field"),u(e,"state_field"),u(e,"postcode_field"),i(e))}function l(e,o){return"none"==document.querySelector("#"+e+o).style.display}function d(e,o){document.querySelector("#"+e+o).style.display="none"}function u(e,o){document.querySelector("#"+e+o).style.display=""}function c(e,o){return"OPTIMISED"!==o[e].layout||o[e].disableOptimisation?document.querySelector("#"+e+"address_1"):document.querySelector("#"+e+"address_lookup")}_autocompleteInstances[o]&&(_autocompleteInstances[o].destroy(),_autocompleteInstances[o]=null);var p,f,y;e&&"undefined"!=typeof configs[e]&&configs[e]&&(p=configs[e].locale,f=configs[e].sot,y=configs[e].featureOptions);var m=configs.username,_=configs.password,v=configs.url;_layoutOptions[o]||(_layoutOptions[o]={disableOptimisation:!1},Object.assign(_layoutOptions[o],configs.layout));var I=Boolean("undefined"!=typeof m&&m&&"undefined"!=typeof _&&_&&"undefined"!=typeof p&&p&&"undefined"!=typeof f&&f);r(o,_layoutOptions,I),I&&!_layoutOptions[o].disableOptimisation&&t(v,m,_,_layoutOptions,p,f,y,o)}function clearAddressFields(e){clearField(e,"address_1"),clearField(e,"address_2"),clearField(e,"city"),clearField(e,"state"),clearField(e,"postcode")}function clearField(e,o){$("#"+e+o).val("").change()}console.info("Mastersoft Address Autocomplete is ready."),console.info("Using jquery "+$.fn.jquery);var configs,nzRegions,BILLING_PREFIX="billing_",SHIPPING_PREFIX="shipping_",_autocompleteInstances={},_layoutOptions={};init(),$("#"+BILLING_PREFIX+"country").length&&main($("#"+BILLING_PREFIX+"country").val(),BILLING_PREFIX),$("#"+SHIPPING_PREFIX+"country").length&&main($("#"+SHIPPING_PREFIX+"country").val(),SHIPPING_PREFIX),$("#billing_country").change(function(){executeTasksForOnChangeCountry(BILLING_PREFIX),$(this).data("val",$(this).val())}),$("#shipping_country").change(function(){executeTasksForOnChangeCountry(SHIPPING_PREFIX),$(this).data("val",$(this).val())})});