import React from "react";
import tw from "twin.macro";
import styled from "styled-components";
import { useTranslation } from "react-i18next";
import {
    semnasImg,
    semnasBg,
    transisi4,
    transisiSemnasTop,
    transisiSemnasBottom,
} from "../config";

import { PrimaryButton as PrimaryButtonBase } from "./misc/Buttons";
import { SectionHeading, Subheading as SubheadingBase } from "./misc/Headings";

// Styled Component
const OuterContainer = tw.div`relative w-full`;
const BackgroundContainer = styled.div((props) => [
    `background-image: url("${props.imageSrc}");
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;`,
    tw`absolute inset-0 w-full h-full`,
]);

const ContentContainer = tw.div`relative z-10 flex flex-col items-center justify-center w-full`;
const TwoColumn = tw.div`flex flex-col lg:flex-row justify-between items-center max-w-screen-2xl w-full lg:mt-24`;

const Column = tw.div`w-full max-w-md mx-auto md:max-w-none md:mx-0`;

const ImageColumn = tw(
    Column
)`lg:w-1/3 flex justify-center flex-shrink-0 md:h-96 relative lg:order-last order-first w-full lg:mt-0 mb-6 mt-24 lg:mb-0 md:mb-6`;

const Image = styled.div((props) => [
    `background-image: url("${props.imageSrc}");
   background-position: center;
   background-size: cover;
   background-repeat: no-repeat;`,
    tw`relative bg-cover bg-no-repeat w-56 h-56 md:w-96 md:h-96 z-20 rounded-lg transition-transform duration-300 rounded-full`,
    `
    box-shadow: 0px 4px 8px rgba(0,0,0,0.25);

    &:hover {
      transform: scale(1.05);
      box-shadow: 0px 12px 24px rgba(0,0,0,0.35);
    }
  `,
]);

const TextColumn = tw(Column)`
  relative lg:ml-16 md:px-4 md:pb-24
  bg-gradient-to-b from-white to-transparent rounded-t-xl
`;

const TextContent = tw.div`px-4 lg:py-8 text-center flex flex-col sm:gap-4 items-center`;

const Subheading = styled(SubheadingBase)`
    ${tw`text-center mt-3 mb-5 text-lg md:text-2xl font-lato font-semibold text-primaryPoi25-950`}
    text-shadow: 4px 4px 2px rgba(239,113,34,0.22);
`;

const Heading = styled(SectionHeading)`
    ${tw`mt-10 font-black tracking-[7.98px] text-2xl sm:text-4xl lg:text-6xl 
       text-center text-primaryPoi25-950 bg-clip-text z-10 font-bold font-playfair italic`}
    text-shadow: 3px 4px 4px rgb(97 94 11 / 0.40);
`;

const Description = styled.p`
    ${tw` mt-4 text-center text-xs md:text-xl font-medium leading-relaxed text-primaryPoi25-950 font-lato`}
    text-shadow: 0px 4px 4px rgb(254 245 176 / 1);
`;

const PrimaryButton = tw(
    PrimaryButtonBase
)`relative z-40 my-8 mb-24 md:mb-0 w-[250px] tracking-wide text-center`;

const Layer = styled.div`
    ${tw`absolute bottom-0 left-0 right-0 w-full h-1/5 z-0`}
    background-image: url("/img/landing-page/landing/layerSemnas.svg");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: bottom center;
`;

const Transisi = styled.div`
    ${tw`absolute left-0 right-0 w-full z-10 pointer-events-none`}
    height: ${(props) => props.height || "200px"};
    background-size: cover;
    background-repeat: no-repeat;
    ${({ position }) => position === "top" && tw`top-0`}
    ${({ position }) => position === "bottom" && tw`bottom-0`}
  background-image: ${({ img }) => `url(${img})`};
`;

// Component
const Semnas = () => {
    const { t } = useTranslation();

    return (
        <OuterContainer id="semnas">
            <BackgroundContainer imageSrc={semnasBg} />
            <Transisi position="top" img={transisiSemnasTop} />
            <ContentContainer>
                <TwoColumn>
                    <TextColumn>
                        <TextContent>
                            <Heading>{t("section-title.semnas")}</Heading>
                            <Subheading>{t("semnas-topic")}</Subheading>
                            <Description>{t("semnas-desc")}</Description>
                            <PrimaryButton
                                as="a"
                                href="https://semnas.stis.ac.id/"
                            >
                                {t("info-selengkapnya")}
                            </PrimaryButton>
                        </TextContent>
                        <Layer />
                    </TextColumn>
                    <ImageColumn>
                        <Image imageSrc={semnasImg} />
                    </ImageColumn>
                </TwoColumn>
            </ContentContainer>
            <Transisi position="bottom" img={transisiSemnasBottom} />
        </OuterContainer>
    );
};

export default Semnas;
