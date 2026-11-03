import { Suspense } from "react";
import { createInertiaApp } from "@inertiajs/react";
import { createRoot } from "react-dom/client";
import "../pages/i18n";
import "../pages/css/styles.css";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("../pages/**/*.jsx", { eager: true });
        return pages[`../pages/${name}.jsx`];
    },
    setup({ el, App, props }) {
        createRoot(el).render(
            <Suspense fallback={<div>Loading...</div>}>
                <App {...props} />
            </Suspense>
        );
    },
});
