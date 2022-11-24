{"version":3,"sources":["socialvideo.bundle.js"],"names":["exports","ui_vue_directives_lazyload","main_polyfill_intersectionobserver","ui_vue","_State","Object","freeze","play","pause","stop","none","Vue","component","props","id","default","src","preview","autoplay","containerClass","containerStyle","elementStyle","showControls","data","preload","previewLoaded","loaded","loading","playAfterLoad","enterFullscreen","playBeforeMute","state","progress","timeCurrent","timeTotal","muteFlag","created","this","registeredId","registerPlayer","$root","$on","onPlay","event","onStop","onPause","mounted","getObserver","observe","$refs","body","beforeDestroy","unregisterPlayer","$off","unobserve","watch","value","methods","loadFile","arguments","length","undefined","clickToButton","stopPropagation","clickToMute","mute","unmute","click","autoPlayDisabled","isMobile","source","webkitEnterFullscreen","requestFullscreen","$emit","muted","setProgress","percent","formatTime","second","Math","floor","hour","minute","toString","padStart","$uiSocialVideoId","babelHelpers","toConsumableArray","Set","concat","sort","a","b","_this","filter","start","initiator","videoEventRouter","eventName","duration","console","error","currentTime","round","_this2","observer","IntersectionObserver","entries","forEach","entry","isIntersecting","threshold","lazyLoadCallback","element","computed","State","showStartButton","showInterface","labelTime","time","UA","navigator","userAgent","toLowerCase","includes","template","window","BX"],"mappings":"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","file":"socialvideo.bundle.map.js"}