{"version":3,"sources":["agreementslist.bundle.js"],"names":["this","BX","Landing","UI","exports","main_core","main_popup","landing_ui_field_basefield","ui_draganddrop_draggable","landing_ui_field_radiobuttonfield","landing_ui_form_formsettingsform","crm_form_client","landing_ui_component_listitem","landing_ui_component_actionpanel","main_core_events","main_loader","landing_backend","_templateObject4","data","babelHelpers","taggedTemplateLiteral","_templateObject3","_templateObject2","_templateObject","AgreementsList","_BaseField","inherits","options","_this","classCallCheck","possibleConstructorReturn","getPrototypeOf","call","setEventNamespace","onSelectAgreementClick","bind","assertThisInitialized","onCreateAgreementClick","onUserConsentEditSave","onUserConsentEditCancel","onItemRemoveClick","onDragEnd","items","Dom","replace","input","getListContainer","append","getActionsContainer","layout","showAgreementLoader","FormClient","getInstance","prepareOptions","formOptions","value","then","result","agreements","map","item","index","Runtime","merge","hideAgreementLoader","setTimeout","forEach","agreement","addItem","draggable","Draggable","context","window","parent","container","dragElement","type","MOVE","offset","y","subscribe","addCustomEvent","Reflection","getClass","top","createClass","key","getAgreementsList","_this2","cache","remember","agreementsList","setAgreementsList","set","loadAgreementsList","Backend","action","orderBy","getAgreementById","id","find","String","itemOptions","createItem","appendTo","filter","currentItem","push","Tag","render","_this3","getSelectAgreementButton","getCreateAgreementButton","_this4","Loc","getMessage","_this5","getSelectedAgreements","toConsumableArray","children","attr","getAgreementsMenu","_this6","menu","Menu","bindElement","autoHide","maxWidth","maxHeight","events","onPopupShow","style","getMenuContainer","left","right","some","addMenuItem","text","name","onclick","onAgreementsMenuItemClick","refreshAgreementsMenu","agreementsMenu","close","destroy","delete","createItemForm","_this7","FormSettingsForm","title","onChange","emit","skipPrepare","serializeModifier","checked","required","fields","RadioButtonField","selector","icon","ActionPanel","onClick","editAgreement","openConsentsList","getAgreementLoader","Loader","size","mode","loader","show","hide","_this8","event","preventDefault","getPopupWindow","isShown","onItemHeaderClick","parentElement","currentTarget","toggleClass","agreementListItem","ListItem","description","labelText","sourceOptions","editable","removable","form","onRemove","setCurrentlyEdited","getCurrentlyEdited","get","buildEditPath","agreementId","concat","buildConsentsListPath","editPath","SidePanel","Instance","open","cacheable","allowChangeHistory","closeEditAgreementSlider","currentlyEdited","Type","isPlainObject","path","slider","getSlider","_this9","getValue","lastAgreement","pop","clean","resultAgreement","currentAgreement","objectSpread","getTarget","_this10","element","BaseField","Field","Main","DragAndDrop","Form","Crm","Component","Event"],"mappings":"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","file":"agreementslist.bundle.map.js"}