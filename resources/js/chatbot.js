console.log("Loading BotMan Widget...");

var botmanWidget = {
    frameEndpoint: '/botman/widget',
    introMessage: "✋ Hi! I'm a chatbot",
    chatServer: '/botman',
    title: 'My Chatbot',
    mainColor: '#3490dc',
    bubbleBackground: '#3490dc',
    aboutText: 'Powered by BotMan',
    bubbleAvatarUrl: '',
    placeholderText: 'Type a message...',
    displayMessageTime: true,
    useStickyServer: true
};

document.addEventListener("DOMContentLoaded", function() {
    console.log("BotMan Widget Loaded");
    var script = document.createElement('script');
    script.src = "https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js";
    script.onload = function() {
        console.log("BotMan Widget Script Loaded");
    };
    script.onerror = function() {
        console.error("Failed to load BotMan Widget Script");
    };
    document.head.appendChild(script);
});