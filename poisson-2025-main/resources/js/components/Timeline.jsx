import React, { useContext } from "react";
import styled from "styled-components";
import tw from "twin.macro";
import {
    timelineBg,
    transisiTimelineBottom,
    transisiTimelineTop,
} from "../config";

import Context from "../helpers/Context";
import { SectionHeading } from "./misc/Headings";
import { SectionDescription } from "./misc/Typography";
import { Container, ContentWithPaddingXl } from "./misc/Layouts";
import { Trans, useTranslation } from "react-i18next";

// import { ReactComponent as SvgDecoratorTlStar } from "images/decor-timeline-star.svg";
// import { ReactComponent as SvgDecoratorTLWave} from "images/decor-timeline-wave.svg";
// import { ReactComponent as SvgDecoratorTlPill } from "images/decor-timeline-pil.svg"

// Styled Component
const Heading = styled(SectionHeading)`
    ${tw`relative text-4xl lg:text-6xl text-white font-bold tracking-[8.96px] font-playfair italic mt-10`}
    text-shadow: 0px 4px 8px rgb(0 0 0 / 0.75);
`;

const Column = tw.div`flex flex-col items-center mt-16 md:mt-24 lg:mt-36`;

const TimelineContainer = tw.div`mt-12 max-w-4xl relative mx-auto`;

const TimelineCols = tw.div`flex flex-col md:grid grid-cols-9 mx-auto p-2 bg-clip-text`;

const LineContainer = tw.div`col-start-5 col-end-6 md:mx-auto relative mr-10 flex items-center`;

const LineColor = tw.div`h-full  w-2 mx-auto bg-[#FAE8B3]`;

const LineNumber = tw.div`w-8 h-8 md:w-12 md:h-12 absolute -ml-3 md:-ml-5 rounded-full shadow bg-gradient-to-r from-[#FAE8B3] to-[#F2C5B4] flex text-black font-bold items-center justify-center border-2 border-white`;

const TimelineItemsContainer = styled.div(({ isLeft }) => [
    isLeft ? tw`flex flex-row-reverse md:contents` : tw`flex md:contents`,
]);

const TimelineContent = styled.div(({ isLeft }) => [
    tw`rounded-2xl my-4 p-4 shadow-md w-full mr-auto z-0 bg-gradient-to-r from-[#FAE8B3] to-[#F2C5B4] border-2 border-white text-center items-center`,
    isLeft ? tw`col-start-1 col-end-5` : tw`col-start-6 col-end-10`,
    `
    box-shadow: 0px 10px 15px 0px rgba(0,0,0,0.55);
  `,
]);

const TimelineTitle = tw.h3`font-bold text-black text-xl mb-1 font-lato italic`;

const TimelineDate = tw.p`text-lg font-medium text-black font-lato italic`;

const BackgroundContainer = styled.div((props) => [
    `background-image: url("${props.imageSrc}");
  background-position: top center;
  background-size: cover;
  background-repeat: no-repeat;`,
    tw`absolute inset-0 w-full h-full`,
]);

// Custom Component
const Line = ({ index }) => {
    return (
        <LineContainer>
            <LineNumber>{index}</LineNumber>
            <LineColor />
        </LineContainer>
    );
};

const TimelineItem = ({ isLeft = false, title, date, index }) => {
    const { t } = useTranslation();

    return (
        <TimelineItemsContainer isLeft={isLeft}>
            {!isLeft && <Line index={index} />}
            <TimelineContent isLeft={isLeft}>
                <TimelineTitle>{t("timeline-title." + index)}</TimelineTitle>
                <TimelineDate>{t("timeline-date." + index)}</TimelineDate>
            </TimelineContent>
            {isLeft && <Line index={index} />}
        </TimelineItemsContainer>
    );
};

const Transisi = styled.div`
    ${tw`absolute left-0 right-0 w-full z-40 pointer-events-none`}
    height: ${(props) => props.height || "200px"};
    background-size: cover;
    background-repeat: no-repeat;
    ${({ position }) => position === "top" && tw`top-0`}
    ${({ position }) => position === "bottom" && tw`bottom-0`}
  background-image: ${({ img }) => `url(${img})`};
`;

// Component
const Timeline = () => {
    const { timeline } = useContext(Context);
    const { t } = useTranslation();

    return (
        <div>
            <Container>
                <Transisi position="top" img={transisiTimelineTop} />
                <BackgroundContainer imageSrc={timelineBg} />
                <ContentWithPaddingXl>
                    <Column>
                        <Heading bottomLine={true}>
                            {t("section-title.timeline")}
                        </Heading>
                    </Column>
                    <TimelineContainer>
                        <TimelineCols>
                            {timeline.map((item, index) => (
                                <TimelineItem
                                    isLeft={index % 2 === 0}
                                    title={item.title}
                                    date={item.date}
                                    index={index + 1}
                                    key={index}
                                />
                            ))}
                        </TimelineCols>
                    </TimelineContainer>
                </ContentWithPaddingXl>
                <Transisi position="bottom" img={transisiTimelineBottom} />
            </Container>
        </div>
    );
};

export default Timeline;
