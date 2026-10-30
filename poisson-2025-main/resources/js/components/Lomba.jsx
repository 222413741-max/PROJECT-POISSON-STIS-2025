import React, { useContext } from "react";
import styled, { css } from "styled-components";
import tw from "twin.macro";
import Context from "../helpers/Context";
import { useTranslation } from "react-i18next";

import { SectionHeading } from "./misc/Headings";
import { ContentWithPaddingXl } from "./misc/Layouts";
import { PrimaryButton } from "./misc/Buttons";
import {
    lombaBg,
    transisi3,
    transisiLombaBottom,
    transisiLombaTop,
} from "../config";

// Styled Component
const Container = tw.div`flex flex-row`;

const HeadingWrapper = tw.div`w-full text-center`;

const Heading = styled(SectionHeading)`
    ${tw`text-center text-white text-4xl md:text-6xl font-bold font-playfair tracking-[6px] italic mt-2`}text-shadow: 0px 4px 8px rgba(0,0,0,0.25)
`;

const Column = tw.div`flex flex-wrap justify-center mt-4 gap-8 lg:gap-0`;

// const CardColumn = tw.div`w-full md:w-1/2 xl:w-1/3 mt-16 xl:mt-0 text-center flex-shrink-0`;
const CardColumn = tw.div`flex flex-wrap justify-center md:mx-auto xl:w-1/3 lg:mt-16 text-center flex-shrink-0`;

const Card = tw.div`max-w-sm md:max-w-xs lg:max-w-sm xl:max-w-xs`;

const CardImage = styled.div((props) => [
    `background-image: url("${props.imageSrc}");`,
    tw`
    h-56 w-56 mx-auto lg:w-96 lg:h-96
    bg-cover bg-center
    shadow-lg transition duration-300 rounded-lg
  `,
    `
    &:hover {
      box-shadow: 0px 12px 24px rgba(0,0,0,0.4);
      transform: scale(1.03);
    }
  `,
]);

const CardText = tw.div`flex flex-col justify-between`;

const CardBackground = styled.div`
    ${tw`w-96 h-24 md:h-36 absolute self-center`}
    background: radial-gradient(
    ellipse 50% 50% at 50% 50%,
    #FFFFD5 0%,
    rgba(251, 244, 244, 0.86) 63%,
    rgba(255, 255, 255, 0) 97%
  );
`;

const CardTitle = tw.h5`
  text-center text-2xl md:text-4xl mt-4 py-4
  font-bold z-10
  text-primaryPoi25-950 font-lato
`;

const CardBtnWrapper = tw.div`w-full text-center z-10 flex flex-row justify-center`;

const CardBtn = tw(PrimaryButton)`mx-2`;

const BackgroundContainer = styled.div((props) => [
    `
    background-image: url("${props.imageSrc}");
    background-position: top center;
    background-size: cover;
    background-repeat: no-repeat;
    height:100%;
  `,
    tw`relative w-full h-full`,
]);

const Transisi = styled.div`
    ${tw`absolute left-0 right-0 w-full z-0 pointer-events-none`}
    height: ${(props) => props.height || "200px"};
    background-size: cover;
    background-repeat: no-repeat;
    ${({ position }) => position === "top" && tw`top-0`}
    ${({ position }) => position === "bottom" && tw`bottom-0`}
  background-image: ${({ img }) => `url(${img})`};
`;

// Component
const Lomba = () => {
    const { lomba } = useContext(Context);
    const { t } = useTranslation();
    return (
        <Container id="lomba">
            <BackgroundContainer imageSrc={lombaBg}>
                <Transisi position="top" img={transisiLombaTop} />
                <ContentWithPaddingXl>
                    <HeadingWrapper>
                        <Heading bottomLine={true}>
                            {t("section-title.kompetisi")}
                        </Heading>
                    </HeadingWrapper>
                    <Column>
                        {lomba.map((card, index) => (
                            <CardColumn key={index}>
                                <Card>
                                    <div style={{ position: "relative" }}>
                                        <CardImage imageSrc={card.imageSrc} />
                                        {/* <DotPattern/> */}
                                    </div>
                                    <CardText>
                                        <CardBackground />
                                        <CardTitle>{t(card.title)}</CardTitle>
                                        <div className="flex flex-col gap-5">
                                            <CardBtnWrapper>
                                                <CardBtn
                                                    target="_blank"
                                                    as="a"
                                                    href={card.link}
                                                >
                                                    Guideline
                                                </CardBtn>
                                            </CardBtnWrapper>
                                            {card.modul && (
                                                <CardBtnWrapper>
                                                    <CardBtn
                                                        target="_blank"
                                                        as="a"
                                                        href={card.modul}
                                                        // href="#"
                                                        // onClick={(e) => e.preventDefault()}
                                                    >
                                                        Referensi Materi
                                                    </CardBtn>
                                                </CardBtnWrapper>
                                            )}
                                        </div>
                                    </CardText>
                                </Card>
                            </CardColumn>
                        ))}
                    </Column>
                </ContentWithPaddingXl>
                <Transisi position="bottom" img={transisiLombaBottom} />
            </BackgroundContainer>
        </Container>
    );
};

export default Lomba;
