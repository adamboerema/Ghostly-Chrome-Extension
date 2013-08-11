chrome.tabs.onUpdated.addListener(function(tab) {
	chrome.tabs.executeScript(null, {file:"js/load.js"});
});

chrome.browserAction.onClicked.addListener(function(tab){
	chrome.tabs.executeScript(null, {file:"js/activate.js"});
});
