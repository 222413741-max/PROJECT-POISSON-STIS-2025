import "./bootstrap";

import Alpine from "alpinejs";
import focus from "@alpinejs/focus";

import React from "react";
import { createInertiaApp } from "@inertiajs/react";
import { createRoot } from "react-dom/client";

import "./i18n";

window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

createInertiaApp({
  resolve: (name) => require(`./Pages/${name}`),
  setup({ el, App, props }) {
    createRoot(el).render(<App {...props} />);
  },
});
