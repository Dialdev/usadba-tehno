{"version":3,"sources":["core.js"],"names":["BX","namespace","Report","VC","Core","entryUrl","moduleName","currentRunningAjaxRequests","abortAllRunningRequests","i","this","length","abort","ajaxGet","action","config","module","undefined","ajax","runAction","data","urlParams","onrequeststart","xhr","push","type","isFunction","bind","then","result","_successHandler","catch","response","errors","console","error","map","er","message","join","ajaxPost","analyticsLabel","ajaxSubmit","form","prepareForm","getAttribute","onsuccess","assets","onFullSuccess","loadAssets","isArray","html","Promise","resolve","load","loadJsStings","strings","callback","getPopup","uniquePopupId","bindElement","params","PopupWindow","closeIcon","right","top","titleBar","title","width","height","zIndex","offsetLeft","offsetTop","draggable","restrict","overlay","backgroundColor","opacity","events","buttons","content","getClass","fullClassName","isNotEmptyString","classFn","currentNamespace","window","namespaces","split","getFunction","functionName","currentObject","nameParts","PopupWindowManager","getPopups","_popups","adjustPopupsPositions","popups","adjustPosition","closeAllPopups","close","SetFontSize","options","items","node","init","prototype","show","adjustFontSize","getFontSize","fontNode","getComputedStyle","fontSize","slice","appendNode","parentNode","offsetWidth","a","style"],"mappings":"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","file":"core.map.js"}