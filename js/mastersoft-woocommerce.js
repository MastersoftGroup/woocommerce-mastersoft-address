jQuery(document).ready(function($){function init(){configs=function(){var result={username:void 0,password:void 0,url:"https://hosted.mastersoftgroup.com",AU:{locale:Harmony.AUSTRALIA,sot:Harmony.GNAF,featureOptions:{singleLineHitNumber:5,caseType:"TITLE"}},NZ:{locale:Harmony.NEW_ZEALAND,sot:Harmony.NZAD,featureOptions:{singleLineHitNumber:5,caseType:"TITLE",exposeAttributes:"1"}}},key=php_vars.licenceKey,url=php_vars.url,options=php_vars.widgetOptions,optionsAu=php_vars.widgetOptionsAu,optionsNz=php_vars.widgetOptionsNz,hasUsernamePassword=!1;if("undefined"!=typeof key&&key&&key.indexOf(":")>0){var i=key.indexOf(":"),username=key.substring(0,i),password=key.substring(i+1,key.length);if(username&&password){hasUsernamePassword=!0,result.username=username,result.password=password,"undefined"!=typeof url&&url&&(result.url=url);var obj,value;"undefined"!=typeof options&&options&&(obj=eval("(["+options+"])")[0],Object.keys(obj).forEach(function(e){value=obj[e],"sot"!==e&&(result.AU.featureOptions[e]=value,result.NZ.featureOptions[e]=value)})),"undefined"!=typeof optionsAu&&optionsAu&&(obj=eval("(["+optionsAu+"])")[0],Object.keys(obj).forEach(function(e){value=obj[e],"sot"===e?result.AU.sot=value:result.AU.featureOptions[e]=value})),"undefined"!=typeof optionsNz&&optionsNz&&(obj=eval("(["+optionsNz+"])")[0],Object.keys(obj).forEach(function(e){value=obj[e],"sot"===e?result.NZ.sot=value:result.NZ.featureOptions[e]=value}))}}return console.info("Licence key is in "+(hasUsernamePassword?"VALID":"INVALID")+" format, URL: "+url+", Options: "+options+", AU Options: "+optionsAu+", NZ Options: "+optionsNz),result}(),nzRegions=php_vars.nzRegionsValKey,$(BILLING_PREFIX+"country").data("val",$(BILLING_PREFIX+"country").val()),$(SHIPPING_PREFIX+"country").data("val",$(SHIPPING_PREFIX+"country").val())}function executeTasksForOnChangeCountry(e){var n=$(e+"country").val(),o=$(e+"country").data("val");"undefined"!=typeof o&&o&&n!==o&&($(e+"address_1").val(""),$(e+"addres_2").val(""),$(e+"city").val(""),$(e+"state").val(""),$(e+"postcode").val(""),main(n,e))}function main(e,n){function o(e,n,o,t,s,a,i){function r(e,n){var o=[n.building,n.subdwelling,n.street,n.postal].filter(Boolean).join(", ");$(e).val(o);var s=t==Harmony.AUSTRALIA?n.locality:[n.suburb,n.townCity].filter(Boolean).join(", ");$(i+"city").val(s);var a=t==Harmony.AUSTRALIA?n.state.toUpperCase():u(n);$(i+"state").val(a).change(),$(i+"postcode").val(n.postcode)}function u(e){var n="";if(e.attributes&&e.attributes.regional_council_name){var o=e.attributes.regional_council_name.toUpperCase();o.endsWith(" REGION")&&(o=o.substring(0,o.length-7)),n=nzRegions[o.replace(/[^A-Za-z0-9]/g,"")]}return n}Harmony.useEnv(e),Harmony.init(n,o,t),Harmony.useProtocol(Harmony.JSONP),Harmony.useFeatureOptions(a),$(i+"address_1").autocomplete({minLength:3,delay:500,source:function(e,n){Harmony.address({fullAddress:e.term},s,function(e){var o=[];e.status==Harmony.SUCCESS?(o=$.map(e.payload,function(e){return{label:e.fullAddress,building:e.buildingName,subdwelling:e.subdwelling,street:[e.streetNumber,e.street].filter(Boolean).join(" "),postal:e.postal,locality:e.locality,state:e.state,suburb:e.suburb,townCity:e.townCity,postcode:e.postcode,attributes:e.attributes}}),n(o)):e.messages&&e.messages.length>0?console.info(e.messages[0]):console.info("Request is not successful. Please contact admin.")})},focus:function(e,n){e.preventDefault()},select:function(e,n){e.preventDefault(),Harmony.transaction(s),r(this,n.item)}})}var t,s,a;e&&"undefined"!=typeof configs[e]&&configs[e]&&(t=configs[e].locale,s=configs[e].sot,a=configs[e].featureOptions);var i=configs.username,r=configs.password,u=configs.url,l=Boolean("undefined"!=typeof i&&i&&"undefined"!=typeof r&&r&&"undefined"!=typeof t&&t&&"undefined"!=typeof s&&s);$(n+"address_1").autocomplete({disabled:!l}),l&&o(u,i,r,t,s,a,n)}function printout(e,n){console.log(n+"=");var o=0;$.each(e,function(e,n){if("Object"==typeof n||n instanceof Object)printout(n,e);else{o+=2;for(var t="",s=0;s<o;s++)t+=" ";console.log(t+e+": "+n),o-=2}})}console.info("Mastersoft Address Autocomplete is ready."),console.info("Using jquery "+$.fn.jquery+" and jquery-ui "+$.ui.version);var configs,auStates,nzRegions,BILLING_PREFIX="#billing_",SHIPPING_PREFIX="#shipping_";init(),$(BILLING_PREFIX+"country").length&&main($(BILLING_PREFIX+"country").val(),BILLING_PREFIX),$(SHIPPING_PREFIX+"country").length&&main($(SHIPPING_PREFIX+"country").val(),SHIPPING_PREFIX),$("#billing_country").focusin(function(){$(this).data("val",$(this).val())}).change(function(){executeTasksForOnChangeCountry(BILLING_PREFIX)}),$("#shipping_country").focusin(function(){$(this).data("val",$(this).val())}).change(function(){executeTasksForOnChangeCountry(SHIPPING_PREFIX)})});