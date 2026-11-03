import React from "react";
import styled, { css } from "styled-components";
import tw from "twin.macro";
import { useTranslation } from "react-i18next";

import { SectionHeading } from "./misc/Headings";
import { SectionDescription } from "./misc/Typography";
import { PrimaryButton } from "./misc/Buttons";
import { Container, ContentWithVerticalPadding } from "./misc/Layouts";
import {
    subHeroBg,
    transisiSubHeroBottom,
    transisiSubHeroTop,
} from "../config";

const Column = tw.div`flex flex-col place-items-start relative z-40`;

const TextColumn = tw(
    Column
)`w-full px-10 md:p-0 md:w-1/2 mr-0 md:mr-12 lg:mr-24 xl:mr-36 z-30`;

const Heading = styled.h1`
    ${tw`text-white text-left text-2xl md:text-4xl lg:text-6xl font-bold font-playfair`}
    text-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
`;

const Description = styled(SectionDescription)`
    ${tw`mt-4 text-white/90 font-medium text-xs md:text-sm lg:text-lg max-w-2xl font-lato`}
    text-shadow: 0px 4px 0px rgba(0,0,0,0.25);
`;

const Button = tw(PrimaryButton)`mt-8 text-sm tracking-wide text-center`;

const BackgroundContainer = styled.div((props) => [
    `
    background-image: url("${props.imageSrc}");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: top center;
  `,
    tw`relative w-auto h-[75vh] min-h-[75vh]`,

    css`
        @media (max-width: 640px) {
            height: 60vh;
            min-height: 60vh;
        }
    `,

    css`
        @media (min-width: 641px) and (max-width: 1024px) {
            height: 50vh;
            min-height: 50vh;
        }
    `,
]);

const Layer = styled.div`
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    margin: 0 auto;

    background-image: url("/img/landing-page/landing/layerSubHero.svg");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: bottom center;

    width: 100%;
    height: 100%;
    z-index: 10;

    @media (max-width: 640px) {
        height: 60vh;
        min-height: 60vh;
    }
    @media (min-width: 641px) and (max-width: 1024px) {
        height: 75vh;
        min-height: 75vh;
    }
`;

const Transisi = styled.div`
    ${tw`absolute left-0 right-0 w-full z-30 pointer-events-none`}
    height: ${(props) => props.height || "200px"};
    background-size: cover;
    background-repeat: no-repeat;
    ${({ position }) => position === "top" && tw`top-0`}
    ${({ position }) => position === "bottom" && tw`bottom-0`}
  background-image: ${({ img }) => `url(${img})`};
`;

const SubHero = () => {
    const { t } = useTranslation();

    return (
        <>
            <BackgroundContainer imageSrc={subHeroBg}>
                <Transisi position="top" img={transisiSubHeroTop} />
                <Layer />
                <Container>
                    <ContentWithVerticalPadding tw="flex justify-center md:justify-end">
                        <TextColumn>
                            <Heading>
                                {t("landingpage.title")}
                                <span tw="italic">POISSON</span>?
                            </Heading>
                            <Description>{t("landingpage.intro")}</Description>
                            <Button as="a" href="/login">
                                {t("baca-selengkapnya")}
                            </Button>
                        </TextColumn>
                    </ContentWithVerticalPadding>
                </Container>
                <Transisi position="bottom" img={transisiSubHeroBottom} />
            </BackgroundContainer>
        </>
    );
};

export default SubHero;
