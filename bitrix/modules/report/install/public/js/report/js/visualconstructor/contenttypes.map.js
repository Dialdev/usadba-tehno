{"version":3,"sources":["contenttypes.js"],"names":["BX","namespace","decodeHtmlEntities","str","p","document","createElement","innerHTML","innerText","Report","VisualConstructor","Widget","Content","AmChart","options","Dashboard","apply","this","arguments","chartWrapper","create","style","height","getHeight","paddingTop","addCustomEvent","widget","data","isFilled","AmCharts","isReady","ready","makeChart","bind","prototype","__proto__","constructor","clickHandler","render","jsDD","unregisterObject","getWidget","getWidgetContainer","makeDraggable","getHeadContainer","monthNames","shortMonthNames","m","push","message","toString","chart","prepareDataForAmChart","dataProvider","length","addListener","invalidateSize","func","type","isArray","forEach","graph","VC","Core","getFunction","Type","isFunction","Error","handleItemClick","event","valueField","item","urlField","dashPosition","search","graphNum","substr","dataContext","hasOwnProperty","url","isNotEmptyString","SidePanel","Instance","open","cacheable","window","PieDiagram","chartDiv","call","opacity","setTimeout","transition","Funnel","paddingLeft","AmCharts4","currentColumnWidth","am4core","useTheme","am4themes_animated","createFromConfig","onAfterChartCreate","invalidateLayout","xAxes","axis","renderer","labels","template","ellipsis","series","columns","adapter","tooltipHTML","events","hit","target","valueUrl","Activity","cell","getCell","handlerClearCell","PopupWindowManager","closeAllPopups","graphContainer","ActivityTileWidget","renderTo","labelY","config","labelX","items","NumberBlock","Html","setColor","applyColor","backgroundColor","getColor","getWidgetWrapper","color","substring","isWidgetDarkMode","Utils","isDarkColor","classList","remove","add","GroupedDataGrid","htmlContentWrapper","parentNode","content","clientHeight"],"mappings":"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","file":"contenttypes.map.js"}