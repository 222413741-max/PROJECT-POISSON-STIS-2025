import React from "react";
import styled from "styled-components";
import tw from "twin.macro";
import { Trans, useTranslation } from "react-i18next";

import { Container, ContentWithVerticalPadding } from "./misc/Layouts";
import { mainHeroBg, transisi1 } from "../config";

const BackgroundContainer = styled.div((props) => [
    `background-image: url("${props.imageSrc}");
   background-position: center;
   background-size: cover;
   background-repeat: no-repeat;`,
    tw`relative w-full h-[105vh] min-h-[105vh]`,

    // responsive
    `
        @media (max-width: 640px) {
            height: 100vh;
            min-height: 100vh;
        }
        @media (min-width: 641px) and (max-width: 1024px) {
            height: 100vh;
            min-height: 100vh;
        }
        @media (min-width: 1025px) {
            height: 105vh;
            min-height: 105vh;
        }
    `,
]);

const Layer = styled.div`
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    margin: 0 auto;

    background-image: url("/img/landing-page/landing/layerHero.svg");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: bottom center;

    width: 100%;
    height: 100%;
    z-index: 20;

    @media (max-width: 640px) {
        height: 60vh;
        background-size: cover;
    }
    @media (min-width: 641px) and (max-width: 1024px) {
        height: 75vh;
        background-size: cover;
    }
    @media (min-width: 1025px) {
        height: 105vh;
        min-height: 105vh;
    }
`;

const LayerBatu = styled.div`
    position: absolute;
    z-index: 10;
    bottom: 0;

    background-image: url(${(props) => props.bg});
    background-size: contain;
    background-repeat: no-repeat;
    background-position: bottom;

    height: 100%;
    width: 100%;
    ${(props) =>
        (!props.align || props.align === "center") &&
        `
      left: 0;
      right: 0;
      margin: 0 auto;
      background-position: bottom center;
    `}
    ${(props) =>
        props.align === "left" &&
        `
      left: 0;
      right: auto;
      background-position: bottom left;
    `}
        ${(props) =>
        props.align === "right" &&
        `
      right: 0;
      left: auto;
      background-position: bottom right;
    `}
    
    @media (max-width: 640px) {
        background-size: contain;
        ${(props) =>
            props.sm &&
            `
        transform: ${props.sm.translate || "none"};
      `}
    }

    @media (min-width: 641px) and (max-width: 1024px) {
        background-size: contain;
        ${(props) =>
            props.md &&
            `
        transform: ${props.md.translate || "none"};
      `}
    }

    @media (min-width: 1025px) {
        ${(props) =>
            props.lg &&
            `
        transform: ${props.lg.translate || "none"};
      `}
    }
`;

const Transisi = styled.div`
    ${tw`absolute bottom-0 left-0 right-0 w-full h-full pointer-events-none`}
    background-image: url("/img/landing-page/landing/transisiHero.svg");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: bottom center;
    z-index: 20;
`;

const TitleContainer = tw.div`flex flex-col items-center pt-52 sm:pt-56 lg:pt-48 justify-between`;

const Title = styled.h1`
    ${tw`text-center text-white
      text-7xl sm:text-9xl md:text-[9rem] lg:text-[12rem]
      font-bold font-playfair tracking-[-3px] md:tracking-[-5px] z-20`}
    text-shadow: 0px 4px 10px rgb(0 0 0 / 0.75);
`;

const Stack = tw.div`
  grid w-full h-12 sm:h-16 lg:h-20 place-items-center
`;

const FadeBorder = tw.div`
  col-start-1 row-start-1 w-full h-full opacity-70 
  bg-gradient-to-l from-primaryPoi25-50 to-primaryPoi25-300
  sm:opacity-80 lg:opacity-90 
`;

const SubTitle = styled.h1`
    ${tw`col-start-1 row-start-1 text-white text-xl sm:text-2xl md:text-4xl lg:text-5xl font-medium italic font-lato z-0 pointer-events-none`}text-shadow: 0px 4px 10px rgb(0 0 0 / 0.85)
`;

const Jargon = styled.h1`
    ${tw`absolute bottom-0 z-20 text-center justify-start text-white text-base sm:text-2xl md:text-3xl lg:text-5xl font-bold font-lato pt-0 mt-8 sm:mt-12 md:mt-16 lg:pt-24`}text-shadow: 0px 4px 8px rgb(0 0 0 / 0.85)
`;

const MainHero = () => {
    const { t } = useTranslation();

    return (
        <>
            <BackgroundContainer imageSrc={mainHeroBg}>
                <Layer />
                <LayerBatu
                    bg="/img/landing-page/landing/layerHeroBatuKiri.svg"
                    align="left"
                    sm={{ translate: "translateX(-50%)" }}
                    md={{ translate: "translateX(-40%)" }}
                />
                <LayerBatu
                    bg="/img/landing-page/landing/layerHeroBatuKanan.svg"
                    align="right"
                    sm={{ translate: "translateX(50%)" }}
                    md={{ translate: "translateX(40%)" }}
                />
                <Container>
                    <ContentWithVerticalPadding>
                        <TitleContainer>
                            <Title>POISSON</Title>
                            <Stack>
                                <FadeBorder />
                                <SubTitle>Statistics Competition 2025</SubTitle>
                                <Jargon>
                                    “Resilient Innovation through Synergy of
                                    Statistics”
                                </Jargon>
                            </Stack>
                        </TitleContainer>
                    </ContentWithVerticalPadding>
                </Container>
                <Transisi />
            </BackgroundContainer>
        </>
    );
};

export default MainHero;
