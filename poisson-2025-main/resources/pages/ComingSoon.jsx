import React from "react";
import { ContextProvider } from "./helpers/Context";
import AnimationRevealPage from "./helpers/AnimationRevealPage";

import HeroComing from "./components/HeroComing";

export default () => {
    return (
        <ContextProvider>
            <AnimationRevealPage>
                <HeroComing />
            </AnimationRevealPage>
        </ContextProvider>
    );
};




