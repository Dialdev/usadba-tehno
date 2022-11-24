{"version":3,"sources":["text.js"],"names":["BX","namespace","escapeText","Landing","Utils","headerTagMatcher","Matchers","headerTag","changeTagName","textToPlaceholders","Block","Node","Text","options","apply","this","arguments","type","onClick","bind","onPaste","onDrop","onInput","onMousedown","onMouseup","node","addEventListener","document","currentNode","prototype","__proto__","superClass","constructor","onAllowInlineEdit","setAttribute","Loc","getMessage","onChange","preventAdjustPosition","preventHistory","call","UI","Panel","EditorPanel","getInstance","adjustPosition","History","push","Entry","block","getBlock","id","selector","command","undo","lastValue","redo","getValue","event","clearTimeout","inputTimeout","key","keyCode","which","top","window","navigator","userAgent","match","ctrlKey","metaKey","setTimeout","onEscapePress","isEditable","hide","disableEdit","preventDefault","clipboardData","getData","sourceText","encodedText","encode","formattedHtml","replace","RegExp","execCommand","text","onDocumentClick","fromNode","manifest","group","allowInlineEdit","Main","isControlsEnabled","stopPropagation","enableEdit","Tool","ColorPicker","hideAll","Button","FontAction","requestAnimationFrame","target","nodeName","parentElement","range","createRange","selectNode","getSelection","removeAllRanges","addRange","isContentEditable","StylePanel","isShown","buttons","getDesignButton","isHeader","getChangeTagButton","changeHandler","onChangeTag","textOnly","show","contentEditable","designButton","Design","html","attrs","title","onDesignShow","code","isAllowInlineEdit","getField","field","Field","name","content","innerHTML","changeTagButton","setValue","value","preventSave","isSavePrevented","test","ChangeTag","toLowerCase","insertAfter","activateItem","data","changeOptionsHandler"],"mappings":"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","file":"text.map.js"}