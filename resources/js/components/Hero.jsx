import React from "react";
import styled from "styled-components";
import tw from "twin.macro";
import { useTranslation } from "react-i18next";

import { SectionHeading } from "./misc/Headings";
import { SectionDescription } from "./misc/Typography";
import { PrimaryButton as PrimaryButtonBase } from "./misc/Buttons";
import { Container, ContentWithVerticalPadding } from "./misc/Layouts";

import SvgDecoratorRight from "./svgJSX/DecorGradientRight";
import SvgDecoratorLeft from "./svgJSX/DecorGradientLeft";

// Styled Component
const DesktopImage = tw.img`hidden lg:block max-w-full w-[500px] rounded-t sm:rounded relative z-0`;
const MobileImage = tw.img`block lg:hidden max-w-full w-[250px] rounded-t sm:rounded relative z-0 mx-auto my-4`;

const Column = tw.div``;

const Row = tw.div`flex flex-col lg:flex-row justify-between items-center lg:pt-16 max-w-screen-2xl mx-auto sm:px-8`;

const TextColumn = tw(
    Column
)`mr-auto lg:mr-0 max-w-lg lg:max-w-xl xl:max-w-2xl`;

const Heading = tw(SectionHeading)`text-left leading-snug xl:text-6xl`;

const TagLine = tw(
    SectionDescription
)`italic text-black tracking-wider mb-10 text-lg`;

const Description = tw(
    SectionDescription
)`mt-4 lg:text-base leading-loose text-black max-w-2xl z-30`;

const PrimaryButton = tw(
    PrimaryButtonBase
)`mt-8 inline-block w-[250px] tracking-wide text-center`;

const ImageColumn = tw(Column)`ml-auto lg:mr-0 relative mt-16 lg:mt-0 lg:ml-32`;

const ImageContainer = tw.div`relative`;

const StackedImage = styled.img`
    ${tw`absolute top-0 left-0 w-full h-full rounded-t sm:rounded`}
`;

const DecoratorRight = styled(SvgDecoratorRight)`
    ${tw`pointer-events-none z-10 absolute right-[1px] bottom-0 h-96 w-96 transform -translate-y-1/2 translate-x-[8rem]`}
`;

const DecoratorLeft = styled(SvgDecoratorLeft)`
    ${tw`pointer-events-none z-10 absolute left-[1px] bottom-0 h-96 w-96 transform -translate-y-1/2 translate-x-[-8rem]`}
`;

// component
const Hero = () => {
    const { t } = useTranslation();

    return (
        <>
            <Container>
                <ContentWithVerticalPadding>
                    <DecoratorLeft />
                    <Row>
                        <ImageColumn>
                            <ImageContainer>
                                <DesktopImage src="/img/landing-page/landing/decor logo.svg" />
                                <StackedImage src="/img/landing-page/landing/LOGO POISSON 2024.svg" />
                            </ImageContainer>
                        </ImageColumn>
                        <TextColumn>
                            <Heading>
                                <wbr />
                                <span tw="bg-gradient-to-r from-green-700 to-green-400 bg-clip-text text-transparent font-bold font-serif">
                                    POISSON Statistics Competition 2024
                                </span>
                            </Heading>
                            <MobileImage src="/img/landing-page/landing/LOGO POISSON 2024.svg" />
                            <TagLine>
                                Building the Future with Official Statistics
                            </TagLine>
                            <Description>{t("landingpage.intro")}</Description>
                            <PrimaryButton as="a" href="/login">
                                {t("baca-selengkapnya")}
                            </PrimaryButton>
                        </TextColumn>
                    </Row>
                </ContentWithVerticalPadding>
                <DecoratorRight />
            </Container>
        </>
    );
};

export default Hero;
