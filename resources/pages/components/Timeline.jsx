import React, { useContext } from "react";
import styled, { css } from "styled-components";
import tw from "twin.macro";

import Context from "../helpers/Context";
import { SectionHeading } from "./misc/Headings";
import { SectionDescription } from "./misc/Typography";
import { Container, ContentWithPaddingXl } from "./misc/Layouts";

import SvgDecorTimelineStar from "./svgJSX/DecorTimelineStar";
import SvgDecorTimelineWave from "./svgJSX/DecorTimelineWave";
import SvgDecorTimelinePil from "./svgJSX/DecorTimelinePil";

const SvgDecoratorTlStar = SvgDecorTimelineStar;
const SvgDecoratorTLWave = SvgDecorTimelineWave;
const SvgDecoratorTlPill = SvgDecorTimelinePil;

const Heading = tw(SectionHeading)`relative inline-block`;

const Description = tw(SectionDescription)`w-full text-white text-center`;

const Column = tw.div`flex flex-col items-center`;

const TimelineContainer = tw.div`mt-12 max-w-4xl relative mx-auto`;

const TimelineCols = tw.div`flex flex-col md:grid grid-cols-9 mx-auto p-2`;

const LineContainer = tw.div`col-start-5 col-end-6 md:mx-auto relative mr-10 flex items-center`;

const LineColor = tw.div`h-full w-1 mx-auto bg-orange`;

const LineNumber = tw.div`w-8 h-8 absolute -ml-3 -mt-3 rounded-full shadow bg-purple flex text-white font-bold items-center justify-center`;

const TimelineItemsContainer = styled.div(({ isLeft }) => [
  isLeft ? tw`flex flex-row-reverse md:contents` : tw`flex md:contents`,
]);

const TimelineContent = styled.div(({ isLeft }) => [
  tw`rounded-2xl my-4 p-4 shadow-md w-full mr-auto z-0`,
  isLeft
    ? tw`col-start-1 col-end-5 md:ml-auto md:mr-0 md:text-right`
    : tw`col-start-6 col-end-10`,
  css`
    background: linear-gradient(90deg, #006400, #00FF00);
  `,
]);

const TimelineTitle = tw.h3`font-semibold font-bold text-white text-xl mb-1`;

const TimelineDate = tw.p`text-sm leading-snug tracking-wide text-white text-opacity-100`;

const DecoratorTlStar = styled(SvgDecoratorTlStar)`
  ${tw`pointer-events-none z-0 absolute left-0 top-0 transform translate-x-[-4rem] -translate-y-12 w-56 h-56 md:h-96 md:w-96`}
`;

const DecoratorTlWave = styled(SvgDecoratorTLWave)`
  ${tw`pointer-events-none z-0 absolute left-0 top-0 transform translate-x-[-4rem] translate-y-1/2`}
`;

const DecoratorTlPill = styled(SvgDecoratorTlPill)`
  ${tw`pointer-events-none -z-10 md:z-0 opacity-50 absolute right-0 top-0 transform translate-x-[4rem] translate-y-[150%] md:translate-y-1/2 w-56 lg:w-auto`}
`;

const Line = ({ index }) => {
  return (
    <LineContainer>
      <LineNumber>{index}</LineNumber>
      <LineColor />
    </LineContainer>
  );
};

const TimelineItem = ({ isLeft = false, title, date, index }) => {
  return (
    <TimelineItemsContainer isLeft={isLeft}>
      {!isLeft && <Line index={index} />}
      <TimelineContent isLeft={isLeft}>
        <TimelineTitle>{title}</TimelineTitle>
        <TimelineDate>{date}</TimelineDate>
      </TimelineContent>
      {isLeft && <Line index={index} />}
    </TimelineItemsContainer>
  );
};

const Timeline = () => {
  const { timeline } = useContext(Context);
  return (
    <div>
      <Container>
        <ContentWithPaddingXl>
          <Column>
            <Heading bottomLine={true}>
              Linimasa
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
            <Description>*) Jadwal Tentatif</Description>
          </TimelineContainer>
        </ContentWithPaddingXl>
        <DecoratorTlStar />
        <DecoratorTlWave />
        <DecoratorTlPill />
      </Container>
    </div>
  );
};

export default Timeline;
