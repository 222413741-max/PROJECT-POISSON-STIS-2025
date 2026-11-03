import i18n from "i18next";
import I18NextHttpBackend from "i18next-http-backend";
import { initReactI18next } from "react-i18next";

import Cookies from "js-cookie";

i18n.use(I18NextHttpBackend)
    .use(initReactI18next)
    .init({
        supportedLngs: ["en", "id"],
        lng: Cookies.get("lang") || "en",
        fallbackLng: "en",
        interpolation: {
            escapeValue: false,
        },
        backend: {
            loadPath: '/api/translations/{{lng}}' 
        },
    });

export default i18n;
