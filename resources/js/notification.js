const notification = require("notyf");

const notyf = new notification.Notyf({ duration: 2000 });

Livewire.on("error", (message) => {
    notyf.error(message);
});

Livewire.on("success", (message) => {
    notyf.success(message);
});