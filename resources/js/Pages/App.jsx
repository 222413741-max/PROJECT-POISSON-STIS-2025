import React from "react";
import { ContextProvider } from "../helpers/Context";

import Header from "../components/Header";
import MainHero from "../components/MainHero";
import Hero from "../components/Hero";
import SubHero from "../components/SubHero";
import Lomba from "../components/Lomba";
// import Olimpiade from "../components/LombaOlimpiade";
// import Infografis from "../components/LombaInfografis";
import Semnas from "../components/Semnas";
// import Berita from '../components/Berita'
import Timeline from "../components/Timeline";
// import CTA from "../components/CTA";
import FAQ from "../components/FAQ";
import Galeri from "../components/Galeri";
import Footer from "../components/Footer";
import StyledDiv from "../helpers/AnimationRevealPage";

export default () => {
    return (
        <ContextProvider>
            <StyledDiv>
                <Header />
                <MainHero />
                <SubHero />
                <Lomba />
                {/* <Olimpiade /> */}
                {/* <Infografis /> */}
                {/* < */}
                <Semnas />
                {/* <Berita /> */}
                <Timeline />
                {/* <CTA /> */}
                <FAQ />
                <Galeri />
                <Footer />
            </StyledDiv>
        </ContextProvider>
    );
};
